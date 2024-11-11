@extends('layouts.app')

@section('content')
<h1>Buat Booking Meeting</h1>

<form action="{{ route('meeting_bookings.store') }}" method="POST">
    @csrf
    <label>User ID:</label>
    <input type="number" name="user_id" required>

    <label>Ruang Meeting:</label>
    <input type="text" name="meeting_room" required>

    <label>Tanggal:</label>
    <input type="date" name="date" required>

    <label>Waktu Mulai:</label>
    <input type="time" name="start_time" required>

    <label>Waktu Selesai:</label>
    <input type="time" name="end_time" required>

    <label>Catatan:</label>
    <textarea name="notes"></textarea>

    <button type="submit"> Booking</button>
</form>
@endsection
