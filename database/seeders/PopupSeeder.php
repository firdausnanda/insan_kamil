<?php

namespace Database\Seeders;

use App\Models\Popup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PopupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Popup::create([
            'gambar' => '',
            'judul' => 'Discount up to',
            'diskon' => 50,
            'keterangan' => 'Seven day of grate deals - what could be better?',
            'status' => 1,
        ]);
    }
}
