<title>Berlian Hotel</title>
<link rel="icon" href="{{ asset('img/logo-title.png') }}" type="image/png">

{{-- ------------------------------------------------------------------------------------------------------- --}}


<link rel="stylesheet" href="{{ asset('css/hotel/transaksi/pembayaran.css') }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">


<div class="container">
    <div class="container-card">
        @if ($pembayaran->metode_pembayaran == 'DANA')
            <div class="card-dana">
                {{-- <h6>Detail Pembayaran</h6> --}}
                <img src="{{ asset('img/hotels/metode_pembayaran/DANA.png') }}" alt="DANA">
                <p>Nomor Telepon</p>
                <h3>0881 2721 410</h3>
                <h5>BERLIAN HOTEL</h5>
            </div>
        @elseif ($pembayaran->metode_pembayaran == 'OVO')
            <div class="card-ovo">
                {{-- <h6>Detail Pembayaran</h6> --}}
                <img src="{{ asset('img/hotels/metode_pembayaran/OVO.png') }}" alt="OVO">
                <p>Nomor Telepon</p>
                <h3>0881 2721 410</h3>
                <h5>BERLIAN HOTEL</h5>
            </div>
        @elseif ($pembayaran->metode_pembayaran == 'BCA')
            <div class="card-bca">
                {{-- <h6>Detail Pembayaran</h6> --}}
                <img src="{{ asset('img/hotels/metode_pembayaran/BCA.png') }}" alt="BCA">
                <p>Nomor Rekening</p>
                <h3>0923 1263 74</h3>
                <h5>BERLIAN HOTEL</h5>    
            </div>
        @elseif ($pembayaran->metode_pembayaran == 'BRI')
        <div class="card-bri">
            {{-- <h6>Detail Pembayaran</h6> --}}
            <img src="{{ asset('img/hotels/metode_pembayaran/BRI.png') }}" alt="BRI">
            <p>Nomor Rekening</p>
            <h3>1293 9730 4763 588</h3>
            <h5>BERLIAN HOTEL</h5>    
        </div>
        @elseif ($pembayaran->metode_pembayaran == 'BNI')
        <div class="card-bni">
            {{-- <h6>Detail Pembayaran</h6> --}}
            <img src="{{ asset('img/hotels/metode_pembayaran/BNI.png') }}" alt="BNI">
            <p>Nomor Rekening</p>
            <h3>0836 2197 45</h3>
            <h5>BERLIAN HOTEL</h5>    
        </div>
        @elseif ($pembayaran->metode_pembayaran == 'Mandiri')
        <div class="card-mandiri">
            {{-- <h6>Detail Pembayaran</h6> --}}
            <img src="{{ asset('img/hotels/metode_pembayaran/Mandiri.png') }}" alt="Mandiri">
            <p>Nomor Rekening</p>
            <h3>2836 0128 3574</h3>
            <h5>BERLIAN HOTEL</h5>    
        </div>
        @endif
    </div>
    

    <div class="container-right">
        {{-- <p>Terima kasih telah memilih Berlian Hotel! Kami tunggu konfirmasi pembayaran Anda.</p> --}}

        @foreach ($hotels as $hotel)
            @if ($pembayaran->metode_pembayaran == 'Cash' || $pembayaran->metode_pembayaran == 'Kartu Kredit/Debit')
                <div class="cardnt">
                    <h2>Terima kasih telah memilih Berlian Hotel!</h2>
                    <p class="p-1">Harap bawa bukti reservasi Anda untuk memudahkan proses pembayaran.</p>
                    <p class="p-2">Jika Anda memiliki pertanyaan, silakan hubungi kami di nomor <strong>{{ substr($hotel->no_telp, 0, 4) . '-' . substr($hotel->no_telp, 4, 4) . '-' . substr($hotel->no_telp, 8) }}</strong>.</p>
                    {{-- <div class="total-harga">
                        <h3>Total</h3>
                        <h1>Rp{{ number_format($booking->jumlah_harga, 2, ',', '.') }}</h1>
                    </div> --}}
                </div>
            @endif
        @endforeach


        @if ($pembayaran->metode_pembayaran == 'DANA' || $pembayaran->metode_pembayaran == 'OVO')
            <p>Lakukan pembayaran ke nomor telepon yang tertera.</p>
            <p style="top: 270px; line-height: 20px; width: 360px;">Unggah bukti transfer Anda di formulir bawah ini. Verifikasi akan dilakukan dalam 1x24 jam.</p>
        @elseif ($pembayaran->metode_pembayaran == 'BCA' || $pembayaran->metode_pembayaran == 'BRI' || $pembayaran->metode_pembayaran == 'BNI' || $pembayaran->metode_pembayaran == 'Mandiri')
            <p>Lakukan pembayaran ke nomor rekening yang tertera.</p>
            <p style="top: 270px; line-height: 20px; width: 360px;">Unggah bukti transfer Anda di formulir bawah ini. Verifikasi akan dilakukan dalam 1x24 jam.</p>
        @endif


        @if ($pembayaran->metode_pembayaran == 'DANA' || $pembayaran->metode_pembayaran == 'OVO' || $pembayaran->metode_pembayaran == 'BCA' || $pembayaran->metode_pembayaran == 'BRI' || $pembayaran->metode_pembayaran == 'BNI' || $pembayaran->metode_pembayaran == 'Mandiri')
            {{-- <h2>Detail Pembayaran - <a>{{ $pembayaran->metode_pembayaran }}</a></h2> --}}
            <h2>Detail Pembayaran</h2>
            <p style="margin-bottom: 60px;">Terima kasih telah memilih Berlian Hotel!</p>

            <div class="total-harga">
                <p>Total pembayaran</p>
                <h2>Rp{{ number_format($booking->jumlah_harga, 2, ',', '.') }}</h2>
            </div>
        @endif


    </div>

    @if ($pembayaran->metode_pembayaran == 'DANA' || $pembayaran->metode_pembayaran == 'OVO' || $pembayaran->metode_pembayaran == 'BCA' || $pembayaran->metode_pembayaran == 'BRI' || $pembayaran->metode_pembayaran == 'BNI' || $pembayaran->metode_pembayaran == 'Mandiri')
        <div class="popup-bukti-pembayaran">
            @if ($pembayaran->bukti_pembayaran != null)
                <a href="#" id="openBuktiPopup">
                    {{-- <i class="fa fa-bookmark"></i> --}}
                    <p>Bukti Pembayaran</p>
                </a>
            @else
                <a href="#" id="openFormBuktiPopup">
                    {{-- <i class="fa fa-user guest"></i> --}}
                    <p>Unggah Bukti Pembayaran</p>
                </a>
            @endif
        </div>
    @endif


    @if ($pembayaran->metode_pembayaran == 'DANA' || $pembayaran->metode_pembayaran == 'OVO' || $pembayaran->metode_pembayaran == 'BCA' || $pembayaran->metode_pembayaran == 'BRI' || $pembayaran->metode_pembayaran == 'BNI' || $pembayaran->metode_pembayaran == 'Mandiri')
        <div class="overlay" id="formBuktiOverlay">
            <div class="bukti-form">
                <span class="close" id="closeFormBuktiPopup"></span>

                @foreach ($hotels as $hotel)
                    <div class="bukti-pembayaran">
                        <p>Bukti Pembayaran</p>
                        <form action="{{ route('booking.hotel.pembayaran.update', ['location' => strtolower($hotel->nama_cabang), 'nama_tipe' => $room->nama_tipe, 'uuid' => $booking->uuid]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                
                            <input type="hidden" name="booking_hotel_id" value="{{ $booking->id }}">
                            <input type="hidden" name="metode_pembayaran" value="{{ $pembayaran->metode_pembayaran }}">
            
                            <div class="file-preview-container">
                                <input type="file" id="file-input" name="bukti_pembayaran" accept="image/*" required>
                                <label for="file-input" class="file-label"><i class="fa-solid fa-image"></i></label>
                                <div class="preview-container" id="preview-container">
                                    <img id="preview-image" alt="Preview Gambar" />
                                </div>
                            </div>

                            <button type="submit" class="button-pembayaran">Unggah Bukti Pembayaran</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>


        <div class="overlay" id="buktiOverlay">
            <div class="bukti">
                <span class="close" id="closeBuktiPopup"></span>

                <div class="bukti-pembayaran">
                    <p>Bukti Pembayaran</p>
                    <img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="bukti-pembayaran-image">
                </div>
            </div>
        </div>
    @endif
