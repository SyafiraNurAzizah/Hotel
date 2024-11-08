@extends('layouts.app')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text m-5">
                        <h2>Tambah Weddings</h2>
                        <div class="bt-option">
                            <a href="{{ route('index') }}">Beranda</a>
                            <span>Data Weddings</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="room-details-item">
                        <form action="{{ route('wedding.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>  
                            @endif
                            

                            <div class="rd-text">
                                <div class="rd-title">
                                    <h3>Tambah Data Weddings</h3>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">    
                                            <label for="judul">Judul</label>
                                            <input type="text" name="judul" id="judul" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="gambar">Gambar</label>
                                            <input type="file" name="gambar" id="gambar" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="harga">Harga</label>
                                            <input type="text" name="harga" id="harga" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="kapasitas">Kapasitas</label>
                                            <input type="text" name="kapasitas" id="kapasitas" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="judul_paket1">Paket 1</label>
                                            <input type="text" name="judul_paket1" id="judul_paket1" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="paket1">Deskripsi Paket 1</label>
                                            <textarea name="paket1" id="paket1" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="judul_paket2">Paket 2</label>
                                            <input type="text" name="judul_paket2" id="judul_paket2" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="paket2">Deskripsi Paket 2</label>
                                            <textarea name="paket2" id="paket2" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="judul_paket3">Paket 3</label>
                                            <input type="text" name="judul_paket3" id="judul_paket3" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="paket3">Deskripsi Paket 3</label>
                                            <textarea name="paket3" id="paket3" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>


                                    
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection