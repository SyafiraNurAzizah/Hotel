<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peraturan Privasi Hotel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
            top: 90px;
            left: 40px;
        }
        .btn-back {
            background-color: #007bff;
            color: white;
            padding: 9px 10px;
            border-radius: 50%;
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
        <h1>Peraturan Privasi Hotel</h1>

        <div class="card-columns">
            <div class="card">
                <i class="fas fa-user-shield card-icon"></i>
                <h2 class="rule-title">Pengumpulan Informasi Pribadi</h2>
                <p>Hotel kami mengumpulkan informasi pribadi yang relevan untuk proses reservasi dan pelayanan.</p>
                <p>Informasi ini meliputi nama, alamat, nomor kontak, dan preferensi tamu.</p>
            </div>

            <div class="card">
                <i class="fas fa-lock card-icon"></i>
                <h2 class="rule-title">Keamanan Data</h2>
                <p>Kami menggunakan langkah-langkah keamanan yang ketat untuk melindungi data pribadi tamu.</p>
                <p>Data disimpan secara aman dan hanya diakses oleh staf berwenang.</p>
            </div>

            <div class="card">
                <i class="fas fa-user-check card-icon"></i>
                <h2 class="rule-title">Penggunaan Informasi</h2>
                <p>Informasi pribadi digunakan untuk memberikan layanan terbaik sesuai kebutuhan tamu.</p>
                <p>Kami juga menggunakan data untuk keperluan administrasi dan pengelolaan fasilitas hotel.</p>
            </div>

            <div class="card">
                <i class="fas fa-handshake card-icon"></i>
                <h2 class="rule-title">Pembagian Informasi kepada Pihak Ketiga</h2>
                <p>Informasi pribadi tamu tidak akan dibagikan kepada pihak ketiga tanpa persetujuan kecuali diwajibkan oleh hukum.</p>
                <p>Hotel bekerja sama hanya dengan mitra tepercaya yang menjaga privasi data.</p>
            </div>

            <div class="card">
                <i class="fas fa-trash-alt card-icon"></i>
                <h2 class="rule-title">Kebijakan Penyimpanan Data</h2>
                <p>Data pribadi disimpan sesuai periode yang diperlukan untuk keperluan administrasi.</p>
                <p>Data akan dihapus atau dianonimkan jika sudah tidak diperlukan.</p>
            </div>

            <div class="card">
                <i class="fas fa-user-edit card-icon"></i>
                <h2 class="rule-title">Akses dan Pembaruan Data</h2>
                <p>Tamu memiliki hak untuk mengakses dan memperbarui informasi pribadi mereka yang disimpan hotel.</p>
                <p>Permintaan perubahan dapat dilakukan dengan menghubungi pihak resepsionis.</p>
            </div>

            <div class="card">
                <i class="fas fa-user-secret card-icon"></i>
                <h2 class="rule-title">Kerahasiaan Informasi</h2>
                <p>Hotel kami menjamin kerahasiaan informasi pribadi setiap tamu.</p>
                <p>Staf hotel terlatih untuk menjaga privasi dan tidak menyebarkan informasi tanpa izin.</p>
            </div>

            <div class="card">
                <i class="fas fa-ban card-icon"></i>
                <h2 class="rule-title">Penghapusan Akun</h2>
                <p>Tamu dapat meminta penghapusan akun dan data pribadi mereka setelah masa menginap berakhir.</p>
                <p>Permintaan akan diproses sesuai kebijakan privasi yang berlaku.</p>
            </div>

            <div class="card">
                <i class="fas fa-question-circle card-icon"></i>
                <h2 class="rule-title">Pertanyaan dan Pengaduan</h2>
                <p>Jika ada pertanyaan atau pengaduan terkait kebijakan privasi, tamu dapat menghubungi kami melalui kontak resmi.</p>
                <p>Kami akan merespons dengan cepat untuk menjaga kepercayaan tamu.</p>
            </div>

            <div class="card">
                <i class="fas fa-clipboard-check card-icon"></i>
                <h2 class="rule-title">Kepatuhan terhadap Peraturan Privasi</h2>
                <p>Hotel kami mematuhi semua peraturan privasi yang berlaku di negara terkait.</p>
                <p>Kami berkomitmen untuk melindungi privasi setiap tamu.</p>
            </div>

            <div class="card">
                <i class="fas fa-wrench card-icon"></i>
                <h2 class="rule-title">Pembaruan Kebijakan Privasi</h2>
                <p>Kebijakan privasi ini dapat diperbarui sewaktu-waktu sesuai kebutuhan.</p>
                <p>Tamu akan diberi informasi terkait setiap perubahan kebijakan.</p>
            </div>
        </div>

        <p class="thank-you">Terima kasih atas kepercayaan Anda. Kami berkomitmen untuk menjaga privasi dan kenyamanan Anda selama menginap.</p>
    </div>
</body>
</html>
