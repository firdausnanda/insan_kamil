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
        Schema::create('group_menu_produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_group_menu')->constrained('group_menu');
            $table->foreignId('id_produk')->constrained('produk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_menu_produk');
    }
};
