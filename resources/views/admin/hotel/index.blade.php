@extends('layouts.app')

@push('styles')
<!-- Tambahkan link ke Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
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

/* Styling Tabel */
.table {
    background-color: #f9f9f9;
    border-collapse: separate;
    border-spacing: 0 10px; /* Jarak antar baris */
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
</style>
@endpush

@section('content')
<br><br><br><br><br>
<div class="back-button">
    <h3><a href="javascript:history.back()" class="btn btn-back"><i class="fas fa-arrow-left"></i></a></h3>
</div>
<br>  
<div class="container">
    <h2 class="mb-4">Cabang <strong>{{ $city }}</strong></h2>
    <a href="{{ route('admin.hotel.list-tamu') }}" class="btn mb-3" style="background-color: #dfa974; color: white">
        <i class="fas fa-plus-circle"></i> Tambah Hotel
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th><i class="fas fa-user"></i> User ID</th>
                <th><i class="fas fa-hotel"></i> Hotel ID</th>
                <th><i class="fas fa-tasks"></i> Status</th>
                <th><i class="fas fa-money-check-alt"></i> Status Pembayaran</th>
                <th><i class="fas fa-dollar-sign"></i> Jumlah Harga</th>
                <th><i class="fas fa-cog"></i> Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookinghotel as $item)
                <tr>
                    <td>{{ $item->user->firstname ?? 'N/A' }}</td>
                    <td>{{ $item->hotel->nama_cabang ?? 'N/A' }}</td>
                    <td>
                        @if($item->status == 'selesai')
                            <span style="color: green; font-weight: bold;">
                                <i class="fas fa-check-circle"></i> {{ ucwords(str_replace('_', ' ', $item->status)) }}
                            </span>
                        @elseif($item->status == 'belum_selesai')
                            <span style="color: orange; font-weight: bold;">
                                <i class="fas fa-hourglass-half"></i> {{ ucwords(str_replace('_', ' ', $item->status)) }}
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
                        @elseif($item->status_pembayaran == 'belum_dibayar')
                            <span style="color: red; font-weight: bold;">
                                <i class="fas fa-times-circle"></i> {{ ucwords(str_replace('_', ' ', $item->status_pembayaran)) }}
                            </span>
                        @else
                            <span>{{ ucwords(str_replace('_', ' ', $item->status_pembayaran)) }}</span>
                        @endif
                    </td>
                    <td>Rp{{ number_format($item->jumlah_harga, 2) }}</td>
                    <td>
                        <a href="{{ route('admin.hotel.show', $item->id) }}" class="btn btn-info" title="Detail">
                            <i class="fas fa-info-circle"></i> Detail
                        </a>
                        <a href="{{ route('admin.hotel.edit', $item->id) }}" class="btn btn-warning" title="Edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.hotel.destroy', $item->id) }}" method="POST" style="display:inline;">
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
                    <td colspan="6" style="text-align: center">Tidak ada data booking di Hotel {{ $city }}</td>
                </tr>
            @endforelse
        </tbody>
        
    </table>
</div>
@endsection
