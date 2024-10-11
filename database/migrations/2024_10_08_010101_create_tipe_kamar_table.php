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
            $table->id(); // Primary key
            $table->foreignId('hotel_id')->constrained('hotels')->onDelete('cascade');
            $table->string('nama_tipe'); // Nama tipe kamar
            $table->text('deskripsi')->nullable(); // Deskripsi tipe kamar
            $table->string('harga_per_malam'); // Harga per malam dengan presisi dua desimal
            $table->integer('jumlah_kamar_tersedia'); // Jumlah kamar tersedia
            $table->integer('kapasitas'); // Kapasitas maksimal tamu
            $table->text('fasilitas')->nullable(); // Fasilitas dalam bentuk teks (bisa JSON atau string)
            $table->integer('ukuran_kamar'); // Ukuran kamar dalam meter persegi (atau satuan lain)
            $table->string('jenis_kasur')->nullable(); // Jenis kasur (Queen Bed, King Bed, dll)
            $table->string('foto')->nullable(); // Path atau nama file gambar
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif'); // Status aktif/nonaktif
            $table->timestamps(); // Waktu created_at dan updated_at
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