</div>


@if(!$pembayaran)
<div class="sidebar-pembayarannt">
    <a href="{{ route('hotel.transaksi.lokasi-hotel', ['location' => strtolower($hotel->nama_cabang), 'nama_tipe' => $room->nama_tipe, 'uuid' => $booking->uuid]) }}">
        {{-- <span class="tooltip">Lokasi</span> --}}
        <p class="bi bi-map">
            <span class="tooltip">Lokasi</span>
        </p>
    </a>
    <a href="{{ route('hotel.transaksi.transaksi-hotel', ['location' => strtolower($hotel->nama_cabang), 'nama_tipe' => $room->nama_tipe, 'uuid' => $booking->uuid]) }}" class="active">
        {{-- <span class="tooltip">Reservasi</span> --}}
        <p class="bi bi-calendar2-check">
            <span class="tooltip">Reservasi</span>
        </p>
    </a>
</div>
@else
<div class="sidebar">
    <a href="{{ route('hotel.transaksi.lokasi-hotel', ['location' => strtolower($hotel->nama_cabang), 'nama_tipe' => $room->nama_tipe, 'uuid' => $booking->uuid]) }}">
        {{-- <span class="tooltip">Lokasi</span> --}}
        <p class="bi bi-map">
            <span class="tooltip">Lokasi</span>
        </p>
    </a>
    <a href="{{ route('hotel.transaksi.transaksi-hotel', ['location' => strtolower($hotel->nama_cabang), 'nama_tipe' => $room->nama_tipe, 'uuid' => $booking->uuid]) }}">
        {{-- <span class="tooltip">Reservasi</span> --}}
        <p class="bi bi-calendar2-check">
            <span class="tooltip">Reservasi</span>
        </p>
    </a>
    <a href="{{ route('hotel.transaksi.pembayaran-hotel', ['location' => strtolower($hotel->nama_cabang), 'nama_tipe' => $room->nama_tipe, 'uuid' => $booking->uuid]) }}" class="active">
        {{-- <span class="tooltip">Pembayaran</span> --}}
        <p class="bi bi-cash-coin">
            <span class="tooltip">Pembayaran</span>
        </p>
    </a>
