@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/meetings.css') }}">
@endpush

@section('content') 
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Hotels</h2>
                        {{-- <div class="bt-option">
                            <span>Pilih lokasi & tempat rapat terbaik yang pernah ada dengan fasilitas terlengkap!</span>
                        </div> --}}
                        <!-- Form Pencarian -->
                        <div class="search-container mt-3">
                            <form action="{{ route('search.hotel') }}" method="GET">
                                <input type="text" name="query" placeholder="Cari lokasi atau fasilitas..." class="search-input" value="{{ request('query') }}">
                                <button type="submit" class="search-btn">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>
                        <!-- End of Form Pencarian -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="rooms-section spad">
        <div class="container">
            <div class="row">
                @if($hotels->isEmpty())
                    <div class="col-lg-12">
                        <p style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin-bottom: 200px;">Tidak ada hasil untuk pencarian "{{ request('query') }}"</p>
                    </div>
                @else
                    @foreach ($hotels as $item)
                    <div class="room-item">
                        <img src="{{ asset('/img/hotels/' . $item->foto_hotel) }}" alt="" class="room-image">
                        <div class="ri-text">
                            <h3>{{ $item->nama_cabang }}</h3>
                            <a href="{{ route('rooms', ['location' => strtolower($item->nama_cabang)]) }}" class="primary-btn">More Details</a>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
            @if(session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </section>
@endsection     
