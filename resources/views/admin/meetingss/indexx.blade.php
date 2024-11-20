@extends('layouts.app')

@push('styles')
<!-- Tambahkan link ke Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
/* Styling untuk card */
.card {
    margin-bottom: 20px;
}

/* Styling tabel */
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

/* Styling tombol aksi */
.btn {
    margin: 0 5px;
}

.btn-info, .btn-warning, .btn-danger {
    color: white;
    font-size: 14px;
}

/* CSS untuk Tombol Kembali */
.back-button {
    position: fixed;
    top: 90px; /* Sesuaikan posisi vertikal */
    left: 40px; /* Sesuaikan posisi horizontal */
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


    <!-- Tabel Data Booking -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Hotel ID</th>
                <th>Meeting ID</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Status Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="bookingTable">
            @forelse($booking as $item)
                <tr>
                    <td>{{ substr($item->uuid, 0, 5) }}</td>
                    <td>{{ $item->hotel_id == null ? 'N/A' : $item->hotel->nama_cabang }}</td>
                    <td>{{ $item->meeting_id == null ? 'N/A' : $item->meeting->nama_ruang }}</td>
                    <td>{{ $item->date }}</td>
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
                        <a href="{{ route('admin.meetingss.show', $item->id) }}" class="btn btn-info" title="Detail">
                            <i class="fas fa-info-circle"></i> Detail
                        </a>
                        <a href="{{ route('admin.meetingss.edit', $item->id) }}" class="btn btn-warning" title="Edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.meetingss.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus?');">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center">Tidak ada data booking meeting.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
