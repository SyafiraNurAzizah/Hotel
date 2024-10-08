@extends('layouts.app')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text m-5">
                        <h2>Wedding Rooms</h2>
                        <div class="bt-option">
                            <a href="{{ route('index') }}">Beranda</a>
                            <span>Rooms</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Rooms Section Begin -->
    <section class="rooms-section spad">
        <div class="container">
            <div class="row">
                @foreach($weddings as $wedding)
                    <div class="col-lg-4 col-md-6">
                        <div class="room-item">
                            <!-- Mengambil gambar dari database -->
                            <img src="{{ asset($wedding->gambar) }}">

                            <div class="ri-text">
                                <h4>{{ $wedding->judul }}</h4>
                                <h3>
                                    IDR {{ is_numeric($wedding->harga) ? number_format((float) $wedding->harga, 2) : $wedding->harga }} <br>
                                    <span class="text-muted">nett min. {{ $wedding->kapasitas }} guests</span>
                                </h3>
                                
                                
                                <div class="btn-contact d-flex justify-content-between align-items-center my-3">
                                    <a href="#" class="btn btn-outline-secondary w-35 contact-btn d-flex align-items-center">
                                        <i class="icon_phone" style="margin-right: 8px;"></i> Contact
                                    </a>
                                    <a href="#" class="btn btn-outline-secondary w-35 gmail-btn d-flx align-items-center">
                                        <i class="icon_mail_alt" style="margin-right: 8px;"></i> Gmail    </a>
                                </div>

                                <!-- Tombol More Details yang mengarahkan ke modal untuk menampilkan detail wedding -->
                                <button class="primary-btn" style="border: none; background: none;" data-bs-toggle="modal" data-bs-target="#weddingModal-{{ $wedding->id }}">
                                    More Details
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="weddingModal-{{ $wedding->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Wedding Package Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Isi modal dengan detail wedding -->
                                    <div class="card mb-4">
                                        <img src="{{ asset('../public/img/' . $wedding->gambar) }}" class="card-img-top" alt="{{ $wedding->paket }}" style="max-width: 600px;">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $wedding->paket }}</h5>
                                            <p class="card-text"><strong>Harga:</strong> IDR {{ number_format((float)$wedding->harga, 2) }}</p>
                                            <p class="card-text"><strong>Kapasitas:</strong> {{ $wedding->kapasitas }} orang</p>
                                            <p class="card-text">{{ $wedding->deskripsi }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Rooms Section End -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
