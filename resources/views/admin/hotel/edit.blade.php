@extends('layouts.app')

@section('content')
<br><br><br><br>
<div class="container">
    {{-- <a href="{{ route('admin.hotel.index') }}" class="btn btn-primary mb-4">Back</a> --}}

    <h2>Edit Pemesanan Hotel</h2>

    <form action="{{ route('admin.hotel.update', $bookinghotel->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="user_id">User ID</label>
            <input type="text" class="form-control" id="user_id" value="{{ $bookinghotel->user->name }}" readonly>
        </div>

        <div class="form-group">
            <label for="hotel_id">Hotel</label>
            <input type="text" class="form-control" id="hotel_id" value="{{ $bookinghotel->hotel->nama_cabang }}" readonly>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="selesai" {{ $bookinghotel->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="belum_selesai" {{ $bookinghotel->status == 'belum_selesai' ? 'selected' : '' }}>Belum Selesai</option>
                <option value="dibatalkan" {{ $bookinghotel->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="status_pembayaran">Status Pembayaran</label>
            <select class="form-control" id="status_pembayaran" name="status_pembayaran">
                <option value="dibayar" {{ $bookinghotel->status_pembayaran == 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                <option value="belum_dibayar" {{ $bookinghotel->status_pembayaran == 'belum_dibayar' ? 'selected' : '' }}>Belum Dibayar</option>
            </select>
        </div>

        <div class="form-group">
            <label for="jumlah_harga">Jumlah Harga</label>
            <input type="text" class="form-control" id="jumlah_harga" name="jumlah_harga" value="{{ $bookinghotel->jumlah_harga }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        {{-- <a href="{{ route('admin.hotel.index') }}" class="btn btn-secondary">Batal</a> --}}
    </form>
</div>
<br><br><br>
@endsection
