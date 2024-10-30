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
                                <!-- Tampilkan query yang sudah dicari jika ada -->
                                <input type="text" name="query" placeholder="Search Hotel..." class="search-input" value="{{ request('query') }}">
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
                @if($hotels->isEmpty())
                    <div class="col-lg-12">
                        <p>Tidak ada hasil untuk pencarian "{{ request('query') }}"</p>
                    </div>
                @else
                    @foreach ($hotels as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="room-item">
                            <img src="{{ asset('/img/hotels/' . $item->foto_hotel) }}" alt="" class="room-image">
                            <div class="ri-text">
                                <h3>{{ $item->nama_cabang }}</h3>
                                <a href="{{ route('rooms', ['location' => strtolower($item->nama_cabang)]) }}" class="primary-btn">More Details</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection
