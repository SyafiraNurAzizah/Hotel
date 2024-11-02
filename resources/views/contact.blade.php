@extends('layouts.app')
<style>
    /* Atur padding dan jarak antar elemen */
    .container.my-5 {
        padding: 20px;
    }

    /* Styling untuk card */
    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
    }

    /* Header Form */
    h2.text-center {
        color: #333;
        font-weight: 600;
    }

    /* Styling untuk input dan select */
    .form-control {
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 10px;
        font-size: 16px;
    }

    .form-control:focus {
        border-color: #dfa974;
        box-shadow: 0px 0px 5px rgba(223, 169, 116, 0.5);
    }

    /* Styling untuk tombol submit */
    .btn-lg {
        background-color: #dfa974;
        color: white;
        font-weight: bold;
        padding: 12px;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    .btn-lg:hover {
        background-color: #b87d50;
    }

    /* Styling untuk alert sukses dan error */
    .alert {
        border-radius: 8px;
    }

    .alert-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
    }

    .alert-danger {
        background-color: #f8d7da;
        border-color: #f5c6cb;
        color: #721c24;
    }

    /* Media query untuk responsif */
    @media (max-width: 576px) {
        .form-control, .btn-lg {
            font-size: 14px;
        }

        .card-body {
            padding: 20px;
        }
    }
    .form-control, .form-control-lg {
        height: 50px; /* Sesuaikan dengan tinggi yang Anda inginkan */
    }
</style>

@section('content')
<br><br><br>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-2">
                <div class="card-body p-5">
                    <h2 class="mb-4 text-center">Beri Kami Masukan</h2>

                    <!-- Tampilkan Pesan Sukses -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Tampilkan Error Validasi -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('contact.store') }}">
                        @csrf

                        <div class="form-group mb-3" style="width: 100%">
                            <label for="hotel_id" class="form-label">Pilih Hotel</label>
                            <select name="hotel_id" id="hotel_id" class="form-control form-control-lg" required>
                                <option value="" disabled selected>Pilih hotel</option>
                                @foreach($hotels as $hotel)
                                    <option value="{{ $hotel->id }}" {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>
                                        {{ $hotel->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        

                        <!-- Nama Pengguna -->
                        <div class="form-group mb-3">
                            <label for="username" class="form-label">Nama Pengguna</label>
                            <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan nama Anda" value="{{ old('username') }}" required>
                        </div>

                        <!-- Email -->
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan email Anda" value="{{ old('email') }}" required>
                        </div>

                        <!-- Isi Pesan -->
                        <div class="form-group mb-4">
                            <label for="isi_pesan" class="form-label">Pesan</label>
                            <textarea id="isi_pesan" name="isi_pesan" class="form-control" rows="5" placeholder="Tuliskan pesan Anda" required>{{ old('isi_pesan') }}</textarea>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-lg" style="width: 100%; background-color: #dfa974; color: white">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> 
</div>
@endsection
