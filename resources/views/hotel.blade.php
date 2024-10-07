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
   
    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section" style="background-image: url('{{ asset('img/meetings/meeting-bg.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Our Rooms</h2>
                        <div class="bt-option">
                            <a href="./home.html">Home</a>
                            <span>Rooms</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->
    <br><br><br>
    <!-- Rooms Section Begin -->
    <section class="rooms-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="room-item">
                        <img src="img/room/room-jkt.jpg" alt="" class="room-image">
                        <div class="ri-text">
                            <h3>Jakarta</h3>
                            <a href="{{ route('detail1') }}" class="primary-btn">More Details</a>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
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
                </div>
            </div>
        </div>
    </section>
    
    <!-- Rooms Section End -->

</div>
@endsection