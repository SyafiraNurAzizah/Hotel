<title>Berlian Hotel</title>
<link rel="icon" href="{{ asset('img/logo-title.png') }}" type="image/png">

{{-- ------------------------------------------------------------------------------------------------------- --}}


<link rel="stylesheet" href="{{ asset('css/hotel/transaksi/lokasi.css') }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">


@foreach ($hotels as $hotel)
<div class="container">
    <h1>Berlian Hotel</h1>
    <h2>{{ $hotel->nama_cabang }}</h2>

    @if ($booking->hotel_id == 1) {{-- Jakarta --}}
        <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3039.0009092200016!2d106.82539697268969!3d-6.175359356007875!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5d2db8c5617%3A0x4e446b7ac891d847!2sMonas%2C%20Gambir%2C%20Kecamatan%20Gambir%2C%20Kota%20Jakarta%20Pusat%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1731070298159!5m2!1sid!2sid" 
        allowfullscreen="" 
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    @elseif ($booking->hotel_id == 2) {{-- Semarang --}}
        <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1980.107292457536!2d110.40958933820103!3d-6.98398383594367!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708b4f19af0393%3A0x11304de4230ded0d!2sLawang%20Sewu%20Semarang!5e0!3m2!1sid!2sid!4v1731074381052!5m2!1sid!2sid" 
        allowfullscreen="" 
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    @elseif ($booking->hotel_id == 3) {{-- Bogor --}}
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3785.108350995242!2d106.79603268146874!3d-6.597494426421049!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5a3b043bfe3%3A0xb39ecf394e52205b!2sIstana%20KePresidenan%20Bogor!5e0!3m2!1sid!2sid!4v1731074482119!5m2!1sid!2sid"
        llowfullscreen="" 
        loading="lazy" 
        referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    @endif
</div>
@endforeach


@if(!$pembayaran)
<div class="sidebar-pembayarannt">
    <a href="{{ route('hotel.transaksi.lokasi-hotel', ['location' => strtolower($hotel->nama_cabang), 'nama_tipe' => $room->nama_tipe, 'uuid' => $booking->uuid]) }}" class="active">
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
</div>
@else
<div class="sidebar">
    <a href="{{ route('hotel.transaksi.lokasi-hotel', ['location' => strtolower($hotel->nama_cabang), 'nama_tipe' => $room->nama_tipe, 'uuid' => $booking->uuid]) }}" class="active">
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
    <a href="{{ route('hotel.transaksi.pembayaran-hotel', ['location' => strtolower($hotel->nama_cabang), 'nama_tipe' => $room->nama_tipe, 'uuid' => $booking->uuid]) }}">
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
    <a href="{{ route('profile', ['firstname' => auth()->user()->firstname, 'lastname' => auth()->user()->lastname]) }}">
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