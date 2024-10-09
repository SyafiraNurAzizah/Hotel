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
            'judul_paket1' => 'Gold Package',
            'judul_paket2' => 'Platinum Package',
            'judul_paket3' => 'Silver Package',
            'paket1' => 'Dekorasi ballroom standar (tema klasik)
                        4 menu prasmanan (Indonesian, Asian)
                        Rias pengantin & busana untuk akad dan resepsi
                        1 fotografer profesional & album foto
                        1 malam menginap di Junior Suite untuk pengantin',
            'paket2' => 'Dekorasi premium ballroom dengan tema khusus
                        5 menu prasmanan internasional (Indonesian, Western, Chinese)
                        Rias & busana pengantin (2 kali ganti baju)
                        Fotografer & videografer profesional
                        Mobil pengantin + dekorasi
                        2 malam menginap di Grand Suite untuk pengantin',
            'paket3' => 'Dekorasi ballroom sederhana (tema minimalis)
                        3 menu prasmanan (Indonesian)
                        Rias pengantin untuk satu sesi
                        Fotografer dengan softcopy hasil dokumentasi
                        1 malam menginap di Deluxe Room untuk pengantin',
            'gambar' => 'img/weddings/weddings.jpg',
            'harga' => '75.000.000',
            'kapasitas' => 150,
        ]);
    }
}
