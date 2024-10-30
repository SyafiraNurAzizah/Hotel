<title>Berlian Hotel</title>
<link rel="icon" href="{{ asset('img/logo-title.png') }}" type="image/png">

{{-- ------------------------------------------------------------------------------------------------------- --}}


<link rel="stylesheet" href="{{ asset('css/pembayaran.css') }}">

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
    {{-- <div class="horizontal-line-1"></div> --}}
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
        {{-- <form action="#" method="POST">
            @csrf
        
            <label>
                <input type="radio" name="option" value="option1" required>
                Opsi 1
            </label><br>
        
            <label>
                <input type="radio" name="option" value="option2">
                Opsi 2
            </label><br>
        
            <label>
                <input type="radio" name="option" value="option3">
                Opsi 3
            </label><br>
        
            <button type="submit">Kirim</button>
        </form>         --}}
    </div>
    
    @foreach($hotels as $hotel)
    <form action="{{ route('booking.hotel.cancel', ['location' => strtolower($hotel->nama_cabang), 'nama_tipe' => $room->nama_tipe, 'uuid' => $booking->uuid]) }}" method="POST" class="form-batal">
        @csrf
        <button type="submit" class="btn btn-danger">Batalkan Pemesanan</button>
    </form>
@endforeach

    
</div>