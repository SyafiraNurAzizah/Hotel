@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/wedding.css') }}">
@endpush
@section('content')
    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container mt-6">
            <div class="row">
                @foreach ($weddings as $wedding)
                    <div class="col-lg-12">
                        <div class="breadcrumb-text m-5">
                            <h2>{{ $wedding->judul }}</h2>
                            <div class="bt-option">
                                <a href="{{ route('index') }}">Beranda</a>
                                <span>Data Weddings</span>
                            </div>
                        </div>
                    </div>
                    
                @endforeach
                
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
