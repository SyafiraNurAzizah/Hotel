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

/* Styling Form */
.form-group label {
    font-weight: bold;
}

.btn-save {
    background-color: #dfa974;
    color: white;
}

.btn-save:hover {
    background-color: #c97a5b;
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
    <h2 class="mb-4">Edit Booking Meeting</h2>

    <form action="{{ route('admin.meetingss.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')
    
        <!-- The rest of your form fields -->
        <div class="form-group mb-3">
            <label for="hotel_id">Hotel ID</label>
            <input type="text" class="form-control" id="hotel_id" name="hotel_id" value="{{ $booking->hotel_id }}" required>
        </div>
    
        <div class="form-group mb-3">
            <label for="meeting_id">Meeting ID</label>
            <input type="text" class="form-control" id="meeting_id" name="meeting_id" value="{{ $booking->meeting_id }}" required>
        </div>
    
        <div class="form-group mb-3">
            <label for="date">Tanggal</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ $booking->date }}" required>
        </div>
    
        <div class="form-group mb-3">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="selesai" {{ $booking->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="belum_selesai" {{ $booking->status == 'belum_selesai' ? 'selected' : '' }}>Belum Selesai</option>
                <option value="sedang_diproses" {{ $booking->status == 'sedang_diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                <option value="dibatalkan" {{ $booking->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
        </div>
    
        <div class="form-group mb-3">
            <label for="status_pembayaran">Status Pembayaran</label>
            <select class="form-control" id="status_pembayaran" name="status_pembayaran" required>
                <option value="belum_dibayar" {{ $booking->status_pembayaran == 'belum_dibayar' ? 'selected' : '' }}>Belum Dibayar</option>
                <option value="dibayar" {{ $booking->status_pembayaran == 'dibayar' ? 'selected' : '' }}>Dibayar</option>
            </select>
        </div>
    
        <button type="submit" class="btn btn-save mt-3">
            <i class="fas fa-save"></i> Simpan Perubahan
        </button>
    </form>
    
</div>
@endsection
