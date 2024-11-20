@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/hotel/fasilitas.css') }}">
@endpush

@section('content')

<div class="back-button">
    <h3>
        <a href="javascript:history.back()" class="btn btn-back">
            <i class="bi bi-arrow-left"></i>
        </a>
    </h3>
</div>

<br>
<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text mt-3">
                    <h2>{{ ($location) }}</h2>
                    <div class="bt-option">
                        <a href="{{ route('rooms', ['location' => strtolower($location)]) }}">Kamar</a></span>
                        <i class="bi bi-chevron-left" style="font-size: 10px"></i>
                        <a href="{{ route('fasilitas', ['location' => strtolower($location)]) }}" class="active">Fasilitas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<br><br>

<!-- Rooms Section Begin -->
<section class="rooms-section spad">
    <div class="container">
        <div class="row">
            @if ($hotels->isEmpty())
                <p>No hotels found in this location.</p>
            @else
                @foreach ($hotels as $hotel)
                    @if ($hotel->fasilitas->isEmpty())
                        <p>No room types available for {{ $hotel->nama_hotel }}.</p>
                    @else
                        @foreach ($hotel->fasilitas as $fasilitas)
                            <div class="col-lg-4 col-md-6">
                                <div class="room-item">
                                    <img src="{{ asset('img/hotels/facilities/' . $fasilitas->foto_fasilitas) }}" alt="">
                                    <div class="ri-text">
                                        <h4>{{ $fasilitas->nama_fasilitas }}</h4>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endforeach
            @endif
        </div>
        {{-- <div class="col-lg-12">
            <div class="room-pagination">
                <a href="#">1</a>
                <a href="#">2</a>
                <a href="#">Next <i class="fa fa-long-arrow-right"></i></a>
            </div>
        </div> --}}
    </div>
</section>
<!-- Rooms Section End -->
@endsection
