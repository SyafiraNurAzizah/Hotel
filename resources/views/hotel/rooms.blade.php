@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/hotel/rooms.css') }}">
<style>
    /* Card Container */
    .room-item {
        position: relative;
        overflow: hidden;
        width: 100%;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        margin-bottom: 30px;
        min-height: 500px; /* Atur tinggi minimum card */
        display: flex;
        flex-direction: column; /* Untuk memastikan konten card tertata dengan baik */
    }
    .room-item img {
        width: 100%;
        height: 250px; /* Atur tinggi gambar agar seragam */
        border-radius: 12px 12px 0 0;
        object-fit: cover;
    }

    .ri-text .r-o {
        font-weight: bold;
    }
    .ri-text td:last-child {
        white-space: nowrap;        /* Pastikan teks tidak dibungkus ke baris baru */
        overflow: hidden;           /* Sembunyikan teks yang melampaui batas */
        text-overflow: ellipsis;    /* Tambahkan titik-titik di akhir teks */
        max-width: 150px;           /* Atur lebar maksimum kolom layanan */
        display: inline-block;      /* Agar properti ellipsis berfungsi */
    }
    .ri-text h4, .ri-text h3 {
        margin-bottom: 10px;
    }


    /* Responsiveness */
    @media (max-width: 768px) {
        .room-item {
            margin-bottom: 20px;
            min-height: 400px; /* Atur ulang tinggi minimum untuk mobile */
        }

        .room-item img {
            height: 200px; /* Sesuaikan tinggi gambar untuk mobile */
        }
    }

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
<br>   
<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>{{ $location }}</h2>
                    <div class="bt-option">
                        <a href="{{ route('rooms', ['location' => strtolower($location)]) }}" class="active">Kamar</a></span>
                        <i class="bi bi-chevron-right" style="font-size: 10px"></i>
                        <a href="{{ route('fasilitas', ['location' => strtolower($location)]) }}">Fasilitas</a>
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
                @foreach($hotels as $hotel)
                    @foreach($hotel->room_types as $room)
                        <div class="col-lg-4 col-md-6">
                            <div class="room-item">
                                <img src="{{ asset('img/hotels/rooms/' . $room->foto) }}" alt="Room image">
                                <div class="ri-text">
                                    <h4>{{ $room->nama_tipe }}</h4>
                                    <h3>Rp{{ number_format($room->harga_per_malam, 2, ',', '.') }}<span>/Malam</span></h3>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="r-o">Ukuran:</td>
                                                <td>{{ $room->ukuran_kamar }} m²</td>
                                            </tr>
                                            <tr>
                                                <td class="r-o">Kapasitas:</td>
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
                                    <a href="{{ route('detail-hotel', ['location' => strtolower($hotel->nama_cabang), 'nama_tipe' => $room->nama_tipe]) }}" class="primary-btn">More Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
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
