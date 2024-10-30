@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/hotel.css') }}">
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
                                <img src="{{ asset('/img/hotels/' . $item->foto_hotel) }}" alt="Gambar Hotel {{ $item->nama_cabang }}" class="room-image">
                                <div class="ri-text">
                                    <!-- Nama cabang hotel -->
                                    <h3>{{ $item->nama_cabang }}</h3>
                                    <!-- Tautan menuju detail kamar hotel -->
                                    <a href="{{ route('rooms', ['location' => strtolower($item->nama_cabang)]) }}" class="primary-btn">More Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
    
            <div class="row">
                <!-- Hasil Pencarian Meetings -->
                <div class="col-lg-12">
                    <h2>Meetings Results</h2>
                </div>
                @if($meetings->isEmpty())
                    <div class="col-lg-12">
                        <p>Tidak ada hasil untuk pencarian "{{ request('query') }}" di bagian meetings.</p>
                    </div>
                @else
                    @foreach ($meetings as $meeting)
                        <div class="col-lg-4 col-md-6">
                            <div class="room-item">
                                <!-- Menampilkan gambar atau informasi meetings -->
                                <img src="{{ asset('/img/meetings/' . $meeting->foto_meeting) }}" alt="Meeting {{ $meeting->meeting_name }}" class="room-image">
                                <div class="ri-text">
                                    <!-- Nama meeting -->
                                    <h3>{{ $meeting->meeting_name }}</h3>
                                    <!-- Tautan menuju detail meeting -->
                                    <a href="{{ route('meetings.show', ['id' => $meeting->id]) }}" class="primary-btn">More Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
    
            <div class="row">
                <!-- Hasil Pencarian Weddings -->
                <div class="col-lg-12">
                    <h2>Weddings Results</h2>
                </div>
                @if($weddings->isEmpty())
                    <div class="col-lg-12">
                        <p>Tidak ada hasil untuk pencarian "{{ request('query') }}" di bagian weddings.</p>
                    </div>
                @else
                    @foreach ($weddings as $wedding)
                        <div class="col-lg-4 col-md-6">
                            <div class="room-item">
                                <!-- Menampilkan gambar atau informasi weddings -->
                                <img src="{{ asset('/img/weddings/' . $wedding->foto_wedding) }}" alt="Wedding {{ $wedding->wedding_name }}" class="room-image">
                                <div class="ri-text">
                                    <!-- Nama wedding -->
                                    <h3>{{ $wedding->wedding_name }}</h3>
                                    <!-- Tautan menuju detail wedding -->
                                    <a href="{{ route('weddings.show', ['id' => $wedding->id]) }}" class="primary-btn">More Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    

@endsection
