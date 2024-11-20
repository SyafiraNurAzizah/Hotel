@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/rooms.css') }}">
<style>
    .back-button {
        position: fixed;
        top: 550px; /* Sesuaikan posisi vertikal */
        left: 1280px; /* Sesuaikan posisi horizontal */
    }
    .btn-back {
        background-color: #ffffff;
        color: #19191a;
        padding: 10px 15px;
        border-radius: 50% ;
        text-decoration: none;
        font-size: 20px;
        box-shadow: 0px 0px 10px 2px rgba(0, 0, 0, 0.2);
        transition: background-color 0.3s ease;
    }
    /* .btn-back:hover {
        background-color: #c97a5b;
    } */
</style>
@endpush

@section('content')
<div class="back-button">
    <h3>
        <a href="javascript:history.back()" class="btn btn-back">
            <i class="bi bi-arrow-left"></i>
        </a>
    </h3>
</div>

<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2 style="padding-top: 96px">{{ ($location) }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Rooms Section Begin -->
<section class="rooms-section spad">
    <div class="container">
        <div class="row">
            @if ($hotels->isEmpty())
                <p>No hotels found in this location.</p>
            @else
                @foreach ($hotels as $hotel)
                    @if ($hotel->tipe_ruang->isEmpty())
                        <p>No room types available for {{ $hotel->nama_hotel }}.</p>
                    @else
                        @foreach ($hotel->tipe_ruang as $room)
                            <div class="col-lg-4 col-md-6">
                                <div class="room-item" style="padding-top: 70px;">
                                    <img src="{{ asset('img/meetings/rooms/' . $room->foto) }}" alt="" style="height: 240px; object-fit: cover">
                                    <div class="ri-text">
                                        <h4>{{ $room->nama_ruang }}</h4>
                                        <h3>Rp{{ number_format($room->harga_per_jam, 2, ',', '.') }}<span> /Jam</span></h3>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="r-o">Ukuran:</td>
                                                    <td>{{ $room->ukuran_ruang }} m²</td>
                                                </tr>
                                                <tr>
                                                    <td class="r-o">kapasitas:</td>
                                                    <td>{{ $room->kapasitas }} orang</td>
                                                </tr>
                                                {{-- <tr>
                                                    <td class="r-o">Layanan:</td>
                                                    <td>{{ $room->fasilitas }}</td>
                                                </tr> --}}
                                            </tbody>
                                        </table>
                                        <a href="{{ route('detail', ['location' => strtolower($location), 'roomId' => $room->id]) }}" class="primary-btn">More Details</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</section>
<!-- Rooms Section End -->
@endsection