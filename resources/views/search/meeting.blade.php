@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/meeting.css') }}">
@endpush

@section('content')

    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <div class="search-container">
                            <form action="{{ route('search.meeting') }}" method="GET">
                                <input type="text" name="query" placeholder="Cari ruang meeting..." class="search-input" value="{{ request('query') }}">
                                <button type="submit" class="search-btn">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>
                        <h2>Meetings</h2>
                    </div>                    
                </div>
            </div>
        </div>
    </div>

    <br><br>

    <section class="rooms-section spad">
        <div class="container">
            <div class="row">
                <!-- Hasil Pencarian Meetings -->
                <div class="col-lg-12">
                    <h2>Meeting Room Results</h2>
                </div>
                @if($meetings->isEmpty())
                    <div class="col-lg-12">
                        <p>Tidak ada hasil untuk pencarian "{{ request('query') }}" di bagian ruang meeting.</p>
                    </div>
                @else
                    @foreach ($meetings as $item)
                        <div class="col-lg-4 col-md-6">
                            <div class="room-item">
                                <!-- Menampilkan gambar ruang meeting -->
                                <img src="{{ asset('/img/meetings/' . $item->foto_ruang) }}" alt="Gambar Ruang {{ $item->nama_ruang }}" class="room-image">
                                <div class="ri-text">
                                    <!-- Nama ruang meeting -->
                                    <h3>{{ $item->nama_ruang }}</h3>
                                    <!-- Tautan menuju detail ruang meeting -->
                                    <a href="{{ route('rooms', ['location' => strtolower($item->nama_ruang)]) }}" class="primary-btn">More Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

@endsection
