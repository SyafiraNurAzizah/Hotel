<title>Berlian Hotel</title>
<link rel="icon" href="{{ asset('img/logo-title.png') }}" type="image/png">

{{-- ------------------------------------------------------------------------------------------------------- --}}


<link rel="stylesheet" href="{{ asset('css/lokasi.css') }}">

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


{{-- @foreach ($hotels as $hotel) --}}
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
    <p class="bi bi-file-earmark-arrow-down">
        <span class="tooltip">Bukti Reservasi</span>
    </p>
</div>
@endif
@endforeach
