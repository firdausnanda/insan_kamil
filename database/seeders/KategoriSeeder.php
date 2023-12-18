<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kategori::create([
            'nama_kategori' => 'Buku Tafsir',
        ]);

        Kategori::create([
            'nama_kategori' => 'Buku Sirah',
        ]);
        Kategori::create([
            'nama_kategori' => 'Buku Fiqih dan Ibadah',
        ]);

        Kategori::create([
            'nama_kategori' => 'Buku Hadits',
        ]);

        Kategori::create([
            'nama_kategori' => 'Buku Aqidah',
        ]);

        Kategori::create([
            'nama_kategori' => 'Buku Sejarah',
        ]);

        Kategori::create([
            'nama_kategori' => 'Buku Biografi dan Tokoh',
        ]);

        Kategori::create([
            'nama_kategori' => 'Buku Muslimah',
        ]);

        Kategori::create([
            'nama_kategori' => 'Buku Motivasi',
        ]);

        Kategori::create([
            'nama_kategori' => 'Buku Dakwah',
        ]);

        Kategori::create([
            'nama_kategori' => 'Buku Akhlak',
        ]);

        Kategori::create([
            'nama_kategori' => 'Buku Pendidikan dan Parenting',
        ]);

        Kategori::create([
            'nama_kategori' => 'Buku Doa dan Dzikir',
        ]);

        Kategori::create([
            'nama_kategori' => 'Buku Hadist Saku',
        ]);

        Kategori::create([
            'nama_kategori' => 'Buku Anak',
        ]);

        Kategori::create([
            'nama_kategori' => 'Buku Filsafat',
        ]);
    }
}
