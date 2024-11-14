@extends('layouts.app')

@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text m-5">
                    <h2>Meeting Details</h2>
                    <div class="bt-option">
                        <a href="{{ route('index') }}">Beranda</a>
                        <span>Data Meetings</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Meeting Details Section Begin -->
<div class="container-xl px-4 mt-n10">
    <div class="row card h-100 p-3">
        <div class="container mt-6">
            <div class="modal-body">
                <div class="form-group">
                    <label for="hotel_id">Hotel</label>
                    <p>{{ $meeting->hotel->nama_cabang }}</p>
                </div>

                <div class="form-group mt-3">
                    <label for="nama_ruang">Nama Ruang</label>
                    <p>{{ $meeting->nama_ruang }}</p>
                </div>

                <div class="form-group mt-3">
                    <label for="harga_per_jam">Harga per Jam</label>
                    <p>{{ number_format($meeting->harga_per_jam, 2) }}</p>
                </div>

                <div class="form-group mt-3">
                    <label for="jumlah_ruang_tersedia">Jumlah Ruang Tersedia</label>
                    <p>{{ $meeting->jumlah_ruang_tersedia }}</p>
                </div>

                <div class="form-group mt-3">
                    <label for="status">Status</label>
                    <p>{{ $meeting->status == 'aktif' ? 'Aktif' : 'Non Aktif' }}</p>
                </div>

                <div class="form-group mt-3">
                    <label for="kapasitas">Kapasitas</label>
                    <p>{{ $meeting->kapasitas }}</p>
                </div>

                <div class="form-group mt-3">
                    <label for="ukuran_ruangan">Ukuran Ruangan</label>
                    <p>{{ $meeting->ukuran_ruang }} m²</p>
                </div>

                <div class="form-group mt-3">
                    <label for="fasilitas">Fasilitas Ruangan</label>
                    <p>{{ $meeting->fasilitas }}</p>
                </div>

                <div class="form-group mt-3">
                    <label for="foto">Foto</label>
                    <div>
                        @if($meeting->foto)
                            <img src="{{ asset('storage/' . $meeting->foto) }}" alt="{{ $meeting->nama_ruang }}" width="300">
                        @else
                            <p>No photo available</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ route('admin.meeting.index') }}" class="btn btn-secondary">Kembali</a>
                <a href="{{ route('admin.meeting.edit', $meeting->id) }}" class="btn btn-primary">Edit</a>
            </div>
        </div>
    </div>
</div>
@endsection
