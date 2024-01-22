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
        Schema::create('produk_dikirim', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('id_order')->constrained('order');
            $table->string('id_produk');
            $table->integer('harga_jual');
            $table->integer('jumlah_produk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_dikirim');
    }
};
