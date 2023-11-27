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
        Schema::create('temp_order', function (Blueprint $table) {
            $table->id();
            $table->string('id_produk');
            $table->string('id_user');
            $table->integer('harga_jual');
            $table->float('jumlah_produk');
            $table->float('berat_produk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temp_order');
    }
};
