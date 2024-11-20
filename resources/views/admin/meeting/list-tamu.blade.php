@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/hotel/admin/create.css') }}">
@endpush


@section('content')
<div class="back-button">
    <h3><a href="javascript:history.back()" class="btn btn-back">←</a></h3>
</div>


<h2>Pengunjung Hotel</h2>


<br>


<div class="step">
    <a href="{{ route('admin.meeting.list-tamu') }}">
        <i class="fa-solid fa-users" style="position: relative; top: 80px; left: 210px; color: #222736"></i>
    </a>
    <div class="stepbystep">
        <a href="{{ route('admin.meeting.tamu') }}">
            <i class="fa-solid fa-user" style="position: relative; bottom: 4px; left: 20px;"></i>
        </a>
        <div class="garis" style="position: relative; left: 12px;"></div>
        <a href="{{ route('admin.meeting.reservasi') }}">
            <i class="fa-solid fa-bed" style="padding-right: 60px; position: relative; left: 5px;"></i>
        </a>
    </div>
</div>


<br>
<br>
<br>


        <table class="table table-custom">
            <thead class="thead-custom">
                <tr>
                    <th>Id</th>
                    <th>Nama Lengkap</th>
                    <th>Nomor Identitas</th>
                    <th>Nomor Telepon</th>
                    {{-- <th>Aksi</th> --}}
                </tr>
            </thead>
            <tbody>
                @forelse ($tamu as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
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


<div class="overlay" id="errorKetersediaanKamar">
    <div class="bukti">
        <span class="close" id="closeErrorKetersediaanKamarPopup"></span>
        
        <div id="ketersediaanKamar">
            <div class="circle-1">
                <div class="circle-2">
                    <i class="bi bi-exclamation-circle"></i>
                </div>
            </div>
            <h1>Kamar Tidak Tersedia</h1>
            <p>Mohon maaf, kamar yang Anda pilih tidak tersedia untuk tanggal ini.</p>
        </div>
    </div>
</div>
@endsection



@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush
