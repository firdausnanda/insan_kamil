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
        Schema::create('bukti_transfer', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('gambar')->nullable();
            $table->boolean('status');
            $table->string('nama_rekening')->nullable();
            $table->string('transfer_ke')->nullable();
            $table->string('tgl_transfer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukti_transfer');
    }
};
