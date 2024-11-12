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
<br><br><br>
<div class="back-button">
    <h3><a href="javascript:history.back()" class="btn btn-back">←</a></h3>
</div>
<br>
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
                                </div>
                            </div>
                            <h2>Rp{{ number_format($room->harga_per_malam, 2, ',', '.') }}<span>/Malam</span></h2>
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

                        {{-- RATING --}}
                        {{-- <form action="{{ route('hotels.storeRating') }}" method="POST" class="contact-form">
                            @csrf
                            <input type="hidden" name="tipe_kamar_id" value="{{ $room->id }}">

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="ri-text" style="margin-bottom: 15px;">
                                        <h5>Bradon</h5>
                                        <div class="rating" style="color: #f5b917; font-size: 16px;">
                                            <i class="icon_star"></i>
                                            <i class="icon_star"></i>
                                            <i class="icon_star"></i>
                                            <i class="icon_star"></i>
                                            <i class="icon_star-half_alt"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="servingSize">Pesan</label>
                                        <input type="text-area" id="comment" name="comment" class="form-control">
                                    </div>
                                </div>

                                <button type="submit" class="btn" style="margin-left: 15px">Submit Now</button>
                            </div>
                        </form> --}}

                        {{-- Rating Form --}}
                        <form action="{{ route('rating.store', $room->nama_tipe) }}" method="POST" class="rating-form">
                            @csrf
                            <input type="hidden" name="tipe_kamar_id" value="{{ $room->id }}">
                            <input type="hidden" id="rating" name="rating" value="0"> {{-- Hidden input untuk menyimpan nilai rating --}}

                            <div class="form-group">
                                <label for="rating">Brandon</label>
                                <div id="star-rating" style="font-size: 24px; color: #f5b917;">
                                    {{-- Bintang-bintang yang dapat diklik --}}
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="icon_star" data-value="{{ $i }}" style="cursor: pointer;"></i>
                                    @endfor
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="comment">Comment:</label>
                                <textarea name="comment" id="comment" rows="3" class="form-control"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary mt-2">Submit Rating</button>
                        </form>









                        {{-- <h4>Reviews</h4>
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
                        </div> --}}
                    </div>







                    @if (Auth::check() && Auth::user()->isUser())
                        {{-- <div class="review-add">
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
                        </div> --}}



                </div>





                <div class="col-lg-4">
                    @foreach ($hotels as $hotel)
                        <div class="room-booking">
                            {{-- <h3>Your Reservation at {{ $hotel->nama_cabang }} - {{ $room->nama_tipe }}</h3> --}}
                            <h3>Your Reservation</h3>
                            <form
                                action="{{ route('booking.hotel.store', ['location' => strtolower($hotel->nama_cabang), 'nama_tipe' => $room->nama_tipe]) }}"
                                method="POST">
                                @csrf

                                <div class="hotel-input">
                                    <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
                                    <input type="hidden" name="tipe_kamar_id" value="{{ $room->id }}"
                                        data-kapasitas="{{ $room->kapasitas }}">
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
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                    </select>
                                </div>
                                <div class="select-option">
                                    <label for="tamu_anak">Anak:</label>
                                    <select class="tamu_anak" id="tamu_anak" name="tamu_anak">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                    </select>
                                </div>
                                <div class="select-option">
                                    <label for="jumlah_kamar">Kamar:</label>
                                    <select class="jumlah_kamar" id="jumlah_kamar" name="jumlah_kamar">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
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


    {{-- @if ($errors->has('booking_error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $errors->first('booking_error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif --}}


@endsection

@push('scripts')
    <script>
        // $(function() {
        //     $("#date-in").datepicker({
        //         dateFormat: 'yy-mm-dd',
        //         onSelect: function() {
        //             updateCheckout();
        //         }
        //     });
        //     $("#date-out").datepicker({
        //         dateFormat: 'yy-mm-dd'
        //     });
        // });

        // function updateCheckout() {
        //     const checkinInput = document.getElementById('date-in');
        //     const checkoutInput = document.getElementById('date-out');

        //     const checkinDate = new Date(checkinInput.value);
        //     if (!isNaN(checkinDate.getTime())) {
        //         checkinDate.setDate(checkinDate.getDate() + 1);
        //         const year = checkinDate.getFullYear();
        //         const month = String(checkinDate.getMonth() + 1).padStart(2, '0');
        //         const day = String(checkinDate.getDate()).padStart(2, '0');
        //         checkoutInput.value = `${year}-${month}-${day}`;
        //     } else {
        //         checkoutInput.value = '';
        //     }
        // };



        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('.room-booking form');

            forms.forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    // Ambil nilai jumlah dewasa
                    const jumlahTamu = parseInt(form.querySelector('.tamu_dewasa').value) || 0;

                    // Ambil jumlah kamar dan kapasitas kamar
                    const jumlahKamar = parseInt(form.querySelector('.jumlah_kamar').value) || 0;
                    const kapasitasKamar = parseInt(form.querySelector(
                        'input[name="tipe_kamar_id"]').dataset.kapasitas) || 0;

                    // Debugging untuk memastikan semua data diambil dengan benar
                    console.log('Jumlah tamu dewasa:', jumlahTamu);
                    console.log('Jumlah kamar:', jumlahKamar);
                    console.log('Kapasitas per kamar:', kapasitasKamar);

                    // Hitung kapasitas total
                    const kapasitasTotal = jumlahKamar * kapasitasKamar;
                    console.log('Kapasitas total:', kapasitasTotal);

                    // Jika jumlah tamu melebihi kapasitas total, tampilkan peringatan
                    if (jumlahTamu > kapasitasTotal) {
                        event.preventDefault(); // Hentikan pengiriman form
                        alert(
                            'Jumlah tamu melebihi kapasitas kamar. Silakan kurangi jumlah tamu atau tambahkan kamar.'
                        );
                        console.log('Form dihentikan karena kapasitas terlampaui');
                    } else {
                        console.log('Form lanjut dikirim');
                    }
                });
            });
        });



        // RATING //
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('#star-rating .icon_star');
            const ratingInput = document.getElementById('rating');
            let currentRating = 0;

            // Set event listener untuk setiap ikon bintang
            stars.forEach(star => {
                star.addEventListener('click', function() {
                    currentRating = this.getAttribute('data-value'); // Ambil nilai data-value
                    ratingInput.value = currentRating; // Update nilai rating tersembunyi
                    updateStarDisplay(currentRating); // Perbarui tampilan bintang
                });

                // Efek hover pada bintang
                star.addEventListener('mouseenter', function() {
                    updateStarDisplay(this.getAttribute('data-value'));
                });

                // Reset tampilan bintang saat hover hilang
                star.addEventListener('mouseleave', function() {
                    updateStarDisplay(currentRating);
                });
            });

            // Fungsi untuk memperbarui tampilan bintang
            function updateStarDisplay(rating) {
                stars.forEach(star => {
                    if (star.getAttribute('data-value') <= rating) {
                        star.classList.add(
                        'filled'); // Beri kelas filled jika rating bintang lebih kecil atau sama
                    } else {
                        star.classList.remove('filled'); // Hilangkan kelas filled jika rating lebih besar
                    }
                });
            }
        });
    </script>
@endpush

@push('styles')
    <style>
        #star-rating .icon_star {
            font-size: 30px;
            color: #e0e0e0;
            /* Warna default (abu-abu) */
            transition: color 0.2s ease;
        }

        #star-rating .icon_star.filled {
            color: #f5b917;
            /* Warna kuning untuk bintang yang terisi */
        }

        #star-rating .icon_star:hover {
            color: #f5b917;
            /* Warna kuning saat hover */
        }
    </style>
@endpush
