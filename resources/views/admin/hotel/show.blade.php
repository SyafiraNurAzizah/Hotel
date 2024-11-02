@extends('layouts.app')
@push('styles')
<style>
    /* CSS untuk Tombol Kembali */
.back-button {
    position: fixed;
    top: 90px; /* Sesuaikan posisi vertikal */
    left: 40px; /* Sesuaikan posisi horizontal */
}

.btn-back {
    background-color: #dfa974;
    color: white;
    padding: 10px 15px;
    border-radius: 50% ;
    text-decoration: none;
    font-size: 20px;
    transition: background-color 0.3s ease;
}

.btn-back:hover {
    background-color: #c97a5b;
}
</style>
@endpush
@section('content')
<br><br><br><br><br>
<div class="back-button">
    <h3><a href="javascript:history.back()" class="btn btn-back">←</a></h3>
</div>
<br><br>
<div class="container">
    <h2 class="mb-4">Detail Reservasi</h2>

    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>Nama Pengguna</th>
                <td>{{ $bookinghotels->user->firstname }} {{ $bookinghotels->user->lastname }}</td>
            </tr>
            <tr>
                <th>Hotel</th>
                <td>{{ $bookinghotels->hotel->nama_cabang ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Tipe Kamar</th>
                <td>{{ $bookinghotels->tipe_kamar->nama_tipe ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Check-In</th>
                <td>{{ \Carbon\Carbon::parse($bookinghotels->checkin)->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <th>Check-Out</th>
                <td>{{ \Carbon\Carbon::parse($bookinghotels->checkout)->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <th>Tamu Dewasa</th>
                <td>{{ $bookinghotels->tamu_dewasa }}</td>
            </tr>
            <tr>
                <th>Tamu Anak</th>
                <td>{{ $bookinghotels->tamu_anak }}</td>
            </tr>
            <tr>
                <th>Jumlah Kamar</th>
                <td>{{ $bookinghotels->jumlah_kamar }}</td>
            </tr>
            <tr>
                <th>Jumlah Harga</th>
                <td>Rp{{ number_format($bookinghotels->jumlah_harga, 2) }}</td>
            </tr>
            <tr>
                <th>Pesan</th>
                <td>{{ $bookinghotels->pesan }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    @if($bookinghotels->status == 'SELESAI')
                        <span style="color: green; font-weight: bold;">{{ $bookinghotels->status }}</span>
                    @elseif($bookinghotels->status == 'BELUM_SELESAI')
                        <span style="color: orange; font-weight: bold;">{{ $bookinghotels->status }}</span>
                    @elseif($bookinghotels->status == 'DIBATALKAN')
                        <span style="color: red; font-weight: bold;">{{ $bookinghotels->status }}</span>
                    @else
                        <span>{{ $bookinghotels->status }}</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Status Pembayaran</th>
                <td>
                    @if($bookinghotels->status_pembayaran == 'DIBAYAR')
                        <span style="color: green; font-weight: bold;">{{ $bookinghotels->status_pembayaran }}</span>
                    @elseif($bookinghotels->status_pembayaran == 'BELUM_DIBAYAR')
                        <span style="color: red; font-weight: bold;">{{ $bookinghotels->status_pembayaran }}</span>
                    @else
                        <span>{{ $bookinghotels->status_pembayaran }}</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Tanggal & Waktu Pemesanan</th>
                <td>{{ $bookinghotels->created_at->format('d-m-Y, H:i:s') }}</td>
            </tr>
        </tbody>
    </table>
</div>

<br><br><br>
@endsection
