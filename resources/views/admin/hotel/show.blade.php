@extends('layouts.app')
@push('styles')
<!-- Tambahkan ini jika Anda menggunakan Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

    /* Gaya Konten Grid */
    .content-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 20px;
    }

    .content-row {
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

    /* Ikon untuk setiap label */
    .icon {
        font-size: 20px;
        margin-bottom: 5px;
    }
</style>
@endpush
@section('content')
<br><br><br>
<div class="back-button">
    <h3><a href="javascript:history.back()" class="btn btn-back">←</a></h3>
</div>
<br><br>
<div class="container">
    <div class="card">
        <h2>Detail Reservasi</h2>
        <div class="content-grid">
            <!-- Kolom 1 -->
            <div class="content-row">
                <i class="icon fas fa-user"></i>
                <div class="label">Nama Pengguna</div>
                <div class="value">{{ $booking->user->firstname }} {{ $booking->user->lastname }}</div>
            </div>
            <div class="content-row">
                <i class="icon fas fa-users"></i>
                <div class="label">Tamu Dewasa</div>
                <div class="value">{{ $booking->tamu_dewasa }}</div>
            </div>
            <div class="content-row">
                <i class="icon fas fa-wallet"></i>
                <div class="label">Status Pembayaran</div>
                <div class="value">
                    @if($booking->status_pembayaran == 'dibayar')
                        <span class="status-dibayar">{{ ucwords(str_replace('_', ' ', $booking->status_pembayaran)) }}</span>
                    @elseif($booking->status_pembayaran == 'belum_dibayar')
                        <span class="status-belum-dibayar">{{ ucwords(str_replace('_', ' ', $booking->status_pembayaran)) }}</span>
                    @else
                        <span>{{ ucwords(str_replace('_', ' ', $booking->status_pembayaran)) }}</span>
                    @endif
                </div>
            </div>

            <!-- Kolom 2 -->
            <div class="content-row">
                <i class="icon fas fa-calendar-check"></i>
                <div class="label">Check-In</div>
                <div class="value">{{ \Carbon\Carbon::parse($booking->checkin)->format('d-m-Y') }}</div>
            </div>
            <div class="content-row">
                <i class="icon fas fa-money-bill"></i>
                <div class="label">Jumlah Harga</div>
                <div class="value">Rp{{ number_format($booking->jumlah_harga, 2) }}</div>
            </div>

            <!-- Kolom 3 -->
            <div class="content-row">
                <i class="icon fas fa-hotel"></i>
                <div class="label">Hotel</div>
                <div class="value">{{ $booking->hotel->nama_cabang ?? 'N/A' }}</div>
            </div>
            <div class="content-row">
                <i class="icon fas fa-child"></i>
                <div class="label">Tamu Anak</div>
                <div class="value">{{ $booking->tamu_anak }}</div>
            </div>

            <!-- Kolom 4 -->
            <div class="content-row">
                <i class="icon fas fa-info-circle"></i>
                <div class="label">Status</div>
                <div class="value">
                    @if($booking->status == 'selesai')
                        <span class="status-selesai">{{ ucwords(str_replace('_', ' ', $booking->status)) }}</span>
                    @elseif($booking->status == 'belum_selesai')
                        <span class="status-belum-selesai">{{ ucwords(str_replace('_', ' ', $booking->status)) }}</span>
                    @elseif($booking->status == 'dibatalkan')
                        <span class="status-dibatalkan">{{ ucwords(str_replace('_', ' ', $booking->status)) }}</span>
                    @else
                        <span>{{ ucwords(str_replace('_', ' ', $booking->status)) }}</span>
                    @endif
                </div>
            </div>

            <!-- Kolom 5 -->
            <div class="content-row">
                <i class="icon fas fa-calendar-times"></i>
                <div class="label">Check-Out</div>
                <div class="value">{{ \Carbon\Carbon::parse($booking->checkout)->format('d-m-Y') }}</div>
            </div>
            <div class="content-row">
                <i class="icon fas fa-comment-dots"></i>
                <div class="label">Pesan</div>
                <div class="value">{{ $booking->pesan }}</div>
            </div>
            
            <div class="content-row">
                <i class="icon fas fa-bed"></i>
                <div class="label">Tipe Kamar</div>
                <div class="value">{{ $booking->tipe_kamar->nama_tipe ?? 'N/A' }}</div>
            </div>
            <div class="content-row">
                <i class="icon fas fa-clock"></i>
                <div class="label">Tanggal & Waktu Pemesanan</div>
                <div class="value">{{ $booking->created_at->format('d-m-Y, H:i:s') }}</div>
            </div>
        </div>
    </div>
</div>

<br><br><br>
@endsection
