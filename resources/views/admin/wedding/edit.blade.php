@extends('layouts.app')

@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text m-5">
                    <h2>Edit Weddings</h2>
                    <div class="bt-option">
                        <a href="{{ route('index') }}">Beranda</a>
                        <span>Data Weddings</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('wedding.update', $wedding->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" id="judul" class="form-control" value="{{ $wedding->judul }}">
                    </div>

                    <div class="form-group">
                        <label for="judul_paket1">Paket 1</label>
                        <input type="text" name="judul_paket1" id="judul_paket1" class="form-control" value="{{ $wedding->judul_paket1 }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="paket1">Deskripsi Paket 1</label>
                        <textarea name="paket1" id="paket1" class="form-control">{{ $wedding->paket1 }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="judul_paket2">Paket 2</label>
                        <input type="text" name="judul_paket2" id="judul_paket2" class="form-control" value="{{ $wedding->judul_paket2 }}">
                    </div>

                    <div class="form-group">
                        <label for="paket2">Deskripsi Paket 2</label>
                        <textarea name="paket2" id="paket2" class="form-control">{{ $wedding->paket2 }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="judul_paket3">Paket 3</label>
                        <input type="text" name="judul_paket3" id="judul_paket3" class="form-control" value="{{ $wedding->judul_paket3 }}">
                    </div>

                    <div class="form-group">
                        <label for="paket3">Deskripsi Paket 3</label>
                        <textarea name="paket3" id="paket3" class="form-control">{{ $wedding->paket3 }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input type="file" name="gambar" id="gambar" class="form-control" value="{{ $wedding->gambar }}">
                    </div>                    

                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" name="harga" id="harga" class="form-control" value="{{ $wedding->harga }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="kapasitas">Kapasitas</label>
                        <input type="text" name="kapasitas" id="kapasitas" class="form-control" value="{{ $wedding->kapasitas }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>

                </form>

                


            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</div>@endsection