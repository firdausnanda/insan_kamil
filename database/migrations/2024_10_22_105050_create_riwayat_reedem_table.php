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
        Schema::create('riwayat_reedem', function (Blueprint $table) {
            $table->id();
            $table->string('id_user');
            $table->string('id_reward')->nullable();
            $table->string('nama')->nullable();
            $table->integer('point_total')->nullable();
            $table->string('harga_total')->nullable();
            $table->string('deskripsi')->nullable();
            $table->string('gambar')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('no_rekening')->nullable();
            $table->string('nama_pemilik')->nullable();
            $table->string('ktp')->nullable();
            $table->enum('status', ['process', 'success', 'failed'])->default('process');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_reedem');
    }
};
