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
                        <h2>Mau ke mana?</h2>
                        <div class="bt-option">
                            <span>Temukan pengalaman menginap yang sempurna di hotel kami!</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="rooms-section spad">
        <div class="container">
            <div class="row">
                @foreach ($hotels as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="room-item">
                            <img src="{{ asset('/img/hotels/' . $item->foto_hotel) }}" alt="" class="room-image">
                            <div class="ri-text">
                                <h3>{{ $item->nama_cabang }}</h3>
                                <a href="{{ route('rooms', ['location' => strtolower($item->nama_cabang)]) }}"
                                    class="primary-btn">More Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- <div class="col-lg-4 col-md-6">
                    <div class="room-item">
                        <img src="img/room/room-sby.jpg" alt="" class="room-image">
                        <div class="ri-text">
                            <h3>Surabaya</h3>
                            <a href="#" class="primary-btn">More Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="room-item">
                        <img src="img/room/room-bndg.jpg" alt="" class="room-image">
                        <div class="ri-text">
                            <h3>Bandung</h3>
                            <a href="#" class="primary-btn">More Details</a>
                        </div>
                    </div>
                </div>
    
                <div class="col-lg-4 col-md-6">
                    <div class="room-item">
                        <img src="img/room/room-bksi.jpg" alt="" class="room-image">
                        <div class="ri-text">
                            <h3>Bekasi</h3>
                            <a href="#" class="primary-btn">More Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="room-item">
                        <img src="img/room/room-smrg.jpg" alt="" class="room-image">
                        <div class="ri-text">
                            <h3>Semarang</h3>
                            <a href="#" class="primary-btn">More Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="room-item">
                        <img src="img/room/room-bgr.jpg" alt="" class="room-image">
                        <div class="ri-text">
                            <h3>Bogor</h3>
                            <a href="#" class="primary-btn">More Details</a>
                        </div>
                    </div>
                </div>
    
                <div class="col-lg-4 col-md-6">
                    <div class="room-item">
                        <img src="img/room/room-mlng.jpg" alt="" class="room-image">
                        <div class="ri-text">
                            <h3>Malang</h3>
                            <a href="#" class="primary-btn">More Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="room-item">
                        <img src="img/room/room-jgj.jpg" alt="" class="room-image">
                        <div class="ri-text">
                            <h3>Yogyakarta</h3>
                            <a href="#" class="primary-btn">More Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="room-item">
                        <img src="img/room/room-pwt.jpg" alt="" class="room-image">
                        <div class="ri-text">
                            <h3>Purwokerto</h3>
                            <a href="#" class="primary-btn">More Details</a>
                        </div>
                    </div>
                </div> --}}


            </div>
        </div>
    </section>
@endsection
