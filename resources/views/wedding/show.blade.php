@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detail Wedding Package</h1>

    <div class="card mb-4">
        <img src="{{ asset('../public/img/' . $weddings->gambar) }}" class="card-img-top" alt="Gambar Paket" style="max-width: 600px;">
        <div class="card-body">
            <h5 class="card-title">{{ $weddings->paket }}</h5>
            <p class="card-text"><strong>Harga:</strong> Rp {{ number_format($weddings->harga, 2) }}</p>
            <p class="card-text"><strong>Kapasitas:</strong> {{ $weddings->kapasitas }} orang</p>
            <p class="card-text">{{ $weddings->deskripsi }}</p>
            <a href="{{ route('wedding.index') }}" class="btn btn-primary">Kembali ke Daftar</a>
        </div>
    </div>
</div>
@endsection
