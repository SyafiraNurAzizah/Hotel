@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin-meeting.css') }}">
@endpush

@section('content')
    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container mt-6">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text m-5">
                        <h2>Edit Meeting Room</h2>
                        <div class="bt-option">
                            <a href="{{ route('index') }}">Beranda</a>
                            <a href="{{ route('meetings.index') }}">Data Meetings</a>
                            <span>Edit</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <section>
        <div class="container mt-6">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">
                            <h3>Edit Data: {{ $meeting->nama_ruang }}</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('meetings.update', $meeting->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                
                                <div class="mb-3">
                                    <label for="nama_ruang" class="form-label">Nama Ruang</label>
                                    <input type="text" name="nama_ruang" id="nama_ruang" class="form-control" value="{{ old('nama_ruang', $meeting->nama_ruang) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="harga_per_jam" class="form-label">Harga per Jam</label>
                                    <input type="number" name="harga_per_jam" id="harga_per_jam" class="form-control" value="{{ old('harga_per_jam', $meeting->harga_per_jam) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="jumlah_ruang_tersedia" class="form-label">Jumlah Ruang Tersedia</label>
                                    <input type="number" name="jumlah_ruang_tersedia" id="jumlah_ruang_tersedia" class="form-control" value="{{ old('jumlah_ruang_tersedia', $meeting->jumlah_ruang_tersedia) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="kapasitas" class="form-label">Kapasitas</label>
                                    <input type="number" name="kapasitas" id="kapasitas" class="form-control" value="{{ old('kapasitas', $meeting->kapasitas) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="Available" {{ old('status', $meeting->status) == 'Available' ? 'selected' : '' }}>Available</option>
                                        <option value="Unavailable" {{ old('status', $meeting->status) == 'Unavailable' ? 'selected' : '' }}>Unavailable</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="foto" class="form-label">Foto</label>
                                    <input type="file" name="foto" id="foto" class="form-control">
                                    @if($meeting->foto)
                                        <img src="{{ asset('storage/' . $meeting->foto) }}" alt="{{ $meeting->nama_ruang }}" width="150" class="mt-2">
                                    @endif
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Update Meeting Room</button>
                                    <a href="{{ route('meetings.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
