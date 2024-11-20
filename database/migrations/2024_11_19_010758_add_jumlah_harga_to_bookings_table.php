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
            $table->string('tipe_meja');
            $table->decimal('jumlah_harga', 10, 2)->default(0);
            $table->string('pesan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('tipe_meja');
            $table->dropColumn('jumlah_harga');
            $table->dropColumn('pesan');
        });
    }
};
