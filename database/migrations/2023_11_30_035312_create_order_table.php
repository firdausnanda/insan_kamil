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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->string('id_pembayaran')->nullable();
            $table->string('id_user');
            $table->integer('harga_total');
            $table->integer('jumlah_produk_total');
            $table->string('courier');
            $table->integer('biaya_pengiriman');
            $table->integer('origin');
            $table->integer('destination');
            $table->string('no_resi')->nullable();
            $table->enum('status', [1,2,3,4,5])->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
