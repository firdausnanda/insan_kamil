<?php

namespace App\Http\Controllers\User;

use App\Helpers\Pdf;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Dropship;
use App\Models\DropshipMaster;
use App\Models\Keranjang;
use App\Models\Member;
use App\Models\Order;
use App\Models\Pembayaran;
use App\Models\Produk;
use App\Models\ProdukDikirim;
use App\Models\Stok;
use App\Models\TempOrder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Midtrans\Snap;
use Illuminate\Support\Str;

class OrderController extends Controller
{

    public function __construct()
    {
        \Midtrans\Config::$serverKey    = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized  = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds        = config('services.midtrans.is3ds');
    }
        
    public function index() 
    {

        $data = TempOrder::with('user.member', 'user.province', 'user.city', 'user.district', 'produk.gambar_produk')->whereHas('user', function($query){
            $query->where('id', Auth::user()->id);
        })->get();

        $dropship = DropshipMaster::where('id_user', Auth::user()->id)->first();

        $subTotal = $data->sum(function($q) {
           return $q->jumlah_produk * $q->harga_jual; 
        });

        $beratProduk = $data->sum(function($q) {
            return $q->jumlah_produk * $q->berat_produk; 
        });

        // Courier
        switch (env('RAJAONGKIR_PACKAGE')) {
            case 'starter':
                $courier = config('rajaongkir.courier.starter');
                break;
            case 'basic':
                $courier = config('rajaongkir.courier.basic');
                break;
            case 'pro':
                $courier = config('rajaongkir.courier.pro');
                break;            
            default:
                $courier = null;
                break;
        }

        // Diskon Member
        if($data[0]->user->id_member){
            $member_diskon = $subTotal * $data[0]->user->member->diskon / 100;
        }elseif ($subTotal >= 50000) {
            $member_diskon = $subTotal * 10 / 100;
        }else{
            $member_diskon = 0;
        }

        // Diskon Event & Alquran
        $diskon_event = 0;
        $diskon_alquran = 0;

        foreach ($data as $k => $v) {
            $cek = Produk::with('harga', 'diskon')->where('id', $v->id_produk)->first();

            foreach ($cek->diskon as $key => $value) {
                $diskon_event += $cek->harga->harga_akhir * $value->diskon / 100;
            }

            $data[$k]->diskon_event = $diskon_event;

            // diskon alquran
            if ($cek->id_kategori == '17') {
                if ($data[0]->user->id_member) {
                    $diskon_alquran += $cek->harga->harga_akhir * $v->jumlah_produk * 30 / 100;
                }else{
                    $diskon_alquran += $cek->harga->harga_akhir * $v->jumlah_produk * 20 / 100;
                }
            }
        }

        if ($data->first() != '') {
            return view('pages.user.keranjang.checkout', compact('data', 'subTotal', 'beratProduk', 
                                                            'courier', 'dropship', 'member_diskon',
                                                            'diskon_alquran'));
        }else{
            return redirect()->route('user.keranjang.index');
        }
    }

