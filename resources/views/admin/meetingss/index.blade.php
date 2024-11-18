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

/* Styling Tabel */
.table {
    background-color: #f9f9f9;
    border-collapse: separate;
    border-spacing: 0 10px;
}

.table th {
    background-color: #dfa974;
    color: white;
    font-weight: bold;
    text-align: center;
    padding: 12px;
    border-top: none;
    border-bottom: 2px solid #c87d56;
}

.table td {
    text-align: center;
    padding: 12px;
    vertical-align: middle;
    background-color: white;
    border-top: none;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.05);
}

.table td:first-child, 
.table td:last-child {
    border-radius: 8px;
}

/* Styling Tombol Aksi */
.btn {
    margin: 0 5px;
}

.btn-info, .btn-warning, .btn-danger {
    color: white;
    font-size: 14px;
}

.btn-info {
    background-color: #5bc0de;
    border-color: #5bc0de;
}

.btn-warning {
    background-color: #f0ad4e;
    border-color: #f0ad4e;
}

.btn-danger {
    background-color: #d9534f;
    border-color: #d9534f;
}

/* Styling Ikon dalam tombol */
.btn i {
    margin-right: 5px;
}

/* CSS untuk input pencarian */
.search-container {
    display: flex;
    justify-content: flex-end;
    margin-bottom: 20px;
}

.search-input {
    padding: 8px;
    width: 300px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-left: 10px;
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
    <h2 class="mb-4">Data Booking Meeting</h2>
    <a href="{{ route('admin.meeting.create') }}" class="btn mb-3" style="background-color: #dfa974; color: white">
        <i class="fas fa-plus-circle"></i> Tambah Booking
    </a>

    <!-- Kontainer untuk input pencarian -->
    <div class="search-container">
        <input type="text" id="searchInput" class="search-input" placeholder="Cari Nama...">
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Hotel ID</th>
                <th>Meeting ID</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Waktu Mulai</th>
                <th>Waktu Selesai</th>
                <th>Status</th>
                <th>Status Pembayaran</th>
                {{-- <th>Aksi</th> --}}
            </tr>
        </thead>
        <tbody id="bookingTable">
            @forelse($bookings as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->hotel_id }}</td>
                    <td>{{ $item->meeting_id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->date }}</td>
                    <td>{{ $item->start_time }}</td>
                    <td>{{ $item->end_time }}</td>
                    <td>
                        @if($item->status == 'selesai')
                            <span style="color: green; font-weight: bold;">
                                <i class="fas fa-check-circle"></i> {{ ucwords(str_replace('_', ' ', $item->status)) }}
                            </span>
                        @elseif($item->status == 'belum_selesai')
                            <span style="color: orange; font-weight: bold;">
                                <i class="fas fa-hourglass-half"></i> {{ ucwords(str_replace('_', ' ', $item->status)) }}
                            </span>
                        @elseif($item->status == 'sedang_diproses')
                            <span style="color: blue; font-weight: bold;">
                                <i class="fas fa-spinner"></i> {{ ucwords(str_replace('_', ' ', $item->status)) }}
                            </span>
                        @elseif($item->status == 'dibatalkan')
                            <span style="color: red; font-weight: bold;">
                                <i class="fas fa-times-circle"></i> {{ ucwords(str_replace('_', ' ', $item->status)) }}
                            </span>
                        @else
                            <span>{{ ucwords(str_replace('_', ' ', $item->status)) }}</span>
                        @endif
                    </td>
                    <td>
                        @if($item->status_pembayaran == 'dibayar')
                            <span style="color: green; font-weight: bold;">
                                <i class="fas fa-check-circle"></i> {{ ucwords(str_replace('_', ' ', $item->status_pembayaran)) }}
                            </span>
                        @else
                            <span style="color: red; font-weight: bold;">
                                <i class="fas fa-times-circle"></i> {{ ucwords(str_replace('_', ' ', $item->status_pembayaran)) }}
                            </span>
                        @endif
                    </td>
                    <td>
                        {{-- <a href="{{ route('admin.meeting.show', $item->id) }}" class="btn btn-info" title="Detail">
                            <i class="fas fa-info-circle"></i> Detail
                        </a> --}}
                        {{-- <a href="{{ route('admin.meeting.edit', $booking->id) }}" class="btn btn-warning" title="Edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.meeting.destroy', $booking->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus?');">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form> --}}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="12" style="text-align: center">Tidak ada data booking meeting.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@push('scripts')
<script>
// JavaScript untuk filter pencarian
document.getElementById('searchInput').addEventListener('keyup', function() {
    var input = this.value.toLowerCase();
    var tableRows = document.querySelectorAll('#bookingTable tr');

    tableRows.forEach(function(row) {
        var rowData = row.textContent.toLowerCase();
        if (rowData.includes(input)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
</script>
@endpush
@endsection
