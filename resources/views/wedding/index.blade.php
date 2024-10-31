@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/wedding.css') }}">
@endpush
@section('content')
    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text m-5">
                        <h2>Wedding Rooms</h2>
                        <div class="bt-option">
                            <a href="{{ route('index') }}">Beranda</a>
                            <span>Rooms</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Rooms Section Begin -->
    <section class="rooms-section spad">
        <div class="container">
            <div class="row">
                @foreach ($weddings as $wedding)
                    <div class="col-lg-4 col-md-6 coba">
                        <div class="room-item">
                            <img src="{{ asset('/storage/uploads/' . $wedding->gambar) }}" alt="{{ $wedding->judul }}">

                            <div class="ri-text">
                                <h4>{{ $wedding->judul }}</h4>
                                <h3>
                                    IDR
                                    {{ is_numeric($wedding->harga) ? number_format((float) $wedding->harga, 2) : $wedding->harga }}
                                    <br>
                                    <span class="text-muted">nett min. {{ $wedding->kapasitas }} guests</span>
                                </h3>


                                <div class="btn-contact d-flex justify-content-between align-items-center my-3">
                                    <a href="https://wa.me/+6285701481636?text=Halo%2C%20saya%20tertarik%20dengan%20paket%20wedding%20Anda."
                                        target="_blank"
                                        class="btn btn-outline-secondary w-35 contact-btn d-flex align-items-center">
                                        <i class="icon_phone" style="margin-right: 8px;"></i> Contact
                                    </a>
                                    <a href="mailto:istiqomahkhoerunnisa@gmail.com?subject=Informasi%20Paket%20Wedding&body=Halo,%20saya%20ingin%20tahu%20lebih%20lanjut%20tentang%20paket%20wedding%20Anda."
                                        class="btn btn-outline-secondary w-35 gmail-btn d-flx align-items-center">
                                        <i class="icon_mail_alt" style="margin-right: 8px;"></i> Gmail </a>
                                    <a href="{{ route('admin.wedding.index') }}">Admin</a>

                                </div>


                                <button class="primary-btn" style="border: none; background: none;" data-bs-toggle="modal"
                                    data-bs-target="#weddingModal-{{ $wedding->id }}">
                                    More Details
                                </button>
                            </div>
                        </div>
                    </div>


                    <!-- Modal -->
                    <div class="modal fade" id="weddingModal-{{ $wedding->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content" style="width: 100%;">
                                <div class="modal-body">
                                    <button type="button" class="icon_close ms-auto"
                                        style="border: none; background: none;" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                    <img src="{{ asset('/storage/uploads/' . $wedding->gambar) }}" class="card-img-top"
                                        alt="{{ $wedding->judul }}"
                                        style="height: 400px; width: 2000px; object-fit: cover;">


                                    <div class="deskripsi">
                                        <h4 class="card-text">Starting From IDR
                                            {{ is_numeric($wedding->harga) ? number_format((float) $wedding->harga, 2) : $wedding->harga }}
                                            <span class="text-muted">nett min. {{ $wedding->kapasitas }} guests</span>
                                        </h4>
                                        <br>
                                        <div class="btn-contact">
                                            <div class="btn-contact d-flex justify-content-end gap-3 my-3">
                                                <a href="https://wa.me/+6285701481636?text=Halo%2C%20saya%20tertarik%20dengan%20paket%20wedding%20Anda."
                                                    target="_blank"
                                                    class="btn btn-outline-secondary w-35 contact-btn d-flex align-items-center">
                                                    <i class="icon_phone" style="margin-right: 8px;"></i> Contact
                                                </a>
                                                <a href="mailto:istiqomahkhoerunnisa@gmail.com?subject=Informasi%20Paket%20Wedding&body=Halo,%20saya%20ingin%20tahu%20lebih%20lanjut%20tentang%20paket%20wedding%20Anda."
                                                    class="btn btn-outline-secondary w-35 gmail-btn d-flx align-items-center">
                                                    <i class="icon_mail_alt" style="margin-right: 8px;"></i> Gmail </a>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Isi modal detail wedding -->
                                    <div class="row mb-3" style="margin-left: 15px;">
                                        <div class="card mb-4 col-lg-4 col-md-6" style="border: none;">
                                            <div class="card1">
                                                <h6 class="card-text" style="font-weight: bold;">
                                                    {{ $wedding->judul_paket1 }}</h6>
                                                <ul>
                                                    @foreach (explode("\n", $wedding->paket1) as $item)
                                                        <li>{{ $item }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card mb-4 col-lg-4 col-md-6" style="border: none;">
                                            <div class="card2">
                                                <h6 class="card-text" style="font-weight: bold;">
                                                    {{ $wedding->judul_paket2 }}</h6>
                                                <ul>
                                                    @foreach (explode("\n", $wedding->paket2) as $item)
                                                        <li>{{ $item }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card mb-4 col-lg-4 col-md-6" style="border: none;">
                                            <div class="card3">
                                                <h6 class="card-text" style="font-weight: bold;">
                                                    {{ $wedding->judul_paket3 }}</h6>
                                                <ul>
                                                    @foreach (explode("\n", $wedding->paket3) as $item)
                                                        <li>{{ $item }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                {{-- <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    {{-- end modal --}}
                @endforeach
            </div>
        </div>
    </section>
    <!-- Rooms Section End -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
