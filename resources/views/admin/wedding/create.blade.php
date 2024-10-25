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
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection