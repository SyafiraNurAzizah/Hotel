@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/rooms.css') }}">
@endpush

@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>{{ ($location) }}</h2>
                    <div class="bt-option">
                        <a href="{{ route('rooms', ['location' => strtolower($location)]) }}" class="active">Kamar</a>
                        <span><a href="{{ route('fasilitas', ['location' => strtolower($location)]) }}">Fasilitas</a></span>
                    </div>
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
                    @if ($hotel->room_types->isEmpty())
                        <p>No room types available for {{ $hotel->nama_hotel }}.</p>
                    @else
                        @foreach ($hotel->room_types as $room)
                            <div class="col-lg-4 col-md-6">
                                <div class="room-item">
                                    <img src="{{ asset('img/hotels/rooms/' . $room->foto) }}" alt="">
                                    <div class="ri-text">
                                        <h4>{{ $room->nama_tipe }}</h4>
                                        <h3>Rp{{ $room->harga_per_malam }}<span>/Malam</span></h3>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="r-o">Ukuran:</td>
                                                    <td>{{ $room->ukuran_kamar }} m²</td>
                                                </tr>
                                                <tr>
                                                    <td class="r-o">kapasitas:</td>
                                                    <td>{{ $room->kapasitas }} orang</td>
                                                </tr>
                                                <tr>
                                                    <td class="r-o">Kasur:</td>
                                                    <td>{{ $room->jenis_kasur }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="r-o">Layanan:</td>
                                                    <td>{{ $room->fasilitas }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <a href="#" class="primary-btn">More Details</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endforeach
            @endif
        </div>
        <div class="col-lg-12">
            <div class="room-pagination">
                <a href="#">1</a>
                <a href="#">2</a>
                <a href="#">Next <i class="fa fa-long-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>
<!-- Rooms Section End -->
@endsection
