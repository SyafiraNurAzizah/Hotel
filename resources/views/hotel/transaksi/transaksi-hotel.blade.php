<title>Berlian Hotel</title>
<link rel="icon" href="{{ asset('img/logo-title.png') }}" type="image/png">

{{-- ------------------------------------------------------------------------------------------------------- --}}


<link rel="stylesheet" href="{{ asset('css/hotel/transaksi/transaksi.css') }}">

{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">


{{-- <div class="back">
    <i class="bi bi-arrow-left"></i>
    <a href="{{ route('profile', ['firstname' => auth()->user()->firstname, 'lastname' => auth()->user()->lastname]) }}"">Kembali</a>
</div> --}}

<div class="container">

    <div class="container-title">   
        <div class="container-left">
            <img src="{{ asset('img/logo.png') }}" alt="Hotel image">
            <h1>Hotel</h1>
            <h2>- {{ $room->nama_tipe }}</h2>
        </div>
        <div class="container-right">
            <p>Terima kasih telah melakukan pemesanan di Hotel Berlian.</p>
            <p>Berikut adalah detail pemesanan Anda:</p>
        </div>
    </div>

    <div class="container-isi">
        <div class="data-text">
            <div class="container-is-booking-text">
                <p>Nama</p>
                <h3>{{ $booking->user->firstname }} {{ $booking->user->lastname }}</h3>
            </div>
            <div class="container-is-booking-text">
                <p>Check-In</p>
                <h3>{{ \Carbon\Carbon::parse($booking->check_in)->format('d F Y') }}</h3>
            </div>
            <div class="container-is-booking-text">
                <p>Check-Out</p>
                <h3>{{ \Carbon\Carbon::parse($booking->check_out)->format('d F Y') }}</h3>
            </div>            
        </div>

        {{-- <div class="horizontal-line-1"></div> --}}

        <div class="data-harga">
            <h3>Total</h3>
            <h2>Rp{{ number_format($booking->jumlah_harga, 2, ',', '.') }}</h2>
        </div>

        <div class="data-number">
            <div class="container-isi-booking-number">
                <h2>{{ $booking->jumlah_kamar }}</h2>
                <p>Kamar</p>
            </div>
            <div class="vertical-line"></div>
            <div class="container-isi-booking-number">
                <h2>{{ $booking->tamu_dewasa }}</h2>
                <p>Dewasa</p>
            </div>
            <div class="vertical-line"></div>
            <div class="container-isi-booking-number">
                <h2>{{ $booking->tamu_anak }}</h2>
                <p>Anak</p>
            </div>
        </div>
    </div>

    <div class="container-metode-pembayaran">
        @foreach($hotels as $hotel)
            @if($booking->status !== 'dibatalkan' && $booking->status !== 'selesai')
                @if(!$pembayaran)
                    <form action="{{ route('booking.hotel.pembayaran', ['location' => strtolower($hotel->nama_cabang), 'nama_tipe' => $room->nama_tipe, 'uuid' => $booking->uuid]) }}" method="POST">
                        @csrf 
        
                        <p>Metode Pembayaran</p>
        
                        <div class="dropdown" id="mainDropdown">
                            <button type="button" id="dropdownButton">Pilih Metode Pembayaran</button>
                            <div class="dropdown-content" id="dropdownContent">
                                <div class="dropdown-item" onclick="selectOption('Cash')"><a>Cash</a></div>
                                <div class="dropdown-item" onclick="selectOption('Kartu Kredit/Debit')"><a>Kartu Kredit/Debit</a></div>
                                <div class="sub-dropdown">
                                    <a>Dompet Digital</a>
                                    <div class="sub-dropdown-content" style="height: 82px">
                                        <div onclick="selectOption('OVO')">OVO</div>
                                        <div onclick="selectOption('DANA')">DANA</div>
                                    </div>
                                </div>
                                <div class="sub-dropdown">
                                    <a>Transfer Bank</a>
                                    <div class="sub-dropdown-content">
                                        <div onclick="selectOption('BCA')">BCA</div>
                                        <div onclick="selectOption('BRI')">BRI</div>
                                        <div onclick="selectOption('BNI')">BNI</div>
                                        <div onclick="selectOption('Mandiri')">Mandiri</div>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <input type="hidden" name="booking_hotel_id" value="{{ $booking->id }}">
                        <input type="text" id="dropdownInput" name="metode_pembayaran" placeholder="Pilihan Anda" readonly hidden>
                        <input type="hidden" name="bukti_pembayaran" accept="image/*">
        
                        <button type="submit" class="button-pembayaran">Pesan</button>
                    </form>
                @else
                    <div class="pembayaran-exsist">
                        <p>Metode Pembayaran</p>
                        <h3>{{ $pembayaran->metode_pembayaran }}</h3>
                        <div class="horizontal-line-pembayaran-exsist"></div>
                    </div>
                @endif
            @endif
        @endforeach
    </div>
    
    @if($booking->status !== 'dibatalkan' && $booking->status !== 'selesai')
        @if(!$pembayaran)
            @foreach($hotels as $hotel)
                <form action="{{ route('booking.hotel.cancel', ['location' => strtolower($hotel->nama_cabang), 'nama_tipe' => $room->nama_tipe, 'uuid' => $booking->uuid]) }}" method="POST" class="form-batal">
                    @csrf
                    <button type="submit" class="btn btn-danger">Batalkan Pemesanan</button>
                </form>
            @endforeach
        @endif
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
    <a href="{{ route('hotel.transaksi.transaksi-hotel', ['location' => strtolower($hotel->nama_cabang), 'nama_tipe' => $room->nama_tipe, 'uuid' => $booking->uuid]) }}" class="active">
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
        function selectOption(value) {
            // Set nilai yang dipilih ke input text tersembunyi
            document.getElementById('dropdownInput').value = value;
        
            // Set teks yang dipilih di tombol utama
            document.getElementById('dropdownButton').innerText = value;
            
            // Sembunyikan dropdown setelah pilihan dipilih
            document.getElementById('dropdownContent').style.display = 'none';
        }
    
        // Menampilkan dropdown saat tombol utama diklik
        const dropdownButton = document.getElementById('dropdownButton');

        if (dropdownButton) {
            document.getElementById('dropdownButton').addEventListener('click', function(event) {
                // Mencegah event bubbling agar dropdown tidak tertutup saat sub-item diklik
                event.stopPropagation();
                var dropdownContent = document.getElementById('dropdownContent');
                dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
            });
        }
    
        // Menutup dropdown jika area lain pada halaman diklik
        document.addEventListener('click', function(event) {
            document.getElementById('dropdownContent').style.display = 'none';
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