@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detail Wedding Package</h1>

    <div class="card mb-4">
        <img src="{{ asset('public/img/' . $wedding->gambar) }}" class="card-img-top" alt="Gambar Paket" style="max-width: 600px;">
        <div class="card-body">
            <h5 class="card-title">{{ $wedding->paket }}</h5>
            <p class="card-text"><strong>Harga:</strong> Rp {{ number_format($wedding->harga, 2) }}</p>
            <p class="card-text"><strong>Kapasitas:</strong> {{ $wedding->kapasitas }} orang</p>
            <p class="card-text">{{ $wedding->deskripsi }}</p>
            <a href="{{ route('weddings.index') }}" class="btn btn-primary">Kembali ke Daftar</a>
        </div>
    </div>
</div>
@endsection
