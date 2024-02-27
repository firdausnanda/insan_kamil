<?php
 
namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Order;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Services\Midtrans\CallbackService;
use Illuminate\Support\Facades\Log;

class PaymentCallbackController extends Controller
{
    public function receive()
    {
        $callback = new CallbackService;

        if ($callback->isSignatureKeyVerified()) {
            $notification = $callback->getNotification();
            $order = $callback->getOrder();
 
            if ($callback->isSuccess()) {
                $pembayaran = Pembayaran::where('id_order', $order->id)->update([
                    'status_pembayaran' => 2,
                ]);
                
                Order::where('id', $order->id)->update([
                    'status' => 2,
                ]);

                Log::info("success");
            }
 
            if ($callback->isExpire()) {
                $pembayaran = Pembayaran::where('id_order', $order->id)->update([
                    'status_pembayaran' => 3,
                ]);
            }
 
            if ($callback->isCancelled()) {
                $pembayaran = Pembayaran::where('id_order', $order->id)->update([
                    'status_pembayaran' => 4,
                ]);
            }

            Log::info($pembayaran);
            return ResponseFormatter::success('Sukses', 'Notifikasi berhasil diproses');
        } else {
            
            Log::error("Signature key tidak terverifikasi");
            return ResponseFormatter::error('Error', 'Signature key tidak terverifikasi', 403);
        }
    }

    public function error(Request $request)
    {
        try {
            if ($request->transaction_status == 'expire') {
                $pembayaran = Pembayaran::where('id_order', $request->order_id)->update([
                    'status_pembayaran' => 3,
                ]);
    
                // Update Order
                $order = Order::where('id', $request->order_id)->first();
                $order->update([
                    'status' => 6,
                ]);
    
                Log::warning("Expired! : ID Order = . $request->order_id . Status = . $pembayaran");
                return redirect()->route('user.order.konfirmasi');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
    }
}
