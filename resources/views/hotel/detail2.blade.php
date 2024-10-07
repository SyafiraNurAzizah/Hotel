@extends('layouts.app')

@push('styles')
    <style>
        body {
            background-color: #f8f9fa; /* Warna latar belakang lembut */
            font-family: 'Arial', sans-serif; /* Font yang bersih dan modern */
        }

        .img-fluid {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15);
            max-height: 380px;
            transition: transform 0.3s; /* Animasi saat hover */
        }

        .img-fluid:hover {
            transform: scale(1.05); /* Efek zoom saat hover */
        }

        .breadcrumb-section {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 150px 0;
            position: relative;
            z-index: 1;
        }
        
        .breadcrumb-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: -1;
        }
        
        .breadcrumb-text h2, .breadcrumb-text p {
            color: white;
            text-align: center;
        }
        
        .breadcrumb-text {
            max-width: 800px;
            margin: 0 auto;
        }

        ul.list-unstyled {
            font-size: 1rem;
            color: #495057;
            margin-top: 1rem;
        }

        .text-primary {
            font-size: 1.2rem;
            font-weight: bold;
            color: #007bff; /* Warna biru untuk teks harga */
        }

        .room-section {
            display: flex;
            align-items: flex-start;
            margin-bottom: 3rem;
            background-color: #ffffff; /* Latar belakang putih untuk setiap section */
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Bayangan halus */
        }

        .room-section img {
            flex: 1;
            margin-right: 2rem;
            max-width: 45%;
        }

        h4 {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333; /* Warna teks lebih gelap untuk kontras */
        }

        .btn-primary {
            padding: 0.8rem 1.5rem;
            font-size: 1.1rem;
            margin-top: 2rem;
            background-color: #007bff; /* Warna tombol biru */
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s; /* Efek transisi */
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Warna tombol saat hover */
        }

        .room-details {
            flex: 1;
        }

        /* Tambahkan media query untuk responsif */
        @media (max-width: 768px) {
            .room-section {
                flex-direction: column; /* Ubah arah flex menjadi kolom untuk perangkat kecil */
                align-items: center;
            }
            .room-section img {
                margin-right: 0;
                margin-bottom: 1rem; /* Jarak di bawah gambar */
            }
        }
    </style>
@endpush

@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section" style="background-image: url('{{ asset('img/hotels/hotel-bg.jpg') }}');">
    <div class="container-atas">
        <div class="row">
            <div class="breadcrumb-text">
                <h2>Jakarta</h2>
                <p style="color: white;">Temukan kenyamanan dan kemewahan di kamar hotel kami, dengan pilihan dari kelas Standard hingga Suite.</p>
                <button onclick="location.href='detail1.html'" style="background: none; border: none; color: white; cursor: pointer; transition: color 0.3s ease;" onmouseover="this.style.color='#ccc';" onmouseout="this.style.color='white';">Room Details</button>
                <button onclick="location.href='/fasilitas/jkt'" style="background: none; border: none; color: white; cursor: pointer; transition: color 0.3s ease;" onmouseover="this.style.color='#ccc';" onmouseout="this.style.color='white';">Fasilitas</button>
            </div>
            
            
        
                
                
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<section class="room-details-section spad">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="display-4 mb-12">Kamar Hotel Kami</h2>
                <p class="text-muted">Pilih dari berbagai kelas kamar yang sesuai dengan kebutuhan dan anggaran Anda, mulai dari Standard Room yang ekonomis hingga Suite Room yang mewah.</p>
            </div>
        </div>

        <!-- Standard Room -->
        <div class="room-section">
            <img src="{{ asset('img/room/standar-room.jpg') }}" class="img-fluid" alt="Standard Room">
            <div class="room-details">
                <h4>Standard Room</h4>
                <ul class="list-unstyled mb-4">
                    <li><strong>Kapasitas:</strong> 2 orang</li>
                    <li><strong>Ukuran Kamar:</strong> 20 meter persegi</li>
                    <li><strong>Fasilitas Utama:</strong>
                        <ul>
                            <li>Tempat tidur queen size</li>
                            <li>Televisi LED 32 inci</li>
                            <li>Wi-Fi gratis</li>
                            <li>AC</li>
                        </ul>
                    </li>
                    <li><strong>Layanan Tambahan:</strong>
                        <ul>
                            <li>Pelayanan kamar 12 jam</li>
                            <li>Penatu dan dry cleaning (biaya tambahan)</li>
                        </ul>
                        <p class="text-primary">Standard Room: Rp 800.000,- / malam</p>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Superior Room -->
        <div class="room-section">
            <img src="{{ asset('img/room/superrior-room.jpg') }}" class="img-fluid" alt="Superior Room">
            <div class="room-details">
                <h4>Superior Room</h4>
                <ul class="list-unstyled mb-4">
                    <li><strong>Kapasitas:</strong> 2 hingga 3 orang</li>
                    <li><strong>Ukuran Kamar:</strong> 30 meter persegi</li>
                    <li><strong>Fasilitas Utama:</strong>
                        <ul>
                            <li>Tempat tidur king size</li>
                            <li>Televisi LED 40 inci</li>
                            <li>Wi-Fi berkecepatan tinggi</li>
                            <li>AC</li>
                            <li>Minibar</li>
                        </ul>
                    </li>
                    <li><strong>Layanan Tambahan:</strong>
                        <ul>
                            <li>Pelayanan kamar 24 jam</li>
                            <li>Penatu dan dry cleaning</li>
                            <li>Transportasi bandara (biaya tambahan)</li>
                        </ul>
                        <p class="text-primary">Superior Room: Rp 1.200.000,- / malam</p>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Suite Room -->
        <div class="room-section">
            <img src="{{ asset('img/room/suite-room.jpg') }}" class="img-fluid" alt="Suite Room">
            <div class="room-details">
                <h4>Suite Room</h4>
                <ul class="list-unstyled mb-4">
                    <li><strong>Kapasitas:</strong> 2 hingga 4 orang</li>
                    <li><strong>Ukuran Kamar:</strong> 50 meter persegi</li>
                    <li><strong>Fasilitas Utama:</strong>
                        <ul>
                            <li>Tempat tidur king size</li>
                            <li>Televisi LED 50 inci</li>
                            <li>Wi-Fi berkecepatan tinggi</li>
                            <li>AC</li>
                            <li>Minibar lengkap</li>
                            <li>Kamar mandi pribadi dengan bathtub</li>
                        </ul>
                    </li>
                    <li><strong>Layanan Tambahan:</strong>
                        <ul>
                            <li>Pelayanan kamar 24 jam</li>
                            <li>Penatu dan dry cleaning</li>
                            <li>Transportasi bandara gratis</li>
                            <li>Akses ke lounge eksklusif</li>
                        </ul>
                        <p class="text-primary">Suite Room: Rp 2.500.000,- / malam</p>
                    </li>
                </ul>
            </div>
        </div>

        <div style="text-align: right;">
            <a href="#" class="btn btn-primary">Booking Now</a>
        </div>
        
    </div>
</section>

@endsection
