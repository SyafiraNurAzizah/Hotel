@extends('layouts.app')

@section('content')
<h1>Daftar Booking Meeting</h1>

<table>
    <thead>
        <tr>
            <th>Ruang Meeting</th>
            <th>Tanggal</th>
            <th>Waktu Mulai</th>
            <th>Waktu Selesai</th>
            <th>Catatan</th>
            <th>User</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($bookings as $booking)
        <tr>
            <td>{{ $booking->meeting_room }}</td>
            <td>{{ $booking->date }}</td>
            <td>{{ $booking->start_time }}</td>
            <td>{{ $booking->end_time }}</td>
            <td>{{ $booking->notes }}</td>
            <td>{{ $booking->user->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
