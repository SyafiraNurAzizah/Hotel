@extends('layouts.app')

@push('styles')
    <style>
       
        .breadcrumb-section {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 150px 0; /* Menambah padding untuk membuat gambar latar lebih besar */
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
            background: rgba(0, 0, 0, 0.7); /* Membuat overlay lebih gelap dengan opacity 0.7 */
            z-index: -1;
        }
        
        .breadcrumb-text h2, .breadcrumb-text p {
            color: white; /* Agar teks terlihat jelas di atas gambar */
            text-align: center; /* Membuat teks berada di tengah */
        }
        
        .breadcrumb-text {
            max-width: 800px;
            margin: 0 auto; /* Agar teks berada di tengah kontainer */
        }
        


ul.list-unstyled {
    font-size: 1rem;
    color: #495057;
}

.text-primary {
    font-size: 1.2rem;
    font-weight: bold;
}

.card {
    border: none;
    background-color: #ffffff;
}

.blockquote-footer {
    color: #6c757d;
}

.card-body {
    background-color: #f1f3f5;
    border-radius: 5px;
}

.card-body blockquote {
    margin: 0;
}

    </style>
@endpush

@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section" style="background-image: url('{{ asset('img/meetings/meeting-bg.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="container-atas">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>Detail Meetings</h2>
                    <p>Explore our latest meetings and stay updated with the latest events and schedules.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->



    <section class="room-details-section spad">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-6">
                    <img src="img/meeting-room.jpg" class="img-fluid rounded" alt="Premium Meeting Room">
                </div>
                <div class="col-lg-6">
                    <h2 class="display-4 mb-4">Premium Meeting Room</h2>
                    <p class="text-muted">Ideal untuk pertemuan bisnis, konferensi, atau acara eksklusif lainnya. Desain modern dan fasilitas lengkap yang menjamin kenyamanan serta kesuksesan acara Anda.</p>
        
                    <h3 class="mt-4">Fasilitas</h3>
                    <ul class="list-unstyled mb-4">
                        <li><strong>Kapasitas:</strong> Hingga 50 orang</li>
                        <li><strong>Ukuran Ruangan:</strong> 100 meter persegi</li>
                        <li><strong>Fasilitas Utama:</strong>
                            <ul>
                                <li>Proyektor & layar LCD</li>
                                <li>Sistem audio berkualitas tinggi</li>
                                <li>Papan tulis interaktif</li>
                                <li>Wi-Fi berkecepatan tinggi</li>
                                <li>AC yang terkontrol</li>
                            </ul>
                        </li>
                        <li><strong>Kelengkapan:</strong>
                            <ul>
                                <li>Meja konferensi & kursi nyaman</li>
                                <li>Meja registrasi</li>
                                <li>Kursi tambahan</li>
                            </ul>
                        </li>
                        <li><strong>Kebutuhan Tambahan:</strong>
                            <ul>
                                <li>Katering & coffee break</li>
                                <li>Ruangan istirahat</li>
                                <li>Layanan fotokopi & printer</li>
                            </ul>
                        </li>
                    </ul>
        
                    <h3>Harga</h3>
                    <p class="text-primary">Rp 2.000.000,- / 4 jam<br>Rp 3.500.000,- / 8 jam</p>
        
                    <h3>Reservasi</h3>
                    <p>Hubungi kami di <a href="tel:02112345678">(021) 1234-5678</a> atau email <a href="mailto:info@meetingroom.com">info@meetingroom.com</a>.</p>
                </div>
            </div>
        
            <div class="row mt-5">
                <div class="col-lg-12">
                    <h3 class="mb-4">Testimoni Pelanggan</h3>
                    <div class="card mb-3 shadow-sm">
                        <div class="card-body">
                            <blockquote class="blockquote">
                                <p>"Ruangan yang luas, fasilitas lengkap, dan staf yang sangat membantu. Pertemuan bisnis kami berjalan lancar tanpa hambatan."</p>
                                <footer class="blockquote-footer">John Doe, CEO <cite title="Source Title">PT Sukses Makmur</cite></footer>
                            </blockquote>
                        </div>
                    </div>
                    <div class="card mb-3 shadow-sm">
                        <div class="card-body">
                            <blockquote class="blockquote">
                                <p>"Tempat ini adalah pilihan terbaik untuk acara rapat dan pelatihan. Fasilitasnya memadai dan mudah diakses."</p>
                                <footer class="blockquote-footer">Jane Smith, Manager <cite title="Source Title">XYZ Corp</cite></footer>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
    </section>

@endsection
