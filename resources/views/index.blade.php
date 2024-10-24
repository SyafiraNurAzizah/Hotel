@extends('layouts.app')

@section('content')
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="hero-text">
                        <h1>Berlian Hotel</h1>
                        <p>
                            Dengan fasilitas modern, layanan berkelas, dan suasana yang elegan.
                             Setiap kamar dirancang dengan sentuhan yang hangat dan mewah untuk memastikan kenyamanan anda selama menginap.</p>

                        <a href="#" class="primary-btn">Discover Now</a>
                    </div>
                </div>
                {{-- <div class="col-xl-4 col-lg-5 offset-xl-2 offset-lg-1">
                    @if(Auth::check() && Auth::user()->isUser())
                    <div class="booking-form">
                        <h3>Booking Your Hotel</h3>
                        <form action="#">
                            <div class="check-date">
                                <label for="date-in">Check In:</label>
                                <input type="text" class="date-input" id="date-in">
                                <i class="icon_calendar"></i>
                            </div>
                            <div class="check-date">
                                <label for="date-out">Check Out:</label>
                                <input type="text" class="date-input" id="date-out">
                                <i class="icon_calendar"></i>
                            </div>
                            <div class="select-option">
                                <label for="guest">Guests:</label>
                                <select id="guest">
                                    <option value="">2 Adults</option>
                                    <option value="">3 Adults</option>
                                </select>
                            </div>
                            <div class="select-option">
                                <label for="room">Room:</label>
                                <select id="room">
                                    <option value="">1 Room</option>
                                    <option value="">2 Room</option>
                                </select>
                            </div>
                            <button type="submit">Check Availability</button>
                        </form>
                    </div>
                    @endif
                </div> --}}
            </div>
        </div>
        <div class="hero-slider owl-carousel">
    
            <div class="hs-item set-bg" data-setbg="img/hero/1.jpg"></div>
            <div class="hs-item set-bg" data-setbg="img/hero/2.jpg"></div>
            <div class="hs-item set-bg" data-setbg="img/hero/4.jpg"></div>
        </div>
        {{-- <div class="dark-layer-hero"></div> --}}
    </section>
    <!-- Hero Section End -->

    <!-- About Us Section Begin -->
    <section class="aboutus-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-text">
                        <div class="section-title">
                            <span>About Us</span>
                            <h2>Berlian<br/> A Fantastic Hotel</h2>
                        </div>
                        <p class="f-para">Welcome to a world of sophistication and elegance where every detail is crafted to perfection.
                             Our luxury hotel offers an unparalleled experience, blending modern comfort with timeless charm.</p>
                        <p class="s-para">Selamat datang di dunia yang penuh kecanggihan dan keanggunan di mana setiap detail dibuat dengan sempurna. Hotel mewah kami menawarkan pengalaman tak
                             tertandingi, memadukan kenyamanan modern dengan pesona abadi.</p>
                        
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-pic">
                        <div class="row">
                            <div class="col-sm-6">
                                <img src="img/about/abtt-1.jpg" alt="">
                            </div>
                            <div class="col-sm-6">
                                <img src="img/about/abtt-2.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Us Section End -->

    <!-- Services Section End -->
    <section class="services-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>What We Provide</span>
                        <h2>Discover Our Facilities</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="fa-solid fa-dumbbell fa-2x"></i>
                        <h4>GYM</h4>
                        <p>Dengan peralatan canggih, area latihan yang luas,
                             dan pemandangan yang menakjubkan</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="fa-solid fa-utensils fa-2x"></i>
                        <h4>Restaurant</h4>
                        <p>Bersantaplah di tempat yang menakjubkan yang
                             dihiasi dengan dekorasi yang canggih dan 
                             pencahayaan yang nyaman. </p>
                    </div>
                </div>
            
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="fa-solid fa-rocket fa-2x"></i>
                        <h4>Kids Zone</h4>
                        <p>Ajak buah hati Anda dan temukan kegembiraan bermain di taman bermain kami. 
                            Di sini, tawa dan kebahagiaan.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="fa-solid fa-water-ladder  fa-2x"></i>
                        <h4>Swimming pool</h4>
                        <p>Buat diri anda segar kembali</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="fa-solid fa-square-parking fa-2x"></i>
                        <h4>Parking</h4>
                        <p>Spacious Parking Area. Dengan kemanan yang sudah teruji</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="service-item">
                        <i class="fa-solid fa-clock fa-2x"></i>
                        <h4>Receptionist</h4>
                        <p>Pelayanan 24 jam menambahkan kepuasan pengunjung.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services Section End -->

    <!-- Home Room Section Begin -->
    {{-- <section class="hp-room-section">
        <div class="container-fluid">
            <div class="hp-room-items">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="hp-room-item set-bg" data-setbg="img/room/room-c1.jpg">
                            <div class="dark-layer"></div>
                            <div class="hr-text">
                                <h3>Deluxe Room</h3>
                                <h2>RP 1.500.000<span>/Night</span></h2>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="r-o">Size :</td>
                                            <td>30 m²</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Capacity :</td>
                                            <td>Max person 4</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Bed :</td>
                                            <td>King Beds</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Services :</td>
                                            <td>Wifi, Television, Bathroom</td>
                                        </tr>
                                    </tbody>
                                </table> --}}

                                <section class="hp-room-section">
                                    <div class="container-fluid">
                                        <div class="hp-room-items">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-6">
                                                    <div class="hp-room-item set-bg" data-setbg="img/room/room-f1.jpg">
                                                        <div class="dark-layer"></div>
                                                        <div class="hr-text">
                                                            <h3>GYM Room</h3>
                                                            <h2>open 24 hours<span> free</span></h2>
                                                            <table>
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="r-o">Size :</td>
                                                                        <td>30 m²</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="r-o">Provide :</td>
                                                                        <td>Dumbbell..</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="hp-room-item set-bg" data-setbg="img/room/room-f3.jpg">
                            <div class="dark-layer"></div>
                            <div class="hr-text">
                                <h3>Restaurant</h3>
                                <h2>open 24 hours<span></span></h2>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="r-o">Size :</td>
                                            <td>35 m²</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Best Chefs :</td>
                                            <td>All Corners</td>
                                        </tr>
                                        
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="hp-room-item set-bg" data-setbg="img/room/room-f4.jpg">
                            <div class="dark-layer"></div>
                            <div class="hr-text">
                                <h3>Kids Zone</h3>
                                <h2>open 24 hours<span> Free</span></h2>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="r-o">Size :</td>
                                            <td>20 m²</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">security :</td>
                                            <td>CCTV</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="hp-room-item set-bg" data-setbg="img/room/room-f5.jpg">
                            <div class="dark-layer"></div>
                            <div class="hr-text">
                                <h3> Pool</h3>
                                <h2>open 24 hours<span></span></h2>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="r-o">Location :</td>
                                            <td>fl 1</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Water:</td>
                                            <td>Warm..</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Home Room Section End -->

    <!-- Testimonial Section Begin -->
    <section class="testimonial-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Testimoni</span>
                        <h2>Apa Yang Dikatakan Pengunjung?</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="testimonial-slider owl-carousel">
                        <div class="ts-item">
                            <p>Setelah proyek konstruksi memakan waktu lebih lama dari yang diharapkan, saya, istri, putri saya, dan saya
                                membutuhkan tempat untuk menginap selama beberapa malam. Sebagai penduduk Chicago, kami tahu banyak tentang kami
                                kota, lingkungan sekitar, dan jenis pilihan Class rooms yang tersedia dan sangat kami sukai
                                 harga yang sepandan dengan fasilitas yang disediakan.</p>
                            <div class="ti-author">
                                <h5> - Mr. Gemini Norawit</h5>
                            </div>
                            <img src="img/testimonial-logo.png" alt="">
                        </div>
                        <div class="ts-item">
                            <p>Pengalaman menginap di Hotel Berlian benar-benar luar biasa! Kamar yang nyaman, 
                                pelayanan yang ramah, dan lokasi yang strategis membuat perjalanan saya semakin menyenangkan. Saya pasti akan kembali</p>
                            <div class="ti-author">
                          <h5> - Roronoa Zoro</h5>
                            </div>
                            <img src="img/testimonial-logo.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial Section End -->

    <!-- Blog Section Begin -->
    <section class="blog-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Hotel News</span>
                        <h2>Our Blog & Event</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="blog-item set-bg" data-setbg="img/blog/evn-01.jpg">
                        <div class="dark-layer-blog"></div>
                        <div class="bi-text">
                            <span class="b-tag">Wedding</span>
                            <h4><a href="#">wedding of Acep & Sity</a></h4>
                            <div class="b-time"><i class="icon_clock_alt"></i> 15th April, 2020</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-item set-bg" data-setbg="img/blog/evn-2.jpg">
                        <div class="dark-layer-blog"></div>
                        <div class="bi-text">
                            <span class="b-tag">Meeting</span>
                            <h4><a href="#">SANGHAI COMPANY</a></h4>
                            <div class="b-time"><i class="icon_clock_alt"></i> 15th June, 2019</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-item set-bg" data-setbg="img/blog/evn-3.jpg">
                        <div class="dark-layer-blog"></div>
                        <div class="bi-text">
                            <span class="b-tag">Birthday</span>
                            <h4><a href="#">Birthday of Sity</a></h4>
                            <div class="b-time"><i class="icon_clock_alt"></i> 21th April, 2018</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="blog-item small-size set-bg" data-setbg="img/blog/evn-4.jpg">
                        <div class="dark-layer-blog"></div>
                        <div class="bi-text">
                            <span class="b-tag">Event</span>
                            <h4><a href="#">Big Agency Meeting</a></h4>
                            <div class="b-time"><i class="icon_clock_alt"></i> 08th April, 2024</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-item small-size set-bg" data-setbg="img/blog/evn-5.jpg">
                        <div class="dark-layer-blog"></div>
                        <div class="bi-text">
                            <span class="b-tag">Travel</span>
                            <h4><a href="#">Traveling To Barcelona</a></h4>
                            <div class="b-time"><i class="icon_clock_alt"></i> 12th April, 2019</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.set-bg').each(function() {
                var bg = $(this).data('setbg');
                $(this).css('background-image', 'url(' + bg + ')');
            });
        });
    </script>    
@endpush