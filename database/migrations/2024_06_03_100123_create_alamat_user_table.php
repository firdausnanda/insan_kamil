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
        Schema::create('alamat_user', function (Blueprint $table) {
            $table->id();
            $table->string('id_user');
            $table->text('nama_penerima')->nullable();
            $table->text('alamat_penerima')->nullable();
            $table->string('kota_penerima')->nullable();
            $table->string('provinsi_penerima')->nullable();
            $table->string('desa_penerima')->nullable();
            $table->string('no_telp_penerima')->nullable();
            $table->string('kode_pos')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alamat_user');
    }
};