</div>

<div class="bukti-reservasi">
    <a href="#" id="openBuktiReservasiPopup">
        <p class="bi bi-file-earmark-arrow-down">
            <span class="tooltip">Bukti Reservasi</span>
        </p>
    </a>
</div>
@endif


<div class="kembali">
    <a href="{{ route('profile', ['id' => auth()->user()->id, 'firstname' => auth()->user()->firstname, 'lastname' => auth()->user()->lastname]) }}">
        <p>Kembali</p>
    </a>
</div>


<div class="overlay" id="buktiReservasiOverlay">
    <div class="bukti">
        <span class="close" id="closeBuktiReservasiPopup"></span>
        
        @foreach ($hotels as $hotel)
        <div id="buktiReservasi">
            <h1>Reservasi Hotel</h1>

            <div class="head">
                <div class="left">
                    <h4>#invoice {{ substr($booking->uuid, 0, 5) }}</h4>
                    <p>{{ $room->nama_tipe }}</p>
                </div>

                <div class="right">
                    <h4>{{ $hotel->nama_cabang }}</h4>
                    <p>{{ \Carbon\Carbon::parse($booking->created_at)->format('d/m/Y') }}</p>
                </div>
            </div>

            <div class="body">
                <div class="b-1">
                    {{-- <h5>PEMESAN</h5> --}}
                    <div class="p">    
                        <p>Nama</p>
                        <p>Telepon</p>
                        {{-- <p>Telepon</p> --}}
                    </div>
                    <div class="h4">
                        <h4>{{ $booking->user->firstname }} {{ $booking->user->lastname }}</h4>
                        <h4 style="padding-top: 9px">{{ $booking->user->no_telp }}</h4>
                        {{-- <h4 style="padding-top: 5px">{{ $booking->user->no_telp }}</h4> --}}
                    </div>
                </div>
                <div class="b-2">
                    <h5>RESERVASI</h5>
                    <div class="checkin">
                        <h4>Check In</h4>
                        <p>{{ \Carbon\Carbon::parse($booking->check_in)->format('d F Y') }}</p>
                    </div>
                    <div class="garis"></div>
                    <div class="checkout">
                        <h4>Check Out</h4>
                        <p>{{ \Carbon\Carbon::parse($booking->check_out)->format('d F Y') }}</p>
                    </div>

                    <div class="angka">
                        <div class="data">
                            <h4>{{ $booking->jumlah_kamar }}</h4>
                            <p>Kamar</p>
                        </div>
                        <div class="garis-2"></div>
                        <div class="data">
                            <h4>{{ $booking->tamu_dewasa }}</h4>
                            <p>Dewasa</p>
                        </div>
                        <div class="garis-2"></div>
                        <div class="data">
                            <h4>{{ $booking->tamu_anak }}</h4>
                            <p>Anak</p>
                        </div>
                    </div>
                </div>
                <div class="b-3">
                    <h5>Total</h5>
                    <p>Rp{{ number_format($booking->jumlah_harga, 2, ',', '.') }}</p>
                </div>
                <div class="b-4">
                    <img src="{{ asset('img/logo-black.png') }}" alt="Hotel image">
                    <h4>Berlian Hotel</h4>
                </div>
            </div>
        </div>
        @endforeach

        <button id="saveBuktiReservasi">Simpan Bukti Reservasi</button>
    </div>
</div>





