<link rel="stylesheet" href="{{ asset('css/pembayaran.css') }}">

<div class="container">
    <div class="container-left">
        <img src="{{ asset('img/logo.png') }}" alt="Hotel image">
        <h1>Hotel</h1>
        <h2>- {{ $room->nama_tipe }}</h2>
    </div>
    <div class="container-right">
        <p>Terima kasih telah melakukan pemesanan di Hotel Berlian.</p>
        <p>Berikut adalah detail pemesanan Anda:</p>
    </div>

    {{-- <p>Jumlah Kamar: {{ $jumlahKamar }}</p> --}}
    {{-- <h2>Total Price: Rp {{ number_format($totalPrice, 2, ',', '.') }}</h2> --}}
</div>