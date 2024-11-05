@extends('layouts.app')

@section('content')
    <style>
        .gallery-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            /* Jarak antar kartu */
            justify-content: center;
            /* Pusatkan grid */
        }

        .card-container {
            flex: 1 1 300px;
            /* Atur lebar minimum kartu */
            max-width: 300px;
            /* Atur lebar maksimum kartu */
        }

        .card {
            border: 1px solid #ccc;
            /* Gaya border */
            border-radius: 8px;
            /* Gaya sudut */
            overflow: hidden;
            /* Sembunyikan overflow */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Tambahkan bayangan */
            transition: transform 0.3s;
            /* Efek transisi */
        }

        .card:hover {
            transform: scale(1.05);
            /* Efek hover */
        }

        .card img {
            width: 100%;
            /* Gambar memenuhi lebar kartu */
            height: auto;
            /* Tinggi otomatis untuk menjaga rasio */
        }

        .card-content {
            padding: 16px;
            /* Ruang di dalam konten kartu */
            text-align: center;
            /* Pusatkan teks */
        }
    </style>
    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>{{ $location }} Rooms</h2>
                        <div class="bt-option">
                            <a href="{{ route('ruang', ['location' => strtolower($location)]) }}" class="active">Home</a>
                            <span><a href="#">Gallery</a></span>
                            {{-- <span><a href="{{ route('gallery', ['location' => strtolower($location), 'roomId' => $roomId]) }}">Gallery</a></span> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Room Details Section Begin -->
    <section class="room-details-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="room-details-item">
                        <img src="{{ asset('img/meetings/rooms/' . $room->foto) }}" alt="">
                        <!-- Menggunakan path gambar ruangan dari model -->
                        <div class="rd-text">
                            <div class="rd-title">
                                <h3>{{ $room->nama_ruang }}</h3> <!-- Menggunakan nama ruang dari model -->
                                {{-- <div class="rdt-right">
                                    <a href="#">Booking Now</a>
                                </div> --}}
                            </div>
                            <h2> Rp.{{ $room->harga_per_jam }}<span>/Jam</span></h2>
                            <!-- Menggunakan harga per jam dari model -->
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="r-o">Ukuran:</td>
                                        <td>{{ $room->ukuran_ruang }} m²</td> <!-- Menggunakan ukuran ruang dari model -->
                                    </tr>
                                    <tr>
                                        <td class="r-o">Kapasitas:</td>
                                        <td>{{ $room->kapasitas }} orang</td> <!-- Menggunakan kapasitas dari model -->
                                    </tr>
                                    <tr>
                                        <td class="r-o">Fasilitas:</td>
                                        <td>{{ $room->fasilitas }}</td> <!-- Menggunakan fasilitas dari model -->
                                    </tr>
                                </tbody>
                            </table>
                            <p class="f-para">{{ $room->deskripsi }}</p> <!-- Menggunakan deskripsi dari model -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="gallery-grid">
                            @foreach ($gallery as $item)
                                <div class="card-container">
                                    <div class="card">
                                        <img src="{{ asset('img/meetings/' . $item->foto) }}" alt="">
                                        <div class="card-content">
                                            <h4 class="card-title">{{ $item->deskripsi }}</h4>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
    
                    </div>
                    <!-- Ulasan dan form tambah ulasan -->
                    <div class="rd-reviews">
                        <h4>Reviews</h4>
                        <!-- Ulasan bisa ditampilkan di sini -->
                    </div>
                    <div class="review-add">
                        <h4>Add Review</h4>
                        <form action="#" class="ra-form">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Name*">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Email*">
                                </div>

                            </div>
                            <textarea placeholder="Your Review"></textarea>
                            <button type="submit">Submit Now</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="room-booking">
                        <h3>Your Reservation</h3>
                        <form action="#" class="ra-form">
                            <div class="check-date">
                                <label for="date-in">Check In:</label>
                                <input type="datetime-local" class="date-input" id="date-in">
                                {{-- <i class="icon_calendar"></i> --}}
                            </div>
                            <div class="select-option">
                                <label for="guest">Guests:</label>
                                <select id="guest">
                                    <option value="">3 Adults</option>
                                </select>
                            </div>
                            <div class="select-option">
                                <label for="room">Room:</label>
                                <select id="room">
                                    <option value="">{{ $room->nama_ruang }}</option>
                                    <!-- Menggunakan nama ruang dari model -->
                                </select>
                            </div>
                            <button type="submit">Check Availability</button>
                        </form>
                    </div>
                </div>                
            </div>
        </div>

    </section>
    <!-- Room Details Section End -->

    <!-- Footer Section Begin -->
    <!-- (footer code di sini) -->
@endsection
