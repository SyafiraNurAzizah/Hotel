<!-- resources/views/admin/hotel/index.blade.php -->
@extends('layouts.app')

@section('content')
<br><br><br><br><br>
<div class="container">
    <h2 class="mb-4">Reservations Table</h2>
    <a href="{{ route('admin.hotel.create') }}" class="btn mb-3" style="background-color: #dfa974; color: white">+ Tambah Hotel</a>

    <table class="table table-bordered">
        <thead>
            <tr style="background-color: #dfa974">
                <th>User ID</th>
                <th>Hotel ID</th>
                <th>Status</th>
                <th>Status Pembayaran</th>
                <th>Jumlah Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hotels as $hotel)
                @if($hotel->bookings) <!-- Check if there are any bookings -->
                    @foreach($hotel->bookings as $item)
                        <tr>
                            <td>{{ $item->user->firstname ?? 'N/A' }}</td>
                            <td>{{ $hotel->nama_cabang ?? 'N/A' }}</td>
        
                            <td>
                                @if($item->status == 'selesai')
                                    <span style="color: green; font-weight: bold;">{{ ucwords(str_replace('_', ' ', $item->status)) }}</span>
                                @elseif($item->status == 'belum_selesai')
                                    <span style="color: orange; font-weight: bold;">{{ ucwords(str_replace('_', ' ', $item->status)) }}</span>
                                @elseif($item->status == 'dibatalkan')
                                    <span style="color: red; font-weight: bold;">{{ ucwords(str_replace('_', ' ', $item->status)) }}</span>
                                @else
                                    <span>{{ ucwords(str_replace('_', ' ', $item->status)) }}</span>
                                @endif
                            </td>
        
                            <td>
                                @if($item->status_pembayaran == 'dibayar')
                                    <span style="color: green; font-weight: bold;">{{ ucwords(str_replace('_', ' ', $item->status_pembayaran)) }}</span>
                                @elseif($item->status_pembayaran == 'belum_dibayar')
                                    <span style="color: red; font-weight: bold;">{{ ucwords(str_replace('_', ' ', $item->status_pembayaran)) }}</span>
                                @else
                                    <span>{{ ucwords(str_replace('_', ' ', $item->status_pembayaran)) }}</span>
                                @endif
                            </td>
        
                            <td>Rp{{ number_format($item->jumlah_harga, 2, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('admin.hotel.show', $item->id) }}" class="btn btn-info" title="Detail">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                <a href="{{ route('admin.hotel.edit', $item->id) }}" class="btn btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.hotel.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus?');">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            @endforeach
        </tbody>
        
    </table>
    <form action="" id ="form-delete" method="POST" style="d:inline;">
        @csrf
        @method('DELETE')
    </form>
</div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script type="text/javascript">
        function handleDelete(url) {
           swal({
               title: "Apakah Anda yakin ingin menghapus data ini?",
               text: "Data yang dihapus tidak dapat dikembalikan!",
               icon: "warning",
               buttons: true,
               dangerMode: true,
               
           }).then((wellDelete) => {
               if (wellDelete) {
                   $('#form-delete').attr('action', url);
                   $('#form-delete').submit();
               }  
           })
        }
    </script>

@endpush
