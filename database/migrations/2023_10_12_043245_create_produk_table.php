<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kategori')->constrained('kategori');
            $table->string('id_penerbit')->nullable();
            $table->string('id_stok');
            $table->string('id_harga');
            $table->string('id_bahasa')->nullable();
            $table->string('kode_produk');
            $table->string('nama_produk');
            $table->integer('berat_produk');
            $table->string('ukuran_produk')->nullable();
            $table->string('pengarang')->nullable();
            $table->string('isbn')->nullable();
            $table->string('jenis_cover')->nullable();
            $table->string('halaman_produk')->nullable();
            $table->text('keterangan')->nullable();
            $table->enum('status', [1,2,3])->default(3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
