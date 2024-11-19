@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/wedding.css') }}">

    <style>
        .breadcrumb-text {
            text-align: center;
            color: white;
        }

        .breadcrumb-text h2 {
            font-size: 40px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .bt-option a {
            color: #dfa974;
            font-weight: bold;
        }

        .bt-option span {
            color: #fff;
        }

        .thead-custom th {
            background-color: #dfa974;
            color: white;
            font-weight: bold;
            font-size: 16px;
            text-transform: uppercase;
        }
    </style>
@endpush

@section('content')
    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2><i class="fas fa-address-book"></i> Wedding</h2>
                        <div class="bt-option">
                            <a href="{{ route('index') }}"><i class="fas fa-home"></i> Beranda</a>
                            <span><i class="fas fa-envelope"></i> Data Wedding</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <section>
        <div class="container mt-6">
            <a href="{{ route('wedding.create') }}"
                class="btn btn-outline-secondary w-35 gmail-btn d-flx align-items-center mb-2">
                <i class="icon_phone fs-2 me-2"></i> <!-- fs-2 memperbesar ukuran ikon -->
                Tambah Paket
            </a>


            <table class="table table-custom">
                <thead class="thead-custom">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th><i class="fas fa-tasks"></i> Paket 1</th>
                        <th><i class="fas fa-tasks"></i> Paket 2</th>
                        <th><i class="fas fa-tasks"></i> Paket 3</th>
                        <th>Gambar</th>
                        <th>Harga</th>
                        <th>Kapasitas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($weddings as $wedding)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $wedding->judul }}</td>
                            <td>{{ $wedding->judul_paket1 }}</td>
                            <td>{{ $wedding->judul_paket2 }}</td>
                            <td>{{ $wedding->judul_paket3 }}</td>
                            <td><img src="{{ asset('/storage/uploads/' . $wedding->gambar) }}" alt="{{ $wedding->judul }}">
                            </td>
                            <td>
                                {{ is_numeric($wedding->harga) ? number_format((float) $wedding->harga, 2) : $wedding->harga }}
                            </td>
                            <td>{{ $wedding->kapasitas }} guests</td>
                            <td>
                                <a href="{{ route('wedding.show', $wedding->id) }}"
                                    class="fa fa-eye btn btn-outline-secondary"></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="no-data">No data available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <!-- Breadcrumb Section End -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
