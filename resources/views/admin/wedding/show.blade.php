@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/wedding.css') }}">
@endpush
@section('content')
    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container mt-6">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text m-5">
                        <h2>{{ $weddings->judul }}</h2>
                        <div class="bt-option">
                            <a href="{{ route('admin.wedding.index') }}">Back</a>
                            <span>Tabel Weddings</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="gambar">
                        <img src="{{ asset('/storage/uploads/' . $weddings->gambar) }}" alt="{{ $weddings->judul }}">
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="descrition_right">
                        <p>{{ $weddings->harga }}</p>
                        <p class="mt-3">{{ $weddings->kapasitas }}</p>
                        <a href="{{ route('wedding.edit', $weddings->id) }}"
                            class="btn btn-outline-secondary mb-1 mt-1">Edit</a>

                        <form action="{{ route('wedding.destroy', $weddings->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-other btn-outline-danger mb-1 mt-1"
                                onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="description_left mt-3">
                                <p><strong>{{ $weddings->judul_paket1 }}</strong></p>
                                <p>{{ $weddings->paket1 }}</p>
                                <p><strong>{{ $weddings->judul_paket2 }}</strong></p>
                                <p>{{ $weddings->paket2 }}</p>
                                <p><strong>{{ $weddings->judul_paket3 }}</strong></p>
                                <p>{{ $weddings->paket3 }}</p>
                        
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
