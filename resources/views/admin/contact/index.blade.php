@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/wedding.css') }}">
@endpush

@section('content')
    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container mt-6">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text m-5">
                        <h2>Admin Contact</h2>
                        <div class="bt-option">
                            <a href="{{ route('index') }}">Beranda</a>
                            <span>Data Contact</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <section class="my-5">
        <div class="container">

            {{-- <table class="table table-custom">
                <thead class="thead-custom">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Pesan</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($contact as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->Nama }}</td>
                            <td>{{ $item->Email }}</td>
                            <td>{{ $item->Pesan }}</td>
                            <td>{{ $item->created_at->format('d-m-Y, H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="no-data">No data available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table> --}}

            {{-- @forelse ($contact as $item)
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->name }}</h5>
                        <p class="card-text">{{ $item->email }}</p>
                        <p class="card-text">{{ $item->message }}</p>
                        <p class="card-text">{{ $item->created_at->format('d-m-Y, H:i') }}</p>
                    </div>
                </div> --}}


            <div class="row">
                <div class="col-lg-4">
                    <div class="card shadow-lg p-3" style="widht: 18rem; border-radius: 20px;">
                        <div class="ri-pic">
                            <img src="img/room/avatar/avatar-1.jpg" alt="">
                        </div>
                        @forelse ($contact as $item)
                        <div class="ri-text">
                            <h4>{{ $item->Nama }}</h4>
                            <p>{{ $item->created_at->format('Y-m-d') }}</p>
                            <h6 class="mt-2">{{ $item->Pesan }}</h6>

                            <div class="btn-contact d-flex justify-content-between align-items-center my-3">
                                <a href="https://wa.me/+628812721410?text=Halo%2C%20saya%20tertarik%20dengan%20paket%20wedding%20Anda."
                                    target="_blank"
                                    class="btn btn-outline-secondary w-35 contact-btn d-flex align-items-center">
                                    <i class="icon_phone me-2" style="margin-right: 8px;"></i> Delete
                                </a>
                                <a href="mailto:istiqomahkhoerunnisa@gmail.com?subject=Informasi%20Paket%20Wedding&body=Halo,%20saya%20ingin%20tahu%20lebih%20lanjut%20tentang%20paket%20wedding%20Anda."
                                    class="btn btn-outline-secondary w-35 gmail-btn d-flx align-items-center">
                                    <i class="icon_mail_alt" style="margin-right: 8px;"></i> Gmail </a>

                            </div>
                        </div>
                        @empty
                            <p>No data available</p>
                        @endforelse
                        
                    </div>
                </div>


            </div>

        </div>
    </section>

    <!-- Breadcrumb Section End -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
