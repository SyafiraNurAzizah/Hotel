@extends('layouts.app')

@push('styles')
<!-- Tambahkan link ke Font Awesome -->
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

/* Styling Card untuk Menampilkan Detail */
.card {
    background-color: #f9f9f9;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

.card-header {
    background-color: #dfa974;
    color: white;
    padding: 10px;
    font-weight: bold;
    font-size: 18px;
    border-radius: 8px 8px 0 0;
    text-align: center;
}

.card-body {
    padding: 15px;
    font-size: 16px;
}

.card-body .field-label {
    font-weight: bold;
    margin-right: 10px;
}

.card-body .field-value {
    color: #555;
}

.btn-edit, .btn-back {
    display: inline-block;
    margin-top: 10px;
}
</style>
@endpush

@section('content')
<br><br><br><br><br>
<div class="back-button">
    <h3><a href="javascript:history.back()" class="btn btn-back"><i class="fas fa-arrow-left"></i></a></h3>
</div>
<br>
<div class="container">
    <div class="card">
        <div class="card-header">Detail Booking Meeting</div>
        <div class="card-body">
            <p><span class="field-label">ID Booking:</span> <span class="field-value">{{ $booking->id }}</span></p>
            <p><span class="field-label">Hotel ID:</span> <span class="field-value">{{ $booking->hotel_id }}</span></p>
            <p><span class="field-label">Meeting ID:</span> <span class="field-value">{{ $booking->meeting_id }}</span></p>
            <p><span class="field-label">Nama:</span> <span class="field-value">{{ $booking->name }}</span></p>
            <p><span class="field-label">Email:</span> <span class="field-value">{{ $booking->email }}</span></p>
            <p><span class="field-label">Telepon:</span> <span class="field-value">{{ $booking->phone }}</span></p>
            <p><span class="field-label">Tanggal:</span> <span class="field-value">{{ $booking->date }}</span></p>
            <p><span class="field-label">Waktu Mulai:</span> <span class="field-value">{{ $booking->start_time }}</span></p>
            <p><span class="field-label">Waktu Selesai:</span> <span class="field-value">{{ $booking->end_time }}</span></p>
            <p><span class="field-label">Status:</span> <span class="field-value">{{ ucwords(str_replace('_', ' ', $booking->status)) }}</span></p>
            <p><span class="field-label">Status Pembayaran:</span> <span class="field-value">{{ ucwords(str_replace('_', ' ', $booking->status_pembayaran)) }}</span></p>

            <!-- Tombol untuk Edit Booking -->
            <a href="{{ route('admin.meeting.edit', $booking->id) }}" class="btn btn-warning btn-edit">
                <i class="fas fa-edit"></i> Edit Booking
            </a>
        </div>
    </div>
</div>
@endsection
