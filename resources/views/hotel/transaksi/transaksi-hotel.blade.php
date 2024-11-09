<title>Berlian Hotel</title>
<link rel="icon" href="{{ asset('img/logo-title.png') }}" type="image/png">

{{-- ------------------------------------------------------------------------------------------------------- --}}


<link rel="stylesheet" href="{{ asset('css/transaksi.css') }}">

{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">


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
        @endforeach
    </div>
    
    @if(!$pembayaran)
        @foreach($hotels as $hotel)
            <form action="{{ route('booking.hotel.cancel', ['location' => strtolower($hotel->nama_cabang), 'nama_tipe' => $room->nama_tipe, 'uuid' => $booking->uuid]) }}" method="POST" class="form-batal">
                @csrf
                <button type="submit" class="btn btn-danger">Batalkan Pemesanan</button>
            </form>
        @endforeach
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
    <p class="bi bi-file-earmark-arrow-down">
        <span class="tooltip">Bukti Reservasi</span>
    </p>
</div>
@endif






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
    document.getElementById('dropdownButton').addEventListener('click', function(event) {
        // Mencegah event bubbling agar dropdown tidak tertutup saat sub-item diklik
        event.stopPropagation();
        var dropdownContent = document.getElementById('dropdownContent');
        dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
    });
  
    // Menutup dropdown jika area lain pada halaman diklik
    document.addEventListener('click', function(event) {
        document.getElementById('dropdownContent').style.display = 'none';
    });
</script>