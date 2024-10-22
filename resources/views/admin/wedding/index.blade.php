@extends('layouts.app')

{{-- @push('styles')
    <link rel="stylesheet" href="{{ asset('css/wedding.css') }}">
@endpush --}}

@section('content')
    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text m-5">
                        <h2>Admin Weddings</h2>
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
                <table class="table table-custom">
                    <thead class="thead-custom">
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Paket 1</th>
                            <th>Paket 2</th>
                            <th>Paket 3</th>
                            <th>Gambar</th>
                            <th>Harga</th>
                            <th>Kapasitas</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($weddings as $wedding)
                            <tr>
                                <td>{{ $wedding->judul }}</td>
                                <td>{{ $wedding->judul_paket1 }}</td>
                                <td>{{ $wedding->judul_paket2 }}</td>
                                <td>{{ $wedding->judul_paket3 }}</td>
                                <td><img src="{{ asset($wedding->gambar) }}" alt="{{ $wedding->judul }}"
                                        style="height: 50px; width: 50px;"></td>
                                <td>{{ $wedding->harga }}</td>
                                <td>{{ $wedding->kapasitas }}</td>
                            </tr>
                        @endforeach --}}
                        <tr>
                            <td>1</td>
                            <td>romantic</td>
                            <td>gold</td>
                            <td>platinum</td>
                            <td>silver</td>
                            <td>weddings.jpg</td>
                            <td>75.000</td>
                            <td>200</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Breadcrumb Section End -->
@endsection
