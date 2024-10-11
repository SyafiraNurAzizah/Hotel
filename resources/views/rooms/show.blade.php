@extends('layouts.app')

@push('styles')
<style>
    /* Style untuk room details */
    .room-details-item img {
        width: 100%;
        height: auto;
        border-radius: 12px;
    }

    .rd-text {
        margin-top: 20px;
    }

    .rd-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .rd-title h3 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .rd-title .rdt-right {
        display: flex;
        align-items: center;
    }

    .rdt-right .rating {
        margin-right: 20px;
    }

    .rdt-right a {
        background-color: #ff9c00;
        padding: 10px 20px;
        color: white;
        border-radius: 5px;
        text-decoration: none;
    }

    .rd-text h2 {
        font-size: 28px;
        margin-top: 15px;
        margin-bottom: 25px;
    }

    .rd-text table {
        width: 100%;
        margin-bottom: 20px;
    }

    .rd-text table td {
        padding: 10px 0;
    }

    .rd-text table .r-o {
        font-weight: bold;
    }

    /* Reviews */
    .rd-reviews {
        margin-top: 40px;
    }

    .review-item {
        display: flex;
        margin-bottom: 20px;
    }

    .ri-pic img {
        width: 60px;
        border-radius: 50%;
        margin-right: 20px;
    }

    .ri-text {
        flex-grow: 1;
    }

    .ri-text .rating {
        margin-bottom: 5px;
    }

    /* Booking section */
    .room-booking {
        background-color: #f3f4f5;
        padding: 30px;
        border-radius: 10px;
        margin-top: 30px;
    }

    .room-booking h3 {
        margin-bottom: 20px;
    }

    .check-date {
        margin-bottom: 15px;
    }

    .check-date input {
        width: calc(100% - 30px);
        padding: 10px;
        border: 1px solid #e1e1e1;
        border-radius: 5px;
    }

    .check-date i {
        position: relative;
        top: -30px;
        right: -10px;
        color: #999;
    }

    .select-option {
        margin-bottom: 15px;
    }

    .select-option select {
        width: 100%;
        padding: 10px;
        border: 1px solid #e1e1e1;
        border-radius: 5px;
    }

    .room-booking button {
        width: 100%;
        background-color: #ff9c00;
        border: none;
        padding: 10px;
        color: white;
        border-radius: 5px;
        font-size: 16px;
    }

    /* Responsive for mobile */
    @media (max-width: 768px) {
        .rd-title {
            flex-direction: column;
            align-items: flex-start;
        }

        .room-booking {
            margin-top: 20px;
        }
    }
</style>
@endpush

@section('content')
<br><br><br><br>
<section class="room-details-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="room-details-item">
                    <img src="{{ asset('img/hotels/rooms/' . $room->foto) }}" alt="Room image">
                    <div class="rd-text">
                        <div class="rd-title">
                            <h3>{{ $room->nama_tipe }}</h3>
                            <div class="rdt-right">
                                <div class="rating">
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star-half_alt"></i>
                                </div>
                                <a href="#">Booking Now</a>
                            </div>
                        </div>
                        <h2>Rp{{ $room->harga_per_malam }}<span>/Malam</span></h2>
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
                                    <td class="r-o">Fasilitas:</td>
                                    <td>{{ $room->fasilitas }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="f-para">{{ $room->deskripsi }}</p>
                    </div>
                </div>

                {{-- <!-- Reviews Section -->
                <div class="rd-reviews">
                    <h4>Reviews</h4>
                    <!-- Example of a review -->
                    <div class="review-item">
                        <div class="ri-pic">
                            <img src="img/room/avatar/avatar-1.jpg" alt="Reviewer">
                        </div>
                        <div class="ri-text">
                            <span>27 Aug 2019</span>
                            <div class="rating">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star-half_alt"></i>
                            </div>
                            <h5>Brandon Kelley</h5>
                            <p>Review content goes here...</p>
                        </div>
                    </div>
                </div> --}}

                <!-- Add Review Form -->
            
            </div>

            <!-- Booking Section -->
            {{-- <div class="col-lg-4">
                <div class="room-booking">
                    <h3>Your Reservation</h3>
                    <form action="#">
                        <div class="check-date">
                            <label for="date-in">Check In:</label>
                            <input type="text" class="date-input" id="date-in">
                            <i class="icon_calendar"></i>
                        </div>
                        <div class="check-date">
                            <label for="date-out">Check Out:</label>
                            <input type="text" class="date-input" id="date-out">
                            <i class="icon_calendar"></i>
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
                                <option value="">1 Room</option>
                            </select>
                        </div>
                        <button type="submit">Check Availability</button>
                    </form>
                </div>
            </div> --}}
        </div>
    </div>
</section>
@endsection
