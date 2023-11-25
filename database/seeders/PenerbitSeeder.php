<?php

namespace Database\Seeders;

use App\Models\Penerbit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenerbitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Penerbit::create([
            'nama_penerbit' => 'Erlangga'
        ]);

        Penerbit::create([
            'nama_penerbit' => 'Bentang Pustaka'
        ]);

        Penerbit::create([
            'nama_penerbit' => 'Gagas Media'
        ]);
    }
}
