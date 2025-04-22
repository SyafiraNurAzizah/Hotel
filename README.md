<h1>Hotel</h1>

<br>

<p>Hotel adalah platform berbasis web yang digunakan untuk melakukan reservasi dan mengecek ketersediaan kamar di hotel.</p>

<br>

<h3>Stack yang Digunakan</h3>
<p>Hotel dikembangkan menggunakan:</p>
<ul>
    <li><b>Framework</b>: Laravel (PHP)</li>
    <li><b>Database</b>: MySQL</li>
    <li><b>Front-End</b>: HTML, CSS, Bootstrap, Javascript</li>
    <li><b>Autentikasi</b>: Laravel Authentication</li>
    <li><b>Penyimpanan Gambar</b>: Laravel Storage</li>
</ul>

<br>

<h3>Fitur Utama</h3>
<ul>
    <li><b>Registrasi & Login Pengguna</b>: Pengguna dapat membuat akun dan masuk untuk bisa melakukan reservasi dan memberikan ulasan.</li>
    <li><b>Reservasi Kamar</b>: Pengunjung dapat memesan kamar secara online berdasarkan tanggal, tipe kamar, dan jumlah tamu.</li>
    <li><b>Reservasi Ruang Meeting & Ballroom</b>: Fitur untuk memesan ruang rapat, seminar, atau ballroom untuk keperluan acara.</li>
    <li><b>Reservasi Acara Wedding</b>: Fitur pemesanan paket pernikahan lengkap dengan venue dan layanan pendukung.</li>
    <li><b>Review & Rating Tamu</b>: Tamu dapat memberikan ulasan dan penilaian terhadap layanan dan fasilitas hotel.</li>
    <li><b>Lokasi & Kontak</b>: Menampilkan alamat hotel, peta lokasi, dan informasi kontak yang bisa dihubungi.</li>
    <li><b>Halaman Profil Pengunjung</b>: Pengguna dapat melihat dan mengelola riwayat pemesanan serta data pribadi.</li>
</ul>

<br>

<h3>Instalasi</h3>
<p>Ikuti langkah-langkah berikut untuk menjalankan proyek ini secara lokal:</p>

```bash
# Clone repositori ini
git clone https://github.com/SyafiraNurAzizah/Hotel.git

# Masuk ke direktori proyek
cd hotel

# Buat file konfigurasi .env berdasarkan .env.example
cp .env.example .env

# Generate application key
php artisan key:generate

# Jalankan migrasi database
php artisan migrate --seed

# Jalankan server Laravel
php artisan serve
```

<p>Akses website melalui http://127.0.0.1:8000.</p>
