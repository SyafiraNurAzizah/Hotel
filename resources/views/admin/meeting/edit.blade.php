@extends('admin.layouts.app')

@section('content')
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity">
                                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                                </svg></div>
                            Edit Ruangan Meeting
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container-xl px-4 mt-n10">
        <div class="row card h-100 p-3">
            <div class="container mt-6">
                <form action="{{ route('admin.meeting.update', $meeting->id) }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="hotel_id">Hotel</label>
                            <select name="hotel_id" id="hotel_id" class="form-control">
                                <option value="">Pilih Hotel</option>
                                @foreach ($hotels as $ht)
                                    <option value="{{ $ht->id }}" {{ $ht->id == $meeting->hotel_id ? 'selected' : '' }}>{{ $ht->nama_cabang }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="nama_ruang">Nama Ruang</label>
                            <input type="text" class="form-control" id="nama_ruang" name="nama_ruang" value="{{ $meeting->nama_ruang }}" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="harga_per_jam">Harga per Jam</label>
                            <input type="number" class="form-control" id="harga_per_jam" name="harga_per_jam" value="{{ $meeting->harga_per_jam }}" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="jumlah_ruang_tersedia">Jumlah Ruang Tersedia</label>
                            <input type="number" class="form-control" id="jumlah_ruang_tersedia" name="jumlah_ruang_tersedia" value="{{ $meeting->jumlah_ruang_tersedia }}" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" id="status">
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Non Aktif</option>
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="kapasitas">Kapasitas</label>
                            <input type="number" class="form-control" id="kapasitas" name="kapasitas" value="{{ $meeting->kapasitas }}" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="ukuran_ruangan">Ukuran Ruangan</label>
                            <input type="number" class="form-control" id="ukuran_ruang" value="{{ $meeting->ukuran_ruang }}" name="ukuran_ruangan"
                                required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="fasilitas">Fasilitas Ruangan</label>
                            <textarea name="fasilitas" id="fasilitas" class="form-control" rows="3">{{ $meeting->fasilitas }}</textarea>
                        </div>
                        <div class="form-group mt-3">
                            <label for="foto">Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto">
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="button" class="btn btn-secondary">Kembali</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
>>>>>>> 3585dbecfb44f5b81067295e2cd3bd961e375dc1
@endsection
