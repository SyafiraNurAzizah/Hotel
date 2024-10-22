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
        Schema::create('booking_hotel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('hotel_id')->constrained('hotels')->onDelete('cascade');
            $table->foreignId('tipe_kamar_id')->constrained('tipe_kamar')->onDelete('cascade');
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('tamu_dewasa')->default(0);
            $table->integer('tamu_anak')->default(0);
            $table->integer('jumlah_kamar')->default(1);
            $table->text('pesan')->nullable();
            $table->enum('status', ['selesai', 'belum_selesai', 'sedang_diproses', 'dibatalkan'])->default('belum_selesai');
            $table->enum('status_pembayaran', ['belum_dibayar', 'dibayar'])->default('belum_dibayar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_hotel');
    }
};
