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
        grid-template-columns: repeat(2, 1fr);
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
        <h2>Detail Booking Meeting</h2>
        <div class="content-grid">
            <!-- Kolom 1 -->
            <div class="content-row">
                <i class="icon fas fa-hotel"></i>
                <div class="label">Hotel ID</div>
                <div class="value">{{ $bookings->hotel_id }}</div>
            </div>
            <div class="content-row">
                <i class="icon fas fa-id-badge"></i>
                <div class="label">Meeting ID</div>
                <div class="value">{{ $bookings->meeting_id }}</div>
            </div>
            <div class="content-row">
                <i class="icon fas fa-user"></i>
                <div class="label">Nama</div>
                <div class="value">{{ $bookings->name }}</div>
            </div>
            <div class="content-row">
                <i class="icon fas fa-envelope"></i>
                <div class="label">Email</div>
                <div class="value">{{ $bookings->email }}</div>
            </div>
            <div class="content-row">
                <i class="icon fas fa-phone"></i>
                <div class="label">Telepon</div>
                <div class="value">{{ $bookings->phone }}</div>
            </div>

            <!-- Kolom 2 -->
            <div class="content-row">
                <i class="icon fas fa-calendar-alt"></i>
                <div class="label">Tanggal</div>
                <div class="value">{{ $bookings->date }}</div>
            </div>
            <div class="content-row">
                <i class="icon fas fa-clock"></i>
                <div class="label">Waktu Mulai</div>
                <div class="value">{{ $bookings->start_time }}</div>
            </div>
            <div class="content-row">
                <i class="icon fas fa-clock"></i>
                <div class="label">Waktu Selesai</div>
                <div class="value">{{ $bookings->end_time }}</div>
            </div>
            <div class="content-row">
                <i class="icon fas fa-info-circle"></i>
                <div class="label">Status</div>
                <div class="value">
                    {{ ucwords(str_replace('_', ' ', $bookings->status)) }}
                </div>
            </div>
            <div class="content-row">
                <i class="icon fas fa-wallet"></i>
                <div class="label">Status Pembayaran</div>
                <div class="value">
                    {{ ucwords(str_replace('_', ' ', $bookings->status_pembayaran)) }}
                </div>
            </div>
        </div>

        <!-- Tombol untuk Edit Booking -->
        <div class="text-center" style="margin-top: 20px;">
            <a href="{{ route('admin.meeting.edit', $bookings->id) }}" class="btn btn-edit">
                <i class="fas fa-edit"></i> Edit Booking
            </a>
        </div>
    </div>
</div>
<br><br><br>
@endsection
