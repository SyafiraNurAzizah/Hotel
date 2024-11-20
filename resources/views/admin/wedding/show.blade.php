@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/wedding.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .breadcrumb-section {
            /* padding: 80px 0; */
            position: relative;
        }

        .breadcrumb-text {
            text-align: center;
            color: rgb(30, 28, 28);
        }

        .breadcrumb-text h2 {
            font-size: 40px;
            margin-bottom: 20px;
            font-weight: bold;
        }

    </style>
@endpush

@section('content')
    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <h2>{{ $weddings->judul }}</h2>
                        <div class="bt-option">
                            <a href="{{ route('admin.wedding.index') }}"><i class="fas fa-arrow-left"></i> Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

   <!-- Wedding Details Section Begin -->
   <section class="m-5">
    <div class="container">
        <!-- Gambar Wedding -->
        <div class="row justify-content-center mb-5">
            <div class="col-md-6 text-center">
                <img src="{{ asset('/storage/uploads/' . $weddings->gambar) }}" 
                     alt="{{ $weddings->judul }}" 
                     class="img-fluid rounded shadow">
            </div>
        </div>
        
        <!-- Detail Deskripsi -->
        <div class="row">
            <!-- Kolom Deskripsi Kanan -->
            <div class="col-md-5">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-info-circle me-2"></i> Wedding Details</h5>
                        <p class="card-text"><i class="fas fa-money-bill-wave me-2"></i> Harga: 
                            <span class="fw-bold text-primary">{{ $weddings->harga }}</span>
                        </p>
                        <p class="card-text"><i class="fas fa-users me-2"></i> Kapasitas: 
                            <span class="fw-bold text-primary">{{ $weddings->kapasitas }}</span>
                        </p>
                        <div class="d-grid gap-2 mt-4">
                            <a href="{{ route('wedding.edit', $weddings->id) }}" class="btn btn-outline-secondary mb-2">
                                <i class="fas fa-edit me-2"></i>Edit
                            </a>
                            <form action="{{ route('wedding.destroy', $weddings->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash-alt me-2"></i>Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Kolom Deskripsi Kiri -->
            <div class="col-md-7">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-gift me-2"></i> Paket Wedding</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <i class="fas fa-box me-2"></i> <strong>{{ $weddings->judul_paket1 }}</strong>: {{ $weddings->paket1 }}
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-box me-2"></i> <strong>{{ $weddings->judul_paket2 }}</strong>: {{ $weddings->paket2 }}
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-box me-2"></i> <strong>{{ $weddings->judul_paket3 }}</strong>: {{ $weddings->paket3 }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Wedding Details Section End -->
@endsection