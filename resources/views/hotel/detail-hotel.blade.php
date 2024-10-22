@extends('layouts.app')

{{-- @push('styles')
<style>
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
    } --}}

    {{-- /* Responsive for mobile */
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
@endpush --}}

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
                            <p class="f-para">{!! nl2br(e($room->deskripsi)) !!}</p>
                        </div>
                    </div>
                    <div class="rd-reviews">
                        <h4>Reviews</h4>
                        <div class="review-item">
                            <div class="ri-pic">
                                <img src="img/room/avatar/avatar-1.jpg" alt="">
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
                                <p>Neque porro qui squam est, qui dolorem ipsum quia dolor sit amet, consectetur,
                                    adipisci velit, sed quia non numquam eius modi tempora. incidunt ut labore et dolore
                                    magnam.</p>
                            </div>
                        </div>
                        <div class="review-item">
                            <div class="ri-pic">
                                <img src="img/room/avatar/avatar-2.jpg" alt="">
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
                                <p>Neque porro qui squam est, qui dolorem ipsum quia dolor sit amet, consectetur,
                                    adipisci velit, sed quia non numquam eius modi tempora. incidunt ut labore et dolore
                                    magnam.</p>
                            </div>
                        </div>
                    </div>
                    @if(Auth::check() && Auth::user()->isUser())
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
                                <div class="col-lg-12">
                                    <div>
                                        <h5>You Rating:</h5>
                                        <div class="rating">
                                            <i class="icon_star"></i>
                                            <i class="icon_star"></i>
                                            <i class="icon_star"></i>
                                            <i class="icon_star"></i>
                                            <i class="icon_star-half_alt"></i>
                                        </div>
                                    </div>
                                    <textarea placeholder="Your Review"></textarea>
                                    <button type="submit">Submit Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    @foreach($hotels as $hotel)
                        <div class="room-booking">
                            {{-- <h3>Your Reservation at {{ $hotel->nama_cabang }} - {{ $room->nama_tipe }}</h3> --}}
                            <h3>Your Reservation</h3>
                            <form action="{{ route('booking.hotel.store', ['location' => strtolower($hotel->nama_cabang), 'nama_tipe' => $room->nama_tipe]) }}" method="POST">
                                @csrf
                
                                <div class="hotel-input">
                                    <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
                                    <input type="hidden" name="tipe_kamar_id" value="{{ $room->id }}">
                                    <input type="hidden" name="status" value="belum_selesai">
                                    <input type="hidden" name="status_pembayaran" value="belum_dibayar">
                                </div>
                
                                <div class="check-date">
                                    <label for="check_in">Check In:</label>
                                    <input type="text" class="date-input" id="check_in" name="check_in">
                                    <i class="icon_calendar"></i>
                                </div>
                                <div class="check-date">
                                    <label for="check_out">Check Out:</label>
                                    <input type="text" class="date-input" id="check_out" name="check_out">
                                    <i class="icon_calendar"></i>
                                </div>
                                <div class="select-option">
                                    <label for="tamu_dewasa">Dewasa:</label>
                                    <select class="tamu_dewasa" id="tamu_dewasa" name="tamu_dewasa">
                                        <option value="3">3</option>
                                    </select>
                                </div>
                                <div class="select-option">
                                    <label for="jumlah_kamar">Kamar:</label>
                                    <select class="jumlah_kamar" id="jumlah_kamar" name="jumlah_kamar">
                                        <option value="1">1</option>
                                    </select>
                                </div>
                                <div class="check-date">
                                    <label for="pesan">Pesan:</label>
                                    <input type="text" class="pesan" id="pesan" name="pesan">
                                    <i class="bi bi-chat"></i>
                                </div>
                                <button type="submit">Check Availability</button>
                            </form>
                        </div>
                    @endforeach
                </div>
                
                @endif
            </div>
        </div>
    </section>
@endsection

@push('scripts')

<script>
    $(function() {
        $("#date-in").datepicker({
            dateFormat: 'yy-mm-dd',
            onSelect: function() {
                updateCheckout();
            }
        });
        $("#date-out").datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });

    function updateCheckout() {
        const checkinInput = document.getElementById('date-in');
        const checkoutInput = document.getElementById('date-out');

        const checkinDate = new Date(checkinInput.value);
        if (!isNaN(checkinDate.getTime())) {
            checkinDate.setDate(checkinDate.getDate() + 1);
            const year = checkinDate.getFullYear();
            const month = String(checkinDate.getMonth() + 1).padStart(2, '0');
            const day = String(checkinDate.getDate()).padStart(2, '0');
            checkoutInput.value = `${year}-${month}-${day}`;
        } else {
            checkoutInput.value = '';
        }
    }
</script>

@endpush