    public function jumlah(Request $request) 
    {
        try {
            
            $order = Keranjang::where('id', $request->id_keranjang)->update([
                'jumlah_produk' => $request->jumlah
            ]);

            return ResponseFormatter::success($order, 'Data berhasil diubah!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }   
    }

    public function pembayaran(Request $request)
    {
        try {

            if ($request->status == 1) {

                // Update Pembayaran
                $pembayaran = Pembayaran::where('id_order', $request->id)->first();
                
                $pembayaran->update([
                    'status_pembayaran' => 2,
                ]);
                
                // Cek Order
                $order = Order::with('produk_dikirim')->where('id', $request->id)->first();
                
                // Update Member
                $user = User::with('member')->where('id', $order->id_user)->first();
                
                // Update pada table Order status & Member yang lama
                $order->update([
                    'status' => 2,
                    'id_member' => $user->id_member,
                ]);


                // Cek apakah sudah menjadi member apa belum
                if ($user->id_member) {
                    $cekmember = Member::where('pembelian_minimum', '>', $user->member->pembelian_minimum)->orderBy('pembelian_minimum', 'desc')->get();
                }else{
                    $cekmember = Member::orderBy('pembelian_minimum', 'desc')->get();   
                }

                // Cek total pembelian keseluruhan
                $cek_pembayaran_total = Order::where('id_user', $order->id_user)->wherehas('pembayaran', function($query){
                   $query->where('status_pembayaran', 2); 
                })->withSum('pembayaran', 'harga_jual')->get();

                $pembayaran_total = $cek_pembayaran_total->sum('pembayaran_sum_harga_jual');

                if($cekmember->count() > 0){
                    foreach ($cekmember as $v) {

                        // Check if pembelian lebih besar dari pembelian mininum member 
                        if ($pembayaran_total >= $v->pembelian_minimum) {

                            $user->update([
                                'id_member' => $v->id
                            ]);

                            break;
                        }
                    }
                }

                // Remove Keranjang dan TempOrder
                $temp = TempOrder::where('id_user', $request->user)->get();
                
                foreach ($temp as $v) {
                    Keranjang::where('id_produk', $v->id_produk)->where('id_user', $request->user)->delete();
                } 

                TempOrder::where('id_user', $request->user)->delete();

                // Stok dikurangi
                foreach ($order->produk_dikirim as $key => $value) {

                    // Stok Dikurangi
                    $cekProduk = Produk::where('id', $value->id_produk)->first();
                    Stok::where('id', $cekProduk->id_stok)->update([
                        'sisa_produk' => $cekProduk->stok->sisa_produk - $value->jumlah_produk
                    ]);
                }
    
                Log::info("success! : . $pembayaran");                
                return ResponseFormatter::success($pembayaran, 'data berhasil disimpan');

            }elseif ($request->status == 2) {

                $pembayaran = Pembayaran::where('id_order', $request->id)->first();    
                Log::error("Pending! : . $pembayaran");
                return ResponseFormatter::success($pembayaran, 'data gagal disimpan');

            }elseif ($request->status == 3) {
                
                // Update Order
                $order = Order::where('id', $request->id)->first();
                $order->update([
                    'status' => 6,
                ]);
                
                $pembayaran = Pembayaran::where('id_order', $request->id)->first();    
                
                Log::error("Error! : . $pembayaran");
                return ResponseFormatter::error($pembayaran, 'data gagal disimpan');
            }


        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }

    }

    public function store(Request $request)
    {
        try {

            // Cek Stok
            foreach ($request->data as $v) {

                $cekStok = Produk::with('stok')->where('id', $v['id_produk'])->first();
                
                if ($cekStok->stok->sisa_produk < $v['jumlah_produk']) {
                    return ResponseFormatter::error('Stok tidak tersedia/mencukupi', 'Data gagal disimpan');
                }
            }

            $collect = collect($request->data);

            // harga produk total
            $subTotal = $collect->sum(function($q) {
                return $q['jumlah_produk'] * $q['harga_jual']; 
            });

            // berat produk total
            $beratProduk = $collect->sum(function($q) {
                return $q['jumlah_produk'] * $q['berat_produk']; 
            });

            // Create Order
            $order = Order::create([
                'id_user' => $request->user,
                'no_invoice' => 'INV-' . Str::upper(Str::random(9)),
                'harga_total' => $subTotal,
                'jumlah_produk_total' => $beratProduk,
                'courier' => $request->courier,
                'courier_detail' => $request->courier_detail,
                'biaya_pengiriman' => $request->biaya_pengiriman,
                'origin' => $request->origin,
                'destination' => $request->destination,
                'catatan_pembelian' => $request->catatan,
            ]);

            // cek order User
            $cekOrder = Order::with('user.member')->where('id', $order->id)->first();

            $diskon_alquran = 0;
            
            foreach ($request->data as $v) {

                // Cek Stok
                $cek = Produk::with('stok')->where('id', $v['id_produk'])->first();

                // Create Produk Dikirim
                ProdukDikirim::create([
                    'id_order' => $order->id,
                    'id_produk' => $v['id_produk'],
                    'harga_jual' => $v['harga_jual'],
                    'jumlah_produk' => $v['jumlah_produk'],
                ]);

                // Diskon Alquran
                if ($cek->id_kategori == '17') {
                    if ($cekOrder->user->id_member) {
                        $diskon_alquran += $cek->harga->harga_akhir * $v['jumlah_produk'] * 30 / 100;
                    }else{
                        $diskon_alquran += $cek->harga->harga_akhir * $v['jumlah_produk'] * 20 / 100;
                    }
                }
            }

            // Hitung Member diskon
            if($cekOrder->user->id_member){
                $member_diskon = $subTotal * $cekOrder->user->member->diskon / 100;
            }elseif ($subTotal >= 50000) {
                $member_diskon = $subTotal * 10 / 100;
            }else{
                $member_diskon = 0;
            }

            // Hitung Total Biaya
            $total_biaya = $order->harga_total + $order->biaya_pengiriman - $member_diskon - $diskon_alquran;

            $payload = [
                'transaction_details' => [
                    'order_id'     => $order->id,
                    'gross_amount' => $total_biaya,
                ],
                'customer_details' => [
                    'first_name' => $cekOrder->user->name,
                    'email'      => $cekOrder->user->email,
                ],
                'item_details' => [
                    [
                        'id'            => $order->id,
                        'name'          => 'Transaksi Order - ' . $order->id,
                        'price'         => $total_biaya,
                        'quantity'      => 1,
                    ],
                ],
            ];

            // MidTrans
            $snapToken = Snap::getSnapToken($payload);

            // Create Pembayaran
            Pembayaran::create([
                'id_order' => $order->id,
                'status_pembayaran' => 1,
                'snap_token' => $snapToken,
                'harga_jual' => $order->harga_total + $order->biaya_pengiriman - $member_diskon - $diskon_alquran,
                'jumlah_produk' => $beratProduk,
            ]);
            
            // Dropship
            if ($request->status_dropship == 1) {
                $cekDropship = DropshipMaster::where('id_user', $request->user)->first();
    
                Dropship::create([
                    'id_user' => $request->user,
                    'id_order' => $order->id,
                    'nama_pengirim' => $cekDropship->nama_pengirim,
                    'no_telp_pengirim' => $cekDropship->no_telp_pengirim,
                    'email_pengirim' => $cekDropship->email_pengirim,
                    'alamat_penerima' => $cekDropship->alamat_penerima,
                    'kota_penerima' => $cekDropship->kota_penerima,
                    'provinsi_penerima' => $cekDropship->provinsi_penerima,
                    'desa_penerima' => $cekDropship->desa_penerima,
                    'no_telp_penerima' => $cekDropship->no_telp_penerima,
                ]);
            }

            return ResponseFormatter::success($snapToken, 'data berhasil disimpan');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
    }

    public function temp(Request $request)
    {
        try {

            // Remove TempOrder if exist
            TempOrder::where('id_user', $request->id_user)->delete();

            foreach ($request->dataProduk as $v) {
                // Store ke Temp Order
                $order = TempOrder::create([
                    'id_produk' => $v['id_produk'],
                    'id_user' => $request->id_user,
                    'harga_jual' => $v['harga'],
                    'berat_produk' => $v['berat_produk'],
                    'jumlah_produk' => $v['jumlah'],
                ]);
            }

            return ResponseFormatter::success($order, 'Data Tersimpan!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
    }

    public function beli(Request $request)
    {
        try {
            
            // Remove TempOrder if exist
            TempOrder::where('id_user', $request->id_user)->delete();

            $produk = Produk::with('harga')->where('id', $request->id_produk)->first();

            // Store ke Temp Order
            $order = TempOrder::create([
                'id_produk' => $request->id_produk,
                'id_user' => $request->id_user,
                'harga_jual' => $produk->harga->harga_akhir,
                'berat_produk' => $produk->berat_produk,
                'jumlah_produk' => $request->jumlah,
            ]);

            return ResponseFormatter::success($order, 'Data Tersimpan!');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
        
    }

    public function ongkir(Request $request)
    {
        try {

            if($request->courier == 'ambil_gudang'){

                $cost = [[
                    'code' => 'ambil_gudang',
                    'name' => 'AMBIL DI GUDANG',
                    'costs' => [[
                        "service" => "ADG",
                        "description" => "Ambil di gudang",
                        "cost" => [[
                            "value" => 0,
                            "etd" => "-",
                            "note" => "",
                        ]],
                    ]],
                ]];

            }else{

                $cost = RajaOngkir::ongkosKirim([
                    'origin'            => config('rajaongkir.origin'), // ID kota/kabupaten asal
                    'originType'        => 'city', // ID kota/kabupaten asal
                    'destination'       => $request->city_destination, // ID kota/kabupaten tujuan
                    'destinationType'   => 'subdistrict', // ID kota/kabupaten tujuan
                    'weight'            => $request->weight, // berat barang dalam gram
                    'courier'           => $request->courier 
                ])->get();
            }

            return ResponseFormatter::success($cost, 'Data berhasil diambil!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error('Error!', $e->getMessage(), 500);
        }
    }

    public function konfirmasi(Request $request)
    {
        if ($request->ajax()) {
            if ($request->status == 1) {
                $penjualan = Order::with('user', 'member', 'pembayaran')->withSum('pembayaran', 'harga_jual')->where('id_user', $request->id_user)->orderBy('created_at', 'desc')->get();
                return ResponseFormatter::success($penjualan, "Data berhasil diambil!");
            }else{
                switch ($request->status) {
                    case '2':
                        $status = 1;
                        break;
                    case '3':
                        $status = 3;
                        break;
                    case '4':
                        $status = 4;
                        break;                    
                }
                $penjualan = Order::with('user', 'member', 'pembayaran')->where('id_user', $request->id_user)->where('status', $status)->orderBy('created_at', 'desc')->get();
                return ResponseFormatter::success($penjualan, "Data berhasil diambil!");
            }
        }
        return view('pages.user.keranjang.konfirmasi');
    }

    public function detail_konfirmasi(Request $request, $id)
    {
        try {
            $order = Order::with('user.province', 'user.city', 'user.district', 'user.member', 'produk_dikirim.produk.gambar_produk')->where('id', $id)->first();
            $dropship = Dropship::where('id_order', $id)->first();
    
            // harga produk total
            $subTotal = $order->produk_dikirim->sum(function($q) {
                return $q['jumlah_produk'] * $q['harga_jual']; 
            });

            if($order->id_member){
                $member_diskon = $subTotal * $order->member->diskon / 100;
            }else{
                $member_diskon = 0;
            }
    
            return view('pages.user.keranjang.detail_konfirmasi', compact('order', 'subTotal', 'dropship', 'member_diskon'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
    }

    public function detail_store(Request $request)
    {
        try {

            $pembayaran = Pembayaran::where('id_order', $request->order_id)->first();

            return ResponseFormatter::success($pembayaran->snap_token, 'data berhasil disimpan');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
        
    }

    public function waybill(Request $request)
    {
        try {

            if ($request->waybill != '') {

                $waybill = Http::withHeaders([
                    'key' => env('RAJAONGKIR_API_KEY')
                ])->post('https://pro.rajaongkir.com/api/waybill',[
                    'waybill' => $request->waybill,
                    'courier' => $request->courier
                ])->json();

                $tracking = $waybill['rajaongkir']['result'];

                return ResponseFormatter::success($tracking, 'Data berhasil diambil!');
            }

            return '';

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error('Error!', $e->getMessage(), 500);
        }

    }

    public function diterima(Request $request)
    {
        try {
            $cekOrder = Order::where('id', $request->order_id)->update([
                'status' => 5
            ]);
            return ResponseFormatter::success($cekOrder, 'data berhasil disimpan');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
    }

    public function rating(Request $request)
    {
        try {
            foreach ($request->id_produk as $k => $v) {
                $produk = Produk::where('id', $v)->first();
                $produk->rateOnce($request->rating[$k], $request->ulasan[$k]);
            }

            return ResponseFormatter::success($produk, 'data berhasil disimpan');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error('Error!', $e->getMessage(), 500);
        }
    }

    public function dropship(Request $request)
    {
        try {

            if ($request->ajax()) {
                $cek = DropshipMaster::where('id_user', Auth::user()->id)->first();
                if ($cek == null || $cek == '') {
                    $user = User::where('id', Auth::user()->id)->first();
                    DropshipMaster::create([
                        'id_user' => Auth::user()->id,
                        'nama_pengirim' => $user->name,
                        'no_telp_pengirim' => $user->no_telp,
                        'email_pengirim' => $user->email,
                        'nama_penerima' => $user->name,
                        'alamat_penerima' => $user->alamat,
                        'kota_penerima' => $user->kota,
                        'provinsi_penerima' => $user->provinsi,
                        'desa_penerima' => $user->desa,
                        'no_telp_penerima' => $user->no_telp,
                    ]);    
                }
                $data = DropshipMaster::with('province', 'city', 'district')->where('id_user', Auth::user()->id)->first();
                return ResponseFormatter::success($data, 'data berhasil diambil!');
            }

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error('Error!', $e->getMessage(), 500);
        }
    }

    public function edit_dropship(Request $request)
    {
        $validator = Validator::make($request->all(), [
			'id_dropship' => 'required|string|max:255',
			'nama_pengirim' => 'required|string|max:255',
			'no_telp_pengirim' => 'required|string|max:255',
			'no_telp_penerima' => 'required|string|max:255',
			'email_pengirim' => 'required|string|max:255',
			'nama_penerima' => 'required|string|max:255',
			'alamat' => 'required|string|max:255',
			'provinsi' => 'required|string|max:255',
			'kota' => 'required|string|max:255',
			'desa' => 'required|string|max:255',
		]);

		if ($validator->fails()) {
			return ResponseFormatter::error($validator->errors(), 'Data tidak valid', 422);
		}

        try {
            
            $user = DropshipMaster::where('id', $request->id_dropship)->update([
                'nama_pengirim' => $request->nama_pengirim,
                'no_telp_pengirim' => $request->no_telp_pengirim,
                'email_pengirim' => $request->email_pengirim,
                'nama_penerima' => $request->nama_penerima,
                'alamat_penerima' => $request->alamat,
                'provinsi_penerima' => $request->provinsi,
                'kota_penerima' => $request->kota,
                'desa_penerima' => $request->desa,
                'no_telp_penerima' => $request->no_telp_penerima,
            ]);

            return ResponseFormatter::success($user, 'Data berhasil diubah!');
            
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }   
    }
    
    public function catatan(Request $request)
    {
        try {
            $order = TempOrder::where('id', $request->id)->update([
                'catatan_pembelian' => $request->catatan
            ]);
            
            return ResponseFormatter::success($order, 'Data berhasil diubah!');
            
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
    }

    public function cetak(Request $request) 
    {

        try {

            $order = Order::with('user', 'produk_dikirim.produk', 'member')->where('id', $request->id)->first();

            switch (env('RAJAONGKIR_PACKAGE')) {
                case 'starter':
                    $courier = config('rajaongkir.courier.starter');
                    break;
                case 'basic':
                    $courier = config('rajaongkir.courier.basic');
                    break;
                case 'pro':
                    $courier = config('rajaongkir.courier.pro');
                    break;            
                default:
                    $courier = null;
                    break;
            }
    
            foreach ($courier as $c) {
                if ($c['kode'] == $order->courier) {
                    $courier_search = $c['nama'];
                }
            }

            $pdf = new Pdf('P', 'mm', 'A5'); //L For Landscape / P For Portrait
            $pdf->AddPage();

            $pdf->SetFont('Arial', '', 10, 5);
            $pdf->Cell(100, 5, "Nota Pesanan", 0, 1);

            $pdf->Ln(3);
                        
            $pdf->SetFillColor('236', '236', '236');

            $pdf->SetFont( "Arial", "B", 8 );
            $pdf->Cell(27, 5,  "Nama Pembeli" , 0, 0, "L", true);
            $pdf->Cell(5, 5, ':', 0, 0, 'L', true);
            $pdf->SetFont( "Arial", "", 8 );
            $pdf->Cell(45, 5,  $order->user->name, 0, 0, "", true );
            
            $pdf->Cell(5, 5,  "", 0, 0, "L", true);
            
            $pdf->SetFont( "Arial", "B", 8 );
            $pdf->Cell(25, 5,  "Nama Penjual" , 0, 0, "L", true);
            $pdf->Cell(5, 5, ':', 0, 0, 'L', true);
            $pdf->SetFont( "Arial", "", 8 );
            $pdf->Cell(21, 5,  "Insan Kamil", 0, 1, "", true );

            $pdf->SetFont( "Arial", "B", 8 );

            $alamat = $order->user->alamat . ', Kec. ' . $order->user->district->name . " " . $order->user->city->name . ', ' . $order->user->province->name . ', ' . $order->user->kode_pos;
            $h = $pdf->GetMultiCellHeight(101, 5,  $alamat, 0, "", true );
            
            $pdf->Cell(27, $h,  "Alamat Pembeli" , 0, 0, "L", true);
            $pdf->Cell(5, $h, ':', 0, 0, 'L', true);
            $pdf->SetFont( "Arial", "", 8 );
            $pdf->MultiCell(101, 5,  $alamat, 0, "", true );
            
            $pdf->SetFont( "Arial", "B", 8 );
            $pdf->Cell(27, 5,  "No. Hp Pembeli" , 0, 0, "L", true);
            $pdf->Cell(5, 5, ':', 0, 0, 'L', true);
            $pdf->SetFont( "Arial", "", 8 );
            $pdf->Cell(101, 5,  $order->user->no_telp, 0, 1, "", true );            
            $pdf->SetFont( "Arial", "B", 8 );
            $pdf->Cell(27, 5,  "No. Pesanan" , 0, 0, "L", true);
            $pdf->Cell(5, 5, ':', 0, 0, 'L', true);
            $pdf->SetFont( "Arial", "", 8 );
            $pdf->Cell(101, 5,  $order->no_invoice == null ? $order->id : $order->no_invoice, 0, 0, "", true );
            $pdf->Ln(6);
            
            $pdf->SetFont( "Arial", "B", 8 );
            $pdf->Cell(35, 5,  "Waktu Pembayaran" , 0, 0, "C");
            $pdf->Cell(10, 5,  "" , 0, 0, "C");
            $pdf->Cell(35, 5,  "Pembayaran" , 0, 0, "C");
            $pdf->Cell(10, 5,  "" , 0, 0, "C");
            $pdf->Cell(35, 5,  "Kurir" , 0, 0, "C");
            $pdf->Cell(10, 5,  "" , 0, 0, "C");
            $pdf->Ln(5);

            $pdf->SetFont( "Arial", "", 8 );
            $pdf->Cell(35, 5,  $order->pembayaran[0]->created_at , 0, 0, "C");
            $pdf->Cell(10, 5,  "" , 0, 0, "C");
            $pdf->Cell(35, 5,  "QRIS" , 0, 0, "C");
            $pdf->Cell(10, 5,  "" , 0, 0, "C");
            $pdf->Cell(35, 5,  $courier_search , 0, 0, "C");
            $pdf->Cell(10, 5,  "" , 0, 1, "C");
            $pdf->Ln(2);

            $pdf->SetFont( "Arial", "B", 8 );
            $pdf->Cell(35, 5,  "Rincian Pesanan" , 0, 1, "L");

            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetFillColor('224', '224', '224');
            $pdf->Cell(10, 5,'No', "T,B", 0, 'C');
            $pdf->Cell(60, 5,'Produk', "T,B", 0, 'L');
            $pdf->Cell(5, 5,'Jumlah', "T,B", 0, 'C');
            $pdf->Cell(30, 5,'Harga', "T,B", 0, 'C');
            $pdf->Cell(30, 5,'Sub Total', "T,B", 1, 'C');
            
            $subTotal = 0;
            
            foreach ($order->produk_dikirim as $k => $v) {
                $pdf->SetFont('Arial', '', 8);
                $pdf->Cell(10, 4, $k + 1, 0, 0, 'C');
                $pdf->Cell(60, 4,$v->produk->nama_produk, 0, 0, 'L');
                $pdf->Cell(5, 4,$v->jumlah_produk, 0, 0, 'C');
                $pdf->Cell(30, 4, "Rp " . number_format($v->harga_jual, 0,',','.'), 0, 0, 'C');
                $pdf->Cell(30, 4, "Rp " . number_format($v->harga_jual * $v->jumlah_produk, 0,',','.'), 0, 1, 'C');                
                $subTotal += $v->harga_jual * $v->jumlah_produk;
            }

            // Garis bawah tabel
            $pdf->Cell(135, 3, '', "T", 1);

            $pdf->SetDrawColor('224', '224', '224');

            // Subtotal
            $pdf->Cell(75, 4, '', 0, 0);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Cell(30, 4, 'SubTotal', 0, 0, 'L');
            $pdf->Cell(30, 4, "Rp " . number_format($subTotal, 0,',','.'), 0, 1, 'C');
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Cell(75, 4, '', 0, 0);
            $pdf->Cell(60, 4, "Total Jumlah Produk (Aktif) " . $order->produk_dikirim->count() . " Produk", 0, 1, 'L');
            $pdf->Ln(3);

            $pdf->SetFillColor('247', '247', '247');
            $pdf->SetFont( "Arial", "", 8 );

            $pdf->Cell(75, 4, '', 0, 0);
            $pdf->Cell(60, 4, '', 0, 1, '', true);

            $pdf->Cell(75, 4, '', 0, 0);
            $pdf->Cell(27, 4,  "Sub Total Produk" , 0, 0, "L", true);
            $pdf->Cell(5, 4, ':', 0, 0, 'L', true);
            $pdf->Cell(28, 4,  "Rp " . number_format($subTotal, 0,',','.'), 0, 1, "R", true );            
            
            $pdf->Cell(75, 4, '', 0, 0);
            $pdf->Cell(27, 4,  "Ongkos Kirim" , 0, 0, "L", true);
            $pdf->Cell(5, 4, ':', 0, 0, 'L', true);
            $pdf->Cell(28, 4,  "Rp " . number_format($order->biaya_pengiriman, 0,',','.'), 0, 1, "R", true );            
            
            $pdf->Cell(75, 4, '', 0, 0);
            $pdf->Cell(27, 4,  "Diskon Member" , 0, 0, "L", true);
            $pdf->Cell(5, 4, ':', 0, 0, 'L', true);

            if ($order->id_member) {
                $diskon_member = $order->member->diskon * $subTotal / 100;        
            }else{
                $diskon_member = 0;        
            }

            $pdf->Cell(28, 4,  "Rp " . number_format($diskon_member, 0,',','.'), 0, 1, "R", true ); 
            
            $pdf->Cell(75, 2, '', 0, 0);
            $pdf->Cell(60, 2, '', "B", 1, '', true);

            $pdf->Cell(75, 2, '', 0, 0);
            $pdf->Cell(60, 2, '', 0, 1, '', true);
            
            $pdf->SetFont( "Arial", "B", 8 );
            $pdf->Cell(75, 4, '', 0, 0);
            $pdf->Cell(27, 4, 'Total Bayar', 0, 0, '',true);
            $pdf->Cell(5, 4, ':', 0, 0, 'L', true);
            $pdf->Cell(28, 4, "Rp " . number_format($order->pembayaran[0]->harga_jual - $diskon_member, 0,',','.'), 0, 1, 'R', true);
            
            $pdf->Cell(75, 4, '', 0, 0);
            $pdf->Cell(60, 4, '', 0, 1, '', true);
            
            $pdf->Ln(4);

            $pdf->Cell(135, 4, '', "T", 0);

            header('Access-Control-Allow-Origin: *');
            $pdf->Output('D', 'Invoice.pdf');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
        
    }
}
