@extends('layouts.app')

{{-- Custom CSS untuk ukuran gambar --}}
@push('styles')
    <style>
        .meeting-section img {
            width: 100%;
            height: 250px; /* Atur tinggi sesuai kebutuhan */
            object-fit: cover; /* Agar gambar tidak terdistorsi */
        }
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
        
    </style>
@endpush
@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section" style="background-image: url('{{ asset('img/meetings/meeting-bg.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>Meetings</h2>
                    <p>Explore our latest meetings and stay updated with the latest events and schedules.</p>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Breadcrumb Section End -->

<!-- Meetings Section Begin -->
<section class="meeting-section spad">
    <div class="container">
        <div class="row">
            <!-- Contoh item Meeting -->
            <div class="col-lg-4 col-md-6">
                <img src="{{ asset('img/meetings/meeting-1.jpg') }}" alt="Business Strategy Conference 2024" class="img-fluid mb-3">
                <div class="mi-text">
                    <span class="m-tag">Conference</span>
                    <h4><a href="meeting/detail-bussines.html">Business Strategy Conference 2024</a></h4>
                    <div class="m-time"><i class="icon_clock_alt"></i> 12th March, 2024</div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <img src="{{ asset('img/meetings/meeting-3.jpg') }}" alt="Business Strategy Conference 2024" class="img-fluid mb-3">
                <div class="mi-text">
                    <span class="m-tag">Workshop</span>
                    <h4><a href="./meeting-details.html">Digital Marketing Workshop</a></h4>
                    <div class="m-time"><i class="icon_clock_alt"></i> 12th March, 2024</div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <img src="{{ asset('img/meetings/meeting-2.jpg') }}" alt="Business Strategy Conference 2024" class="img-fluid mb-3">
                <div class="mi-text">
                    <span class="m-tag">Networking</span>
                    <h4><a href="./meeting-details.html">Tech Leaders Networking Event</a></h4>
                    <div class="m-time"><i class="icon_clock_alt"></i> 12th March, 2024</div>
                </div>
            </div>
            

            <!-- Tambah lebih banyak item sesuai kebutuhan -->
            <div class="col-lg-12">
                <div class="load-more">
                    <a href="#" class="btn btn-primary">Booking Now</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Meetings Section End -->

@endsection