<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Fungsi untuk preview gambar setelah dipilih
        document.getElementById('file-input').addEventListener('change', function(event) {
            const fileInput = event.target;
            const previewContainer = document.getElementById('preview-container');
            const previewImage = document.getElementById('preview-image');
            const fileLabel = document.querySelector('.file-label');

            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.style.display = 'block';
                    fileLabel.style.display = 'none'; // Sembunyikan label setelah preview muncul
                };
                reader.readAsDataURL(fileInput.files[0]);
            }

            // Klik pada preview untuk mengubah gambar kembali
            previewImage.addEventListener('click', function() {
                fileInput.click(); // Membuka input file saat gambar preview diklik
            });
        });


        // Element-elemen overlay dan tombol pop-up
        const formBuktiOverlay = document.getElementById('formBuktiOverlay');
        const openFormBuktiPopup = document.getElementById('openFormBuktiPopup');
        const closeFormBuktiPopup = document.getElementById('closeFormBuktiPopup');

        const buktiOverlay = document.getElementById('buktiOverlay');
        const openBuktiPopup = document.getElementById('openBuktiPopup');
        const closeBuktiPopup = document.getElementById('closeBuktiPopup');

        // Buka form bukti pembayaran jika tombol openFormBuktiPopup diklik
        if (openFormBuktiPopup) {
            openFormBuktiPopup.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah action default dari link
                formBuktiOverlay.style.display = 'flex';
                buktiOverlay.style.display = 'none';
            });
        }
        // Tutup form bukti pembayaran jika tombol closeFormBuktiPopup diklik
        if (closeFormBuktiPopup) {
            closeFormBuktiPopup.addEventListener('click', function() {
                formBuktiOverlay.style.display = 'none';
            });
        }
        // Tutup form bukti pembayaran jika area di luar form diklik
        if (formBuktiOverlay) {
            formBuktiOverlay.addEventListener('click', function(e) {
                if (e.target === formBuktiOverlay) {
                    formBuktiOverlay.style.display = 'none';
                }
            });
        }

        // Buka tampilan bukti pembayaran jika tombol openBuktiPopup diklik
        if (openBuktiPopup) {
            openBuktiPopup.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah action default dari link
                buktiOverlay.style.display = 'flex';
                formBuktiOverlay.style.display = 'none';
            });
        }
        // Tutup tampilan bukti pembayaran jika tombol closeBuktiPopup diklik
        if (closeBuktiPopup) {
            closeBuktiPopup.addEventListener('click', function() {
                buktiOverlay.style.display = 'none';
            });
        }
        // Tutup tampilan bukti pembayaran jika area di luar tampilan diklik
        if (buktiOverlay) {
            buktiOverlay.addEventListener('click', function(e) {
                if (e.target === buktiOverlay) {
                    buktiOverlay.style.display = 'none';
                }
            });
        }
    });




    document.addEventListener("DOMContentLoaded", function() {
        const buktiReservasiOverlay = document.getElementById('buktiReservasiOverlay');
        const openBuktiReservasiPopup = document.getElementById('openBuktiReservasiPopup');
        const closeBuktiReservasiPopup = document.getElementById('closeBuktiReservasiPopup');

        // Buka tampilan bukti pembayaran jika tombol openBuktiPopup diklik
        if (openBuktiReservasiPopup) {
            openBuktiReservasiPopup.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah action default dari link
                buktiReservasiOverlay.style.display = 'flex';
                // formBuktiOverlay.style.display = 'none';
            });
        }
        // Tutup tampilan bukti pembayaran jika tombol closeBuktiReservasiPopup diklik
        if (closeBuktiReservasiPopup) {
            closeBuktiReservasiPopup.addEventListener('click', function() {
                buktiReservasiOverlay.style.display = 'none';
            });
        }
        // Tutup tampilan bukti pembayaran jika area di luar tampilan diklik
        if (buktiReservasiOverlay) {
            buktiReservasiOverlay.addEventListener('click', function(e) {
                if (e.target === buktiReservasiOverlay) {
                    buktiReservasiOverlay.style.display = 'none';
                }
            });
        }


        var hotelName = @json($hotels->first()->nama_cabang);
        var uuid = @json($booking->uuid).substring(0, 5);
        
        document.getElementById('saveBuktiReservasi').addEventListener('click', function () {
            html2canvas(document.getElementById('buktiReservasi')).then(function (canvas) {
                // Konversi kanvas menjadi data URL gambar
                let link = document.createElement('a');
                link.href = canvas.toDataURL("image/png");
                link.download = 'Bukti Pembayaran - Hotel Berlian ' + hotelName + ' #' + uuid + '.png';
                link.click();
            });
        });
    });
</script>