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
        Schema::create('dropship', function (Blueprint $table) {
            $table->id();
            $table->string('id_user');
            $table->string('id_order')->nullable();
            $table->string('nama_pengirim')->nullable();
            $table->string('no_telp_pengirim')->nullable();
            $table->string('email_pengirim')->nullable();
            $table->text('alamat_penerima')->nullable();
            $table->string('kota_penerima')->nullable();
            $table->string('provinsi_penerima')->nullable();
            $table->string('desa_penerima')->nullable();
            $table->string('no_telp_penerima')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dropship');
    }
};
