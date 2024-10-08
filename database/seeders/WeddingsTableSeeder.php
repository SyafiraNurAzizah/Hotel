<?php

namespace Database\Seeders;

use App\Models\Wedding;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class WeddingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Wedding::create([
            'judul' => 'Romantic Beach Wedding',
            'gambar' => 'img/weddings/weddings.jpg',
            'harga' => '300.000.000',
            'kapasitas' => 200,
            'paket' => 'Beach Wedding Package',
            'deskripsi' => 'Beautiful beach wedding package with a romantic setup and all the essentials for your special day.'
        ]);
    }
}
