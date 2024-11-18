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
        Schema::table('bookings', function (Blueprint $table) {
            $table->enum('status', ['selesai', 'belum_selesai', 'sedang_diproses', 'dibatalkan'])->default('belum_selesai');
            $table->enum('status_pembayaran', ['belum_dibayar', 'dibayar'])->default('belum_dibayar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('status_pembayaran');
        });
    }
};
