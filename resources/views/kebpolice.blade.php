<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kebijakan Polisi</title>
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
            top: 547px; /* Sesuaikan posisi vertikal */
            left: 1290px; /* Sesuaikan posisi horizontal */	
        }
        .btn-back {
            background-color: #007bff;
            color: white;
            padding: 12px 15px;
            border-radius: 50% ;
            text-decoration: none;
            font-size: 20px;

            transition: background-color 0.3s ease;
        }
        .btn-back:hover {
            background-color: #ffffff;
            color: #007bff;
            /* border: 1px solid #007bff; */
        }
    </style>
</head>
<body>
    <div class="back-button">
        <h3><a href="javascript:history.back()" class="btn btn-back"><i class="fas fa-arrow-left" style="position: relative; top: 2px;"></i></a></h3>
    </div>
    <br> 
    <div class="container">
        <h1>Kebijakan Polisi</h1>

        <div class="card-columns">
            <div class="card">
                <i class="fas fa-user-shield card-icon"></i>
                <h2 class="rule-title">Penegakan Hukum</h2>
                <p>Polisi memiliki kewenangan untuk menegakkan hukum secara tegas sesuai peraturan yang berlaku.</p>
                <p>Penegakan dilakukan secara adil tanpa pandang bulu.</p>
            </div>

            <div class="card">
                <i class="fas fa-search card-icon"></i>
                <h2 class="rule-title">Kebijakan Penggeledahan</h2>
                <p>Penggeledahan hanya dilakukan sesuai prosedur dan atas dasar hukum.</p>
                <p>Semua penggeledahan harus disertai surat perintah yang sah, kecuali dalam keadaan darurat.</p>
            </div>

            <div class="card">
                <i class="fas fa-camera card-icon"></i>
                <h2 class="rule-title">Penggunaan Kamera dan CCTV</h2>
                <p>Kamera CCTV dipasang di area publik untuk memantau keamanan.</p>
                <p>Data rekaman digunakan untuk investigasi jika terjadi pelanggaran hukum.</p>
            </div>

            <div class="card">
                <i class="fas fa-balance-scale card-icon"></i>
                <h2 class="rule-title">Hak Tersangka</h2>
                <p>Tersangka memiliki hak untuk didampingi oleh pengacara selama proses hukum.</p>
                <p>Polisi wajib menjunjung tinggi hak-hak tersangka sesuai hukum yang berlaku.</p>
            </div>

            <div class="card">
                <i class="fas fa-user-friends card-icon"></i>
                <h2 class="rule-title">Kebijakan Interaksi dengan Masyarakat</h2>
                <p>Polisi akan berinteraksi secara profesional dengan masyarakat.</p>
                <p>Pengaduan masyarakat diproses sesuai prosedur untuk memastikan keadilan.</p>
            </div>

            <div class="card">
                <i class="fas fa-child card-icon"></i>
                <h2 class="rule-title">Perlindungan Anak</h2>
                <p>Polisi berkomitmen melindungi anak-anak dari segala bentuk kekerasan dan eksploitasi.</p>
                <p>Kasus yang melibatkan anak ditangani dengan prioritas khusus.</p>
            </div>

            <div class="card">
                <i class="fas fa-hands-helping card-icon"></i>
                <h2 class="rule-title">Tanggap Darurat</h2>
                <p>Polisi siap merespons situasi darurat seperti bencana alam dan kecelakaan.</p>
                <p>Tindakan diambil untuk melindungi keselamatan masyarakat.</p>
            </div>

            <div class="card">
                <i class="fas fa-shield-alt card-icon"></i>
                <h2 class="rule-title">Kebijakan Penggunaan Senjata</h2>
                <p>Senjata hanya digunakan dalam kondisi darurat dan sesuai prosedur yang berlaku.</p>
                <p>Setiap penggunaan senjata akan dievaluasi secara transparan.</p>
            </div>

            <div class="card">
                <i class="fas fa-handshake card-icon"></i>
                <h2 class="rule-title">Kemitraan dengan Komunitas</h2>
                <p>Polisi bekerja sama dengan komunitas untuk menciptakan lingkungan yang aman.</p>
                <p>Melibatkan masyarakat dalam pengambilan keputusan terkait keamanan lingkungan.</p>
            </div>

            <div class="card">
                <i class="fas fa-hand-paper card-icon"></i>
                <h2 class="rule-title">Kebijakan Penahanan</h2>
                <p>Penahanan dilakukan sesuai dengan ketentuan hukum yang berlaku.</p>
                <p>Tersangka diberi akses ke hak-hak dasar selama masa penahanan.</p>
            </div>

            <div class="card">
                <i class="fas fa-book-open card-icon"></i>
                <h2 class="rule-title">Transparansi dan Akuntabilitas</h2>
                <p>Polisi berkomitmen untuk bertindak transparan dalam setiap penanganan kasus.</p>
                <p>Setiap pengaduan masyarakat diproses secara akuntabel.</p>
            </div>

            <div class="card">
                <i class="fas fa-user-lock card-icon"></i>
                <h2 class="rule-title">Privasi Data</h2>
                <p>Informasi pribadi masyarakat dijaga dengan ketat sesuai peraturan privasi.</p>
                <p>Penggunaan data hanya untuk keperluan penegakan hukum.</p>
            </div>
        </div>

        <p class="thank-you">Terima kasih atas kepercayaan Anda. Polisi siap melayani dan melindungi masyarakat.</p>
    </div>
</body>
</html>
