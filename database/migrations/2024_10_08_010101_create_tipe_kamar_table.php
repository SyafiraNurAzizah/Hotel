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
        Schema::create('tipe_kamar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained('hotels')->onDelete('cascade');
            $table->string('nama_tipe');
            $table->text('deskripsi')->nullable();
            $table->string('harga_per_malam');
            $table->integer('jumlah_kamar_tersedia');
            $table->integer('kapasitas');
            $table->text('fasilitas')->nullable();
            $table->integer('ukuran_kamar');
            $table->string('jenis_kasur')->nullable();
            $table->string('foto')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    
    public function down(): void
    {
        Schema::dropIfExists('tipe_kamar');
    }
};