@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/hotel/admin/create.css') }}">
@endpush


@section('content')
<div class="back-button">
    <h3>
        <a href="javascript:history.back()" class="btn btn-back">
            <i class="bi bi-arrow-left"></i>
        </a>
    </h3>
</div>


<h2>Pengunjung Hotel</h2>


<br>


<div class="step" style="position: relative; bottom: 14px;">
    {{-- <a href="{{ route('admin.hotel.list-tamu') }}">
        <i class="fa-solid fa-users" style="position: relative; top: 80px; left: 210px; color: #222736"></i>
    </a> --}}
    <div class="search-container">
        <input type="text" id="searchInput" class="search-input" placeholder="Cari Pengunjung...">
        <i class="fa-solid fa-magnifying-glass search-icon" style="position: relative; top: 82px; right: 35px; color: #222736;"></i>
    </div>
    <div class="stepbystep">
        <a href="{{ route('admin.hotel.tamu') }}">
            <i class="fa-solid fa-user" style="position: relative; bottom: 4px; left: 20px;"></i>
        </a>
        <div class="garis" style="position: relative; left: 12px;"></div>
        <a href="{{ route('admin.hotel.create') }}">
            <i class="fa-solid fa-bed" style="padding-right: 60px; position: relative; left: 5px;"></i>
        </a>
    </div>
</div>


<br>
<br>
<br>


    <table class="table table-custom" style="position: relative; bottom: 15px;">
        <thead class="thead-custom">
            <tr>
                <th>Id</th>
                <th>Nama Lengkap</th>
                <th>Nomor Identitas</th>
                <th>Nomor Telepon</th>
                {{-- <th>Aksi</th> --}}
            </tr>
        </thead>
        <tbody id="tamuTable">
            @forelse ($tamu as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->no_identitas }}</td>
                    <td>{{ $item->no_telp }}</td>
                        {{-- <td>
                            <a href="{{ route('admin.hotel.edit.tamu', $item->id) }}" class="btn btn-edit">Edit</a>
                            <form action="{{ route('admin.hotel.destroy.tamu', $item->id) }}" method="POST" style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete">Hapus</button>
                            </form>
                        </td> --}}
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center">Tidak ada data tamu</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection



@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // JavaScript untuk filter pencarian
    document.getElementById('searchInput').addEventListener('keyup', function() {
        var input = this.value.toLowerCase();
        var tableRows = document.querySelectorAll('#tamuTable tr');
    
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
