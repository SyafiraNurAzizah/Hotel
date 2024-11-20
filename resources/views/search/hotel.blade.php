@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/hotel/hotel.css') }}">
@endpush

@section('content')

    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <div class="search-container">
                            <form action="{{ route('search') }}" method="GET">
                                <input type="text" name="query" placeholder="Cari..." class="search-input" value="{{ request('query') }}">
                                <button type="submit" class="search-btn">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>
                        <h2>Hotels</h2>
                    </div>                    
                </div>
            </div>
        </div>
    </div>

    <br><br>

    <section class="rooms-section spad">
        <div class="container">
            <div class="row">
                <!-- Hasil Pencarian Hotels -->
                <div class="col-lg-12">
                    <h2>Hotel Results</h2>
                </div>
                @if($hotels->isEmpty())
                    <div class="col-lg-12">
                        <p>Tidak ada hasil untuk pencarian "{{ request('query') }}" di bagian hotel.</p>
                    </div>
                @else
                    @foreach ($hotels as $item)
                        <div class="col-lg-4 col-md-6">
                            <div class="room-item">
                                <!-- Menampilkan gambar hotel -->
                                <img src="{{ asset('/img/meetings/rooms' . $item->foto_hotel) }}" alt="Gambar Hotel {{ $item->nama_cabang }}" class="room-image">
                                <div class="ri-text">
                                    <!-- Nama cabang hotel -->
                                    <h3>{{ $item->hotel_id }}</h3>
                                    <!-- Tautan menuju detail kamar hotel -->
                                    <a href="{{ route('rooms', ['location' => strtolower($item->nama_cabang)]) }}" class="primary-btn">More Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
    
    

@endsection
