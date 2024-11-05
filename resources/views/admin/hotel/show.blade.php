@extends('layouts.app')
@push('styles')
<style>
    /* CSS untuk Tombol Kembali */
    .back-button {
        position: fixed;
        top: 90px;
        left: 40px;
    }

    .btn-back {
        background-color: #dfa974;
        color: white;
        padding: 10px 15px;
        border-radius: 50%;
        text-decoration: none;
        font-size: 20px;
        transition: background-color 0.3s ease;
    }

    .btn-back:hover {
        background-color: #c97a5b;
    }

    /* Gaya Card */
    .card {
        margin-top: 20px;
        padding: 20px 30px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        background-color: #fff;
    }

    .card h2 {
        margin-bottom: 20px;
        color: #333;
        text-align: center;
    }

    /* Gaya Konten */
    .content-row {
        display: flex;
        flex-direction: column;
        padding: 15px 0;
        text-align: center;
        border-bottom: 1px solid #f0f0f0;
    }

    .content-row:last-child {
        border-bottom: none;
    }

    .content-row .label {
        color: #777;
        font-weight: 500;
        font-size: 14px;
        margin-bottom: 5px;
    }

    .content-row .value {
        font-weight: bold;
        color: #333;
        font-size: 16px;
    }

    /* Penekanan pada Status */
    .status-selesai {
        color: green;
    }

    .status-belum-selesai {
        color: orange;
    }

    .status-dibatalkan {
        color: red;
    }

    /* Penekanan pada Status Pembayaran */
    .status-dibayar {
        color: green;
    }

    .status-belum-dibayar {
        color: red;
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
    <div class="card">
        <h2>Detail Reservasi</h2>

        <div class="content-row">
            <div class="label">Nama Pengguna</div>
            <div class="value">{{ $bookinghotels->user->firstname }} {{ $bookinghotels->user->lastname }}</div>
        </div>
        <div class="content-row">
            <div class="label">Hotel</div>
            <div class="value">{{ $bookinghotels->hotel->nama_cabang ?? 'N/A' }}</div>
        </div>
        <div class="content-row">
            <div class="label">Tipe Kamar</div>
            <div class="value">{{ $bookinghotels->tipe_kamar->nama_tipe ?? 'N/A' }}</div>
        </div>
        <div class="content-row">
            <div class="label">Check-In</div>
            <div class="value">{{ \Carbon\Carbon::parse($bookinghotels->checkin)->format('d-m-Y') }}</div>
        </div>
        <div class="content-row">
            <div class="label">Check-Out</div>
            <div class="value">{{ \Carbon\Carbon::parse($bookinghotels->checkout)->format('d-m-Y') }}</div>
        </div>
        <div class="content-row">
            <div class="label">Tamu Dewasa</div>
            <div class="value">{{ $bookinghotels->tamu_dewasa }}</div>
        </div>
        <div class="content-row">
            <div class="label">Tamu Anak</div>
            <div class="value">{{ $bookinghotels->tamu_anak }}</div>
        </div>
        <div class="content-row">
            <div class="label">Jumlah Kamar</div>
            <div class="value">{{ $bookinghotels->jumlah_kamar }}</div>
        </div>
        <div class="content-row">
            <div class="label">Jumlah Harga</div>
            <div class="value">Rp{{ number_format($bookinghotels->jumlah_harga, 2) }}</div>
        </div>
        <div class="content-row">
            <div class="label">Pesan</div>
            <div class="value">{{ $bookinghotels->pesan }}</div>
        </div>
        <div class="content-row">
            <div class="label">Status</div>
            <div class="value">
                @if($bookinghotels->status == 'selesai')
                    <span class="status-selesai">{{ ucwords(str_replace('_', ' ', $bookinghotels->status)) }}</span>
                @elseif($bookinghotels->status == 'belum_selesai')
                    <span class="status-belum-selesai">{{ ucwords(str_replace('_', ' ', $bookinghotels->status)) }}</span>
                @elseif($bookinghotels->status == 'dibatalkan')
                    <span class="status-dibatalkan">{{ ucwords(str_replace('_', ' ', $bookinghotels->status)) }}</span>
                @else
                    <span>{{ ucwords(str_replace('_', ' ', $bookinghotels->status)) }}</span>
                @endif
            </div>
        </div>
        <div class="content-row">
            <div class="label">Status Pembayaran</div>
            <div class="value">
                @if($bookinghotels->status_pembayaran == 'dibayar')
                    <span class="status-dibayar">{{ ucwords(str_replace('_', ' ', $bookinghotels->status_pembayaran)) }}</span>
                @elseif($bookinghotels->status_pembayaran == 'belum_dibayar')
                    <span class="status-belum-dibayar">{{ ucwords(str_replace('_', ' ', $bookinghotels->status_pembayaran)) }}</span>
                @else
                    <span>{{ ucwords(str_replace('_', ' ', $bookinghotels->status_pembayaran)) }}</span>
                @endif
            </div>
        </div>
        <div class="content-row">
            <div class="label">Tanggal & Waktu Pemesanan</div>
            <div class="value">{{ $bookinghotels->created_at->format('d-m-Y, H:i:s') }}</div>
        </div>
    </div>
</div>

<br><br><br>
@endsection
