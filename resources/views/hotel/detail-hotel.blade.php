@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/hotel/detail-hotel.css') }}">
@endpush

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
                                    {{-- <a href="#">Booking Now</a --}}
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
                            <h3>Reservasi</h3>
                            <form action="{{ route('booking.hotel.store', ['location' => strtolower($hotel->nama_cabang), 'nama_tipe' => $room->nama_tipe]) }}" method="POST">
                                @csrf
                
                                <div class="hotel-input">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
                                    <input type="hidden" name="tipe_kamar_id" value="{{ $room->id }}" data-kapasitas="{{ $room->kapasitas }}">
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
</script>

@endpush