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
    .status-selesai {
        color: green;
    }
    .status-belum-selesai {
        color: yellow;
    }
    .status-sedang-diproses {
        color: blue;
    }
    .status-dibatalkan {
        color: red;
    }

    .status-dibayar {
        color: green;
    }
    .status-belum-dibayar {
        color: red;
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
                <div class="label">UUID</div>
                <div class="value">{{ $booking->uuid }}</div>
            </div>
            <div class="content-row">
                <div class="label">User ID</div>
                <div class="value">{{ $booking->user->firstname }} {{ $booking->user->lastname }}</div>
            </div>
            <div class="content-row">
                <div class="label">Hotel ID</div>
                <div class="value">{{ $booking->hotel->nama_cabang }}</div>
            </div>

            <!-- Kolom 2 -->
            <div class="content-row">
                <div class="label">Meeting ID</div>
                <div class="value">{{ $booking->meeting->nama_ruang  }}</div>
            </div>
            <div class="content-row">
                <div class="label">Tanggal</div>
                <div class="value">{{ \Carbon\Carbon::parse($booking->date)->format('d-m-Y') }}</div>
            </div>
            <div class="content-row">
                <div class="label">Jam Mulai</div>
                <div class="value">{{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}</div>
            </div>

            <!-- Kolom 3 -->
            <div class="content-row">
                <div class="label">Jam Selesai</div>
                <div class="value">{{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}</div>
            </div>
            <div class="content-row">
                <div class="label">Status</div>
                <div class="value">
                    @if($booking->status == 'selesai')
                        <span class="status-selesai">
                            <i class="fas fa-check-circle"></i> <!-- Ikon untuk selesai -->
                            {{ ucwords(str_replace('_', ' ', $booking->status)) }}
                        </span>
                    @elseif($booking->status == 'belum_selesai')
                        <span class="status-belum-selesai">
                            <i class="fas fa-hourglass-half"></i> <!-- Ikon untuk belum selesai -->
                            {{ ucwords(str_replace('_', ' ', $booking->status)) }}
                        </span>
                    @elseif($booking->status == 'sedang_diproses')
                        <span class="status-sedang-diproses">
                            <i class="fas fa-spinner"></i> <!-- Ikon untuk sedang diproses -->
                            {{ ucwords(str_replace('_', ' ', $booking->status)) }}
                        </span>
                    @elseif($booking->status == 'dibatalkan')
                        <span class="status-dibatalkan">
                            <i class="fas fa-times-circle"></i> <!-- Ikon untuk dibatalkan -->
                            {{ ucwords(str_replace('_', ' ', $booking->status)) }}
                        </span>
                    @else
                        <span>
                            <i class="fas fa-info-circle"></i> <!-- Ikon default untuk status lainnya -->
                            {{ ucwords(str_replace('_', ' ', $booking->status)) }}
                        </span>
                    @endif
                </div>
            </div>
            
            <div class="content-row">
    <div class="label">Status Pembayaran</div>
    <div class="value">
        @if($booking->status_pembayaran == 'dibayar')
            <span class="status-dibayar">
                <i class="fas fa-check-circle"></i> <!-- Ikon untuk pembayaran dibayar -->
                {{ ucwords(str_replace('_', ' ', $booking->status_pembayaran)) }}
            </span>
        @elseif($booking->status_pembayaran == 'belum_dibayar')
            <span class="status-belum-dibayar">
                <i class="fas fa-exclamation-circle"></i> <!-- Ikon untuk pembayaran belum dibayar -->
                {{ ucwords(str_replace('_', ' ', $booking->status_pembayaran)) }}
            </span>
        @else
            <span>
                <i class="fas fa-info-circle"></i> <!-- Ikon default untuk status pembayaran lainnya -->
                {{ ucwords(str_replace('_', ' ', $booking->status_pembayaran)) }}
            </span>
        @endif
    </div>
</div>


            <div class="content-row">
                <div class="label">Jumlah Harga</div>
                <div class="value">Rp{{ number_format($booking->jumlah_harga, 2) }}</div>
            </div>

            <!-- Kolom 4 -->
            <div class="content-row">
                <div class="label">Pesan</div>
                <div class="value">{{ $booking->pesan }}</div>
            </div>

            
        </div>
    </div>
</div>

<br><br><br>
@endsection
