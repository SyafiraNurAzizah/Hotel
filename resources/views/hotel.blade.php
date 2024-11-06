@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/hotel.css') }}">
@endpush

@section('content')
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Mau ke mana?</h2>
                        <div class="bt-option">
                            <span>Temukan pengalaman menginap yang sempurna di hotel kami!</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="rooms-section spad">
        <div class="container">
            <div class="row">
                @foreach ($hotels as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="room-item">
                            <img src="{{ asset('/img/hotels/' . $item->foto_hotel) }}" alt="" class="room-image">
                            <div class="ri-text">
                                <h3>{{ $item->nama_cabang }}</h3>
                                <a href="{{ route('rooms', ['location' => strtolower($item->nama_cabang)]) }}"
                                    class="primary-btn">More Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- <div class="col-lg-4 col-md-6">
                    <div class="room-item">
                        <img src="img/room/room-sby.jpg" alt="" class="room-image">
                        <div class="ri-text">
                            <h3>Surabaya</h3>
                            <a href="#" class="primary-btn">More Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="room-item">
                        <img src="img/room/room-bndg.jpg" alt="" class="room-image">
                        <div class="ri-text">
                            <h3>Bandung</h3>
                            <a href="#" class="primary-btn">More Details</a>
                        </div>
                    </div>
                </div>
    
                <div class="col-lg-4 col-md-6">
                    <div class="room-item">
                        <img src="img/room/room-bksi.jpg" alt="" class="room-image">
                        <div class="ri-text">
                            <h3>Bekasi</h3>
                            <a href="#" class="primary-btn">More Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="room-item">
                        <img src="img/room/room-smrg.jpg" alt="" class="room-image">
                        <div class="ri-text">
                            <h3>Semarang</h3>
                            <a href="#" class="primary-btn">More Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="room-item">
                        <img src="img/room/room-bgr.jpg" alt="" class="room-image">
                        <div class="ri-text">
                            <h3>Bogor</h3>
                            <a href="#" class="primary-btn">More Details</a>
                        </div>
                    </div>
                </div>
    
                <div class="col-lg-4 col-md-6">
                    <div class="room-item">
                        <img src="img/room/room-mlng.jpg" alt="" class="room-image">
                        <div class="ri-text">
                            <h3>Malang</h3>
                            <a href="#" class="primary-btn">More Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="room-item">
                        <img src="img/room/room-jgj.jpg" alt="" class="room-image">
                        <div class="ri-text">
                            <h3>Yogyakarta</h3>
                            <a href="#" class="primary-btn">More Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="room-item">
                        <img src="img/room/room-pwt.jpg" alt="" class="room-image">
                        <div class="ri-text">
                            <h3>Purwokerto</h3>
                            <a href="#" class="primary-btn">More Details</a>
                        </div>
                    </div>
                </div> --}}


                {{-- RATING --}}
                <form action="{{ route('ratings.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="tipe_kamar_id" value="{{ $tipeKamar->id }}">

                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label>
                        <select name="rating" id="rating" class="form-control">
                            <option value="1">1 - Sangat Buruk</option>
                            <option value="2">2 - Buruk</option>
                            <option value="3">3 - Cukup</option>
                            <option value="4">4 - Baik</option>
                            <option value="5">5 - Sangat Baik</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="comment" class="form-label">Komentar</label>
                        <textarea name="comment" id="comment" class="form-control" rows="4"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Kirim</button>
                </form>

                <div class="col-lg-2">
                    <div class="show_ratings">
                        @foreach ($tipeKamar->ratings as $rating)
                            <div class="mb-2">
                                <strong>{{ $rating->user->name }}</strong> memberi rating {{ $rating->rating }}/5
                                <p>{{ $rating->comment }}</p>
                                <small>{{ $rating->created_at->format('d M Y, H:i') }}</small>
                            </div>
                            @empty
                            <p>Belum ada komentar dan rating. Jadilah yang pertama!</p>
                        @endforelse
    
                    </div>
                </div>
                



            </div>
        </div>
    </section>
@endsection
