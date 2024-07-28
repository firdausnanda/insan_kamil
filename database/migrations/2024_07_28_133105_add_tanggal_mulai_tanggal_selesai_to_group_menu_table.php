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
        Schema::table('group_menu', function (Blueprint $table) {
            $table->boolean('preorder')->default(0);
            $table->dateTime('tanggal_mulai')->nullable();
            $table->dateTime('tanggal_selesai')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('group_menu', function (Blueprint $table) {
            $table->dropColumn('preorder');
            $table->dropColumn('tanggal_mulai');
            $table->dropColumn('tanggal_selesai');
        });
    }
};
