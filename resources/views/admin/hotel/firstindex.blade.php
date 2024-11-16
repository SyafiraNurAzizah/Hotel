@extends('layouts.app')

@push('styles')
<!-- Tambahkan link ke Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
/* Styling Card */
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
    height: 250px; /* Tinggi card disesuaikan agar konten selalu rata */
    font-size: 18px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    background-color: #f8f9fa; /* Warna latar belakang yang lebih lembut */
    border: none; /* Hilangkan border bawaan */
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 8px; /* Bikin sudut membulat */
}

.card-body {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

/* Tambahkan Efek Hover */
.card:hover {
    transform: translateY(-8px);
    box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2);
}

/* Styling Tombol */
.btn-primary {
    background-color: #dfa974;
    border-color: #dfa974;
    margin-top: auto;
    transition: background-color 0.3s ease;
}

.btn-primary:hover {
    background-color: #c87d56;
    border-color: #c87d56;
}

/* Styling Ikon */
.card-icon {
    font-size: 40px;
    color: #dfa974;
    margin-bottom: 15px;
}
</style>
@endpush

@section('content')

<br><br><br><br><br><br>
<div class="container">
    <div class="row">
        <!-- Card untuk Hotel Jakarta -->
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <!-- Tambahkan Ikon di Atas Judul -->
                    <i class="fas fa-building card-icon"></i>
                    <h4 class="card-title"> Cabang Jakarta</h4>
                    <p class="card-text">Lihat semua booking di hotel cabang Jakarta.</p>
                    <a href="{{ route('admin.hotel.index', 'jakarta') }}" class="btn btn-primary">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>

        <!-- Card untuk Hotel Semarang -->
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <!-- Tambahkan Ikon di Atas Judul -->
                    <i class="fas fa-hotel card-icon"></i>
                    <h4 class="card-title">Cabang Semarang</h4>
                    <p class="card-text">Lihat semua booking di hotel cabang Semarang.</p>
                    <a href="{{ route('admin.hotel.index', 'semarang') }}" class="btn btn-primary">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>

        <!-- Card untuk Hotel Bogor -->
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <!-- Tambahkan Ikon di Atas Judul -->
                    <i class="fas fa-city card-icon"></i>
                    <h4 class="card-title">Cabang Hotel Bogor</h4>
                    <p class="card-text">Lihat semua booking di hotel cabang Bogor.</p>
                    <a href="{{ route('admin.hotel.index', 'bogor') }}" class="btn btn-primary">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br><br><br><br><br><br><br
@endsection
