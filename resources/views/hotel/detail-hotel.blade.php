@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/hotel/detail-hotel.css') }}">


    <style>
        .icon_star {
            font-size: 18px;
            color: #d3d3d3; /* Default color for empty stars */
        }
    
        .icon_star.rated {
            color: #f5b917; /* Color for filled stars */
        }
    
        .icon_star.hover {
            color: #f5b917; /* Hover color */
        }
    </style>
@endpush

@section('content')
<br><br><br>
<div class="back-button">
    <h3>
        <a href="javascript:history.back()" class="btn btn-back">
            <i class="bi bi-arrow-left"></i>
        </a>
    </h3>
</div>

    <section class="room-details-section spad" style="position: relative; bottom: 9px;">
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
                                        @for ($i = 1; $i <= $room->ratings->avg('rating'); $i++)
                                            <i class="icon_star"></i>
                                        @endfor
                                        @for ($i = $room->ratings->avg('rating') + 1; $i <= 5; $i++)
                                            <i class="icon_star-empty"></i>
                                        @endfor
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
                        {{-- REVIEW --}}
                        <div class="reviews" style="margin-bottom: 80px;">
                            <h4>Ulasan</h4>
                            @forelse ($room->ratings as $rating)
                                <div class="review">
                                    <div class="review-item">
                                        <div class="ri-pic">
                                            @php
                                                $profile = $rating->user->profile_user; // Ambil profil user yang memberi rating
                                            @endphp

                                            {{-- Cek apakah profil ada dan memiliki foto --}}
                                            @if (isset($profile) && $profile->foto)
                                                <img src="{{ asset('storage/' . $profile->foto) }}" alt="Foto Profil" class="profile-image" style="object-fit: cover">
                                            @else
                                                <img src="{{ asset('img/profile-default.jpg') }}" alt="Foto Profil" class="profile-image">
                                            @endif
                                            {{-- <img src="img/room/avatar/avatar-1.jpg" alt=""> --}}
                                        </div>
                                        <div class="ri-text">
                                            <h5 class="m-0">{{ $rating->user->firstname }}</h5>
                                            <span>{{ $rating->created_at->format('Y-m-d') }}</span>
                                            <div class="rating">
                                                @for ($i = 1; $i <= $rating->rating; $i++)
                                                    <i class="icon_star"></i>
                                                @endfor
                                                @for ($i = $rating->rating + 1; $i <= 5; $i++)
                                                    <i class="icon_star-empty"></i>
                                                @endfor
                                            </div>
                                            <p class="mt-2">{{ $rating->comment }}</p>
                                        </div>
                                    </div>


                                </div>
                            @empty
                                <P>Belum ada ulasan</P>
                            @endforelse
                        </div>
                        
                        @if (Auth::check() && Auth::user()->isUser())
                        {{-- RATING FORM --}}
                        <div class="rating mb-5">
                            <form action="{{ route('rating.store', $room->nama_tipe) }}" method="POST" class="rating-form">
                                @csrf
                                <input type="hidden" name="tipe_kamar_id" value="{{ $room->id }}">
                                <input type="hidden" id="rating" name="rating" value="0"> {{-- Hidden input untuk menyimpan nilai rating --}}

                                <div class="form-group">
                                    <h4 class="rating mb-4">Berikan Ulasan Anda:</h4>
                                    <div id="star-rating">
                                        {{-- Bintang-bintang yang dapat diklik --}}
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="icon_star" data-value="{{ $i }}"
                                                style="cursor: pointer;"></i>
                                        @endfor

                                        <input type="hidden" name="rating" id="rating-input">
                                    </div>
                                </div>

                                <div class="form-group">
                                    {{-- <label for="comment">Comment:</label> --}}
                                    <textarea name="comment" id="comment" rows="2" class="form-control" placeholder="Masukkan ulasan Anda" style="height: 150px"></textarea>
                                </div>

                                {{-- <button type="submit" class="btn mt-2" style="background-color: #dfa974; color: #fff; padding: 5px 25px; border-radius: none;">Kirim</button> --}}
                                <button type="submit" style="background-color: #dfa974; color: #fff; padding: 10px 45px; border: none; letter-spacing: 2px; font-size: 15px;">KIRIM</button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>

                @if (Auth::check() && Auth::user()->isUser())
                <div class="col-lg-4">
                    @foreach ($hotels as $hotel)
                        <div class="room-booking">
                            {{-- <h3>Your Reservation at {{ $hotel->nama_cabang }} - {{ $room->nama_tipe }}</h3> --}}
                            <h3>Reservasi</h3>
                            <form action="{{ route('booking.hotel.store', ['location' => strtolower($hotel->nama_cabang), 'nama_tipe' => $room->nama_tipe]) }}" method="POST">
                                @csrf

                                <div class="hotel-input">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
                                    <input type="hidden" name="tipe_kamar_id" value="{{ $room->id }}"
                                        data-kapasitas="{{ $room->kapasitas }}">
                                    <input type="hidden" name="status" value="belum_selesai">
                                    <input type="hidden" name="status_pembayaran" value="belum_dibayar">
                                </div>

                                <div class="check-date">
                                    <label for="check_in">Check In</label>
                                    <input type="text" class="date-input" id="check_in" name="check_in">
                                    <i class="bi bi-calendar2-fill"></i>
                                </div>
                                <div class="check-date">
                                    <label for="check_out">Check Out</label>
                                    <input type="text" class="date-input" id="check_out" name="check_out">
                                    <i class="bi bi-calendar2-fill"></i>
                                </div>
                                <div class="select-option">
                                    <label for="jumlah_kamar">Kamar</label>
                                    <input type="number" class="jumlah_kamar" id="jumlah_kamar" name="jumlah_kamar" min="1" value="1">
                                    <i class="fa-solid fa-bed"></i>
                                </div>
                                <div class="tamu-option">
                                    <div class="group">
                                        <label for="tamu_dewasa">Dewasa</label>
                                        <input type="number" class="tamu_dewasa" id="tamu_dewasa" name="tamu_dewasa" min="1" value="1">
                                    </div>
                                    <div class="group">
                                        <label for="tamu_anak">Anak</label>
                                        <input type="number" class="tamu_anak" id="tamu_anak" name="tamu_anak" min="0" value="0">
                                    </div>
                                </div>
                                <div class="note">
                                    <label for="pesan">Pesan</label>
                                    <textarea type="text" class="pesan" id="pesan" name="pesan"></textarea>
                                    <i class="bi bi-chat-left-text-fill"></i>
                                </div>
                                <button type="submit">Reservasi Sekarang</button>
                            </form>
                        </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </section>


    <div class="overlay" id="errorKetersediaanKamar">
        <div class="bukti">
            <span class="close" id="closeErrorKetersediaanKamarPopup"></span>
            
            <div id="ketersediaanKamar">
                <div class="circle-1">
                    <div class="circle-2">
                        <i class="bi bi-exclamation-circle"></i>
                    </div>
                </div>
                <h1>Kamar Tidak Tersedia</h1>
                <p>Mohon maaf, kamar yang Anda pilih tidak tersedia untuk tanggal ini.</p>
            </div>
        </div>
    </div>


    <div class="overlay" id="errorKapasitasKamar">
        <div class="bukti">
            <span class="close" id="closeErrorKapasitasKamarPopup"></span>
            
            <div id="kapasitasKamar">
                <div class="circle-1">
                    <div class="circle-2">
                        <i class="bi bi-exclamation-circle"></i>
                    </div>
                </div>
                <h1>Jumlah Tamu Tidak Sesuai</h1>
                <p>Mohon maaf, jumlah tamu tidak sesuai dengan kapasitas kamar.</p>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const forms = document.querySelectorAll('.room-booking form');

        forms.forEach(function (form) {
            form.addEventListener('submit', function (event) {
                // Ambil nilai jumlah dewasa
                const jumlahTamu = parseInt(form.querySelector('.tamu_dewasa').value) || 0;

                // Ambil jumlah kamar dan kapasitas kamar
                const jumlahKamar = parseInt(form.querySelector('.jumlah_kamar').value) || 0;
                const kapasitasKamar = parseInt(form.querySelector('input[name="tipe_kamar_id"]').dataset.kapasitas) || 0;

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


                    const errorKapasitasKamarOverlay = document.getElementById('errorKapasitasKamar');
                    errorKapasitasKamarOverlay.style.display = 'flex';  // Menampilkan overlay

                    const closeErrorKapasitasKamarPopup = document.getElementById('closeErrorKapasitasKamarPopup');
                    
                    // Menutup popup jika tombol close diklik
                    if (closeErrorKapasitasKamarPopup) {
                        closeErrorKapasitasKamarPopup.addEventListener('click', function() {
                            errorKapasitasKamarOverlay.style.display = 'none';  // Menutup overlay
                        });
                    }

                    // Menutup popup jika area luar popup diklik
                    errorKapasitasKamarOverlay.addEventListener('click', function(e) {
                        if (e.target === errorKapasitasKamarOverlay) {
                            errorKapasitasKamarOverlay.style.display = 'none';  // Menutup overlay
                        }
                    });


                    console.log('Form dihentikan karena kapasitas terlampaui');
                } else {
                    console.log('Form lanjut dikirim');
                }
            });
        });
    });


    document.addEventListener('DOMContentLoaded', function() {
        // Cek apakah session error ada
        @if(session('kamarTersediaError'))
            // Menampilkan popup jika session error ada
            const errorKetersediaanKamarOverlay = document.getElementById('errorKetersediaanKamar');
            errorKetersediaanKamarOverlay.style.display = 'flex';  // Menampilkan overlay

            const closeErrorKetersediaanKamarPopup = document.getElementById('closeErrorKetersediaanKamarPopup');
            
            // Menutup popup jika tombol close diklik
            if (closeErrorKetersediaanKamarPopup) {
                closeErrorKetersediaanKamarPopup.addEventListener('click', function() {
                    errorKetersediaanKamarOverlay.style.display = 'none';  // Menutup overlay
                });
            }

            // Menutup popup jika area luar popup diklik
            errorKetersediaanKamarOverlay.addEventListener('click', function(e) {
                if (e.target === errorKetersediaanKamarOverlay) {
                    errorKetersediaanKamarOverlay.style.display = 'none';  // Menutup overlay
                }
            });
        @endif
    });



    document.addEventListener('DOMContentLoaded', function () {
    const stars = document.querySelectorAll('#star-rating .icon_star');
    const ratingInput = document.getElementById('rating-input');

    stars.forEach(star => {
        star.addEventListener('click', function() {
            let ratingValue = this.getAttribute('data-value');
            ratingInput.value = ratingValue; // Set the hidden input with the rating value

            // Highlight the stars based on the clicked rating
            stars.forEach(star => {
                if (star.getAttribute('data-value') <= ratingValue) {
                    star.classList.add('rated');
                } else {
                    star.classList.remove('rated');
                }
            });
        });

        star.addEventListener('mouseover', function() {
            let hoverValue = this.getAttribute('data-value');
            
            // Temporarily highlight the stars on hover
            stars.forEach(star => {
                if (star.getAttribute('data-value') <= hoverValue) {
                    star.classList.add('rated');
                } else {
                    star.classList.remove('rated');
                }
            });
        });

        star.addEventListener('mouseout', function() {
            // Reset the highlight when hover ends, but keep the selected rating
            stars.forEach(star => {
                if (star.getAttribute('data-value') <= ratingInput.value) {
                    star.classList.add('rated');
                } else {
                    star.classList.remove('rated');
                }
            });
        });
    });
});

</script>

@endpush