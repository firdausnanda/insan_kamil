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
        Schema::table('harga', function (Blueprint $table) {
            $table->dateTime('mulai_diskon')->default(now())->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('harga', function (Blueprint $table) {
            $table->dropColumn('mulai_diskon');
        });
    }
};
