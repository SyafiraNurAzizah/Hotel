@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">

{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
@endpush

@section('content')

<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>{{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}</h2>
                    <div class="bt-option">
                        <span>{{ Auth::user()->email }}</span>
                    </div>
                    <div class="bt-option">
                        <!-- Tombol untuk menampilkan popup profil -->
                        <button type="button" class="viewProfileButton" data-bs-toggle="modal" data-bs-target="#viewProfileModal">Profil</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="horizontal-line"></div>

<!-- Modal Popup untuk Menampilkan Profil Pengguna -->
<div class="modal fade" id="viewProfileModal" tabindex="-1" aria-labelledby="viewProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            {{-- <div class="modal-header">
                <h5 class="modal-title" id="viewProfileModalLabel">Profil Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> --}}
            <p class="profile-title">Detail profil</p>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <i class="bi bi-x"></i>
            </button>

            <div class="modal-body">
                <!-- Informasi Profil Pengguna -->
                <p><strong>Nama:</strong> {{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}</p>
                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                <p><strong>Alamat:</strong> {{ Auth::user()->profile_user->alamat }}</p>
                <p><strong>No Telepon:</strong> {{ Auth::user()->no_telp }}</p>
            </div>

            <button type="button" class="viewEditProfileButton" data-bs-toggle="modal" data-bs-target="#viewEditProfileModal">Edit Profil</button>

        </div>
    </div>
</div>




<!-- Modal Popup untuk Mengedit Profil Pengguna -->
<div class="modal fade" id="viewEditProfileModal" tabindex="-1" aria-labelledby="viewEditProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewEditProfileModalLabel">Edit Profil Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- <form action="{{ route('profile.update') }}" method="POST"> --}}
                <form action="#" method="POST">
                    @csrf
                    @method('PUT')  <!-- Menggunakan metode PUT untuk mengupdate data profil -->
                    <div class="form-group">
                        <label for="firstname">Nama Depan</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" value="{{ Auth::user()->firstname }}" required>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Nama Belakang</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" value="{{ Auth::user()->lastname }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="{{ Auth::user()->alamat }}" required>
                    </div>
                    <div class="form-group">
                        <label for="no_telp">Nomor Telepon</label>
                        <input type="text" class="form-control" id="no_telp" name="no_telp" value="{{ Auth::user()->no_telp }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endpush