@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin-meeting.css') }}">
@endpush

@section('content')
    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container mt-6">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text m-5">
                        <h2>Admin Meetings</h2>
                        <div class="bt-option">
                            <a href="{{ route('index') }}">Beranda</a>
                            <span>Data Meetings</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <section>
        <div class="container mt-6">
            {{-- <a href="{{ route('wedding.create') }}"
                class="btn btn-outline-secondary w-35 gmail-btn d-flx align-items-center mb-2">
                <i class="icon_phone fs-2 me-2"></i> <!-- fs-2 memperbesar ukuran ikon -->
                Tambah Paket
            </a> --}}


            <table class="table table-custom">
                <thead class="thead-custom">
                    <tr>
                        <th>No</th>
                        <th>Nama Ruang</th>
                        <th>Harga per Jam</th>
                        <th>Jumlah Ruang Tersedia</th>
                        <th>Foto</th>
                        <th>Status</th>
                        <th>Kapasitas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($meetings as $meeting)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $meeting->nama_ruang }}</td>
                            <td>{{ number_format($meeting->harga_per_jam, 2) }}</td>
                            <td>{{ $meeting->jumlah_ruang_tersedia }}</td>
                            <td>
                                {{-- <img src="{{ asset('/storage/uploads/' . $wedding->gambar) }}" alt="{{ $wedding->judul }}"> --}}
                                <img src="{{ asset('storage/' . $meeting->foto) }}" alt="{{ $meeting->nama_ruang }}" width="100">
                            </td>
                            <td>{{ $meeting->status }}</td>
                            <td>{{ $meeting->kapasitas }} guests</td>
                            <td>
                                <a href="{{ route('wedding.show', $meeting->id) }}"
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