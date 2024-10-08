@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Wedding Packages</h1>

    <div class="row">
        @foreach ($weddings as $wedding)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="{{ asset($wedding->gambar) }}" class="card-img-top" alt="{{ $wedding->paket }}" style="max-height: 250px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $wedding->paket }}</h5>
                    <p class="card-text"><strong>Harga:</strong> IDR {{ is_numeric($wedding->harga) ? number_format((float) $wedding->harga, 2) : $wedding->harga }}</p>
                    <p class="card-text"><strong>Kapasitas:</strong> {{ $wedding->kapasitas }} orang</p>
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#weddingModal{{ $wedding->id }}">
                        View Details
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="weddingModal{{ $wedding->id }}" tabindex="-1" aria-labelledby="weddingModalLabel{{ $wedding->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="weddingModalLabel{{ $wedding->id }}">{{ $wedding->paket }} Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="{{ asset($wedding->gambar) }}" class="img-fluid mb-3" alt="{{ $wedding->paket }}">
                        <p><strong>Harga:</strong> IDR {{ is_numeric($wedding->harga) ? number_format((float) $wedding->harga, 2) : $wedding->harga }}</p>
                        <p><strong>Kapasitas:</strong> {{ $wedding->kapasitas }} orang</p>
                        <p><strong>Deskripsi:</strong> {{ $wedding->deskripsi }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a href="{{ route('wedding.index') }}" class="btn btn-primary">Kembali ke Daftar</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Include Bootstrap JS (if not already included in your layout) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
@endsection
