@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/wedding.css') }}">
    <!-- Tambahkan link ke Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* Breadcrumb Styling */
        .breadcrumb-section {
            background: url('/images/breadcrumb-bg.jpg') center center/cover no-repeat;
            padding: 80px 0;
            position: relative;
        }

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

        /* Table Styling */
        .table-custom {
            background-color: #f9f9f9;
            border-collapse: separate;
            border-spacing: 0 10px;
            width: 100%;
            margin-top: 20px;
        }

        .table-custom th, .table-custom td {
            text-align: center;
            padding: 15px;
            vertical-align: middle;
        }

        .thead-custom th {
            background-color: #dfa974;
            color: white;
            font-weight: bold;
            font-size: 16px;
            text-transform: uppercase;
        }

        .table-custom tbody tr {
            background-color: #fff;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.05);
        }

        .table-custom tbody tr:hover {
            background-color: #f0f0f0;
        }

        /* No data styling */
        .no-data {
            text-align: center;
            font-size: 18px;
            color: #888;
            font-style: italic;
        }

        /* Icon styling */
        .table-custom .fa {
            margin-right: 5px;
        }

        /* Container margins */
        .container.mt-6 {
            margin-top: 50px;
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
                        <h2><i class="fas fa-address-book"></i> Admin Contact</h2>
                        <div class="bt-option">
                            <a href="{{ route('index') }}"><i class="fas fa-home"></i> Beranda</a>
                            <span><i class="fas fa-envelope"></i> Data Contact</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Data Contact Section Begin -->
    <section>
        <div class="container">
            <table class="table table-custom">
                <thead class="thead-custom">
                    <tr>
                        <th><i class="fas fa-list-ol"></i> No</th>
                        <th><i class="fas fa-user"></i> Nama</th>
                        <th><i class="fas fa-envelope"></i> Email</th>
                        <th><i class="fas fa-comment-dots"></i> Pesan</th>
                        <th><i class="fas fa-calendar-alt"></i> Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($contact as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->Nama }}</td>
                            <td>{{ $item->Email }}</td>
                            <td>{{ $item->Pesan }}</td>
                            <td>{{ $item->created_at->format('d-m-Y, H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="no-data">No data available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
    <!-- Data Contact Section End -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
