@extends('layouts.app') <!-- Pastikan layout admin sudah ada -->

@section('content')
<br><br><br>
<div class="container">
    <h1 class="my-4">Manage Hotels</h1>
    
    <!-- Tombol untuk menambah hotel baru -->
    {{-- <a href="{{ route('admin.hotel.create') }}" class="btn btn-primary mb-3">Add New Hotel</a> --}}

    <!-- Tabel untuk menampilkan daftar hotel -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Hotel Name</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        {{-- <tbody>
            @forelse($hotels as $hotel) <!-- Looping data hotel dari controller -->
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $hotel->name }}</td>
                <td>{{ $hotel->location }}</td>
                <td>
                    <a href="{{ route('admin.hotel.edit', $hotel->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('admin.hotel.destroy', $hotel->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">No Hotels Found</td>
            </tr>
            @endforelse
        </tbody> --}}
    </table>
</div>
@endsection
