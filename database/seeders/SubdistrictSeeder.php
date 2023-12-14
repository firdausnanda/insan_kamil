<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Subdistrict;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class SubdistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::chunk(50, function ($cities) {

            // Get Value
            foreach ($cities as $c) {
                $district = Http::withOptions(['verify' => false,])->withHeaders([
                    'key' => env('RAJAONGKIR_API_KEY')
                ])->get('https://pro.rajaongkir.com/api/subdistrict?city=' . $c->id)->json()['rajaongkir']['results'];
    
                $insert_district = [];
    
                foreach ($district as $d) {
    
                    $data = [
                        'province_id'   => $d['province_id'],
                        'city_id'       => $d['city_id'],
                        'name'          => $d['subdistrict_name'],
                        'created_at'    => now(),
                        'updated_at'    => now(),
                    ];
    
                    $insert_district[] = $data;
                }
    
                $insert_district = collect($insert_district);
    
                $district_chunk = $insert_district->chunk(100);
    
                foreach ($district_chunk as $chunk) {
                    Subdistrict::insert($chunk->toArray());
                }
            }

            sleep(2);
        });
    }
}
