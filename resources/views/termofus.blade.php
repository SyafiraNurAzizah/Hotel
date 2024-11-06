<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peraturan dan Kebijakan Hotel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            max-width: 1200px;
            width: 100%;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .card-columns {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: calc(33.33% - 20px); /* Membuat tiga kolom */
            padding: 20px;
            text-align: center;
            box-sizing: border-box;
        }
        .card-icon {
            font-size: 40px;
            color: #007bff;
            margin-bottom: 10px;
        }
        .rule-title {
            font-size: 18px;
            color: #007bff;
            margin-bottom: 10px;
        }
        .card p {
            color: #555;
            font-size: 14px;
            margin: 5px 0;
        }
        .thank-you {
            text-align: center;
            color: #555;
            margin-top: 20px;
        }
        /* Responsif untuk layar lebih kecil */
        @media (max-width: 768px) {
            .card {
                width: calc(50% - 20px); /* Dua kolom untuk layar lebih kecil */
            }
        }
        @media (max-width: 480px) {
            .card {
                width: 100%; /* Satu kolom untuk layar sangat kecil */
            }
        }
        .back-button {
    position: fixed;
    top: 90px; /* Sesuaikan posisi vertikal */
    left: 40px; /* Sesuaikan posisi horizontal */
	
}

.btn-back {
    background-color: #007bff;
    color: white;
    padding: 9px 10px;
    border-radius: 50% ;
    text-decoration: none;
    font-size: 20px;

    transition: background-color 0.3s ease;
}

.btn-back:hover {
    background-color: #c97a5b;
}
    </style>
</head>
<body>
    <div class="back-button">
        <h3><a href="javascript:history.back()" class="btn btn-back">←</a></h3>
    </div>
    <br> 
<div class="container">
    <h1>Peraturan dan Kebijakan Hotel</h1>

    <div class="card-columns">
        <div class="card">
            <i class="fas fa-clock card-icon"></i>
            <h2 class="rule-title">Waktu Check-in dan Check-out</h2>
            <p>Waktu check-in mulai pukul 14:00.</p>
            <p>Waktu check-out maksimal pukul 12:00 siang.</p>
            <p>Check-out setelah waktu yang ditentukan akan dikenakan biaya tambahan.</p>
        </div>

        <div class="card">
            <i class="fas fa-credit-card card-icon"></i>
            <h2 class="rule-title">Pembayaran dan Deposit</h2>
            <p>Tamu wajib melakukan pembayaran penuh saat check-in.</p>
            <p>Deposit keamanan diperlukan dan akan dikembalikan saat check-out setelah pemeriksaan kamar.</p>
        </div>

        <div class="card">
            <i class="fas fa-ban card-icon"></i>
            <h2 class="rule-title">Kebijakan Pembatalan</h2>
            <p>Pembatalan reservasi harus dilakukan minimal 24 jam sebelum waktu check-in.</p>
            <p>Pembatalan terlambat akan dikenakan biaya sesuai kebijakan hotel.</p>
        </div>

        <div class="card">
            <i class="fas fa-smoking-ban card-icon"></i>
            <h2 class="rule-title">Kebijakan Merokok</h2>
            <p>Merokok dilarang di dalam kamar dan area umum, kecuali di area yang telah ditentukan.</p>
            <p>Biaya kebersihan tambahan akan dikenakan jika tamu merokok di area non-merokok.</p>
        </div>

        <div class="card">
            <i class="fas fa-user-friends card-icon"></i>
            <h2 class="rule-title">Kapasitas Maksimal</h2>
            <p>Setiap kamar memiliki batas maksimal jumlah tamu.</p>
            <p>Tamu tambahan akan dikenakan biaya atau diwajibkan memesan kamar tambahan.</p>
        </div>

        <div class="card">
            <i class="fas fa-swimmer card-icon"></i>
            <h2 class="rule-title">Penggunaan Fasilitas Hotel</h2>
            <p>Fasilitas seperti kolam renang, gym, dan restoran hanya untuk tamu terdaftar.</p>
            <p>Harap mengikuti jam operasional yang tertera di setiap fasilitas.</p>
        </div>

        <div class="card">
            <i class="fas fa-paw card-icon"></i>
            <h2 class="rule-title">Kebijakan Hewan Peliharaan</h2>
            <p>Hewan peliharaan tidak diperbolehkan, kecuali dinyatakan lain dalam kebijakan hotel.</p>
        </div>

        <div class="card">
            <i class="fas fa-broom card-icon"></i>
            <h2 class="rule-title">Kebersihan dan Kerusakan Kamar</h2>
            <p>Tamu bertanggung jawab menjaga kebersihan kamar dan tidak menyebabkan kerusakan.</p>
            <p>Kerusakan pada properti hotel akan dikenakan biaya kepada tamu.</p>
        </div>

        <div class="card">
            <i class="fas fa-shield-alt card-icon"></i>
            <h2 class="rule-title">Kebijakan Keamanan</h2>
            <p>Tamu bertanggung jawab atas keamanan barang pribadinya.</p>
            <p>Pihak hotel tidak bertanggung jawab atas kehilangan barang berharga yang tidak disimpan di brankas yang disediakan.</p>
        </div>

        <div class="card">
            <i class="fas fa-volume-mute card-icon"></i>
            <h2 class="rule-title">Kebijakan Kebisingan dan Gangguan</h2>
            <p>Tamu diharapkan menjaga ketenangan dan tidak mengganggu tamu lain.</p>
            <p>Kebisingan berlebih tidak diperbolehkan dan dapat berujung pada sanksi.</p>
        </div>

        <div class="card">
            <i class="fas fa-check-circle card-icon"></i>
            <h2 class="rule-title">Kepatuhan terhadap Kebijakan Hotel</h2>
            <p>Semua tamu wajib mematuhi kebijakan hotel untuk menjaga kenyamanan bersama.</p>
            <p>Pihak hotel berhak untuk meminta tamu keluar jika melanggar peraturan ini.</p>
        </div>

        <div class="card">
            <i class="fas fa-wifi card-icon"></i>
            <h2 class="rule-title">Penggunaan Internet dan Wi-Fi</h2>
            <p>Hotel menyediakan akses internet dan Wi-Fi gratis di area umum dan kamar tamu.</p>
            <p>Tamu diharapkan tidak menyalahgunakan akses internet untuk kegiatan ilegal.</p>
            <p>Pihak hotel tidak bertanggung jawab atas konten yang diakses tamu selama menggunakan jaringan Wi-Fi.</p>
        </div>
    </div>

    <p class="thank-you">Terima kasih atas kerja sama Anda. Semoga Anda menikmati masa menginap Anda di hotel kami!</p>
</div>

</body>
</html>
