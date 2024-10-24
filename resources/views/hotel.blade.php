@extends('layouts.app')

@push('styles')
<style>
.room-image {
    width: 100%;
    height: 250px;
    object-fit: cover;
}

.breadcrumb-section {
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    padding: 150px 0; /* Menambah padding untuk membuat gambar latar lebih besar */
    position: relative;
    z-index: 1;
}

.breadcrumb-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7); /* Membuat overlay lebih gelap dengan opacity 0.7 */
    z-index: -1;
}

.breadcrumb-text h2, .breadcrumb-text p {
    color: white; /* Agar teks terlihat jelas di atas gambar */
    text-align: center; /* Membuat teks berada di tengah */
}

.breadcrumb-text {
    max-width: 800px;
    margin: 0 auto; /* Agar teks berada di tengah kontainer */
}
</style>
@endpush

@section('content')
<div class="app">
    {{-- @include('auth.login')
    @include('auth.register') --}}

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    @include('auth.register')

    <h1>HOTEL</h1>
</div>
@endsection