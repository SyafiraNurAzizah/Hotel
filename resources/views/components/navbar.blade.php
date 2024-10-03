<header class="header-section">
    {{-- <div class="top-nav">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="tn-left">
                        <li><i class="fa fa-phone"></i> (12) 345 67890</li>
                        <li><i class="fa fa-envelope"></i> info.colorlib@gmail.com</li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <div class="tn-right">
                        <div class="top-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-tripadvisor"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </div>
                        <a href="#" class="bk-btn">Booking Now</a>
                        <div class="language-option">
                            <img src="img/flag.jpg" alt="">
                            <span>EN <i class="fa fa-angle-down"></i></span>
                            <div class="flag-dropdown">
                                <ul>
                                    <li><a href="#">Zi</a></li>
                                    <li><a href="#">Fr</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="menu-item">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="logo">
                        <a href="./index.html">
                            <img src="img/logo.png" alt="Logo" class="logo-img">
                        </a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="nav-menu">
                        <nav class="mainmenu">
                            <ul>
                                <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ route('index') }}">Beranda</a></li>
                                <li class="{{ Request::is('hotel') ? 'active' : '' }}"><a href="{{ route('hotel') }}">Hotel</a></li>
                                <li class="{{ Request::is('about-us') ? 'active' : '' }}"><a href="./about-us.html">Meetings</a></li>
                                <li class="{{ Request::is('weddings') ? 'active' : '' }}"><a href="{{ route('weddings') }}">Weddings</a></li>
                                <li class="{{ Request::is('contact') ? 'active' : '' }}"><a href="./contact.html">Contact</a></li>
                            </ul>
                        </nav>                        
                        <div class="nav-right search-switch">
                            <i class="icon_search"></i>
                        </div>
                        <div class="nav-right login-button">
                            @if (Auth::check())
                                <!-- Show Logout Option in Navbar -->
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                                <a href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i>
                                </a>
                            @else
                                <!-- Show Login Button -->
                                <a href="#" id="openLoginPopup"><i class="fa fa-user"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

@push('scripts')
    <script>
        // Saat halaman digulir
        window.addEventListener('scroll', function() {
            const menu = document.querySelector('.menu-item');
            const currentPage = window.location.pathname;
            const bgColor = window.getComputedStyle(document.body).backgroundColor;

            // Jika halaman digulir lebih dari 50px, tambahkan kelas 'scrolled'
            if (window.scrollY > 50) {
                menu.classList.add('scrolled');
            } else {
                menu.classList.remove('scrolled');
            }

            // Jika latar belakang adalah putih dan bukan halaman index, tambahkan kelas 'visible-on-white'
            if (bgColor === 'rgb(255, 255, 255)' || bgColor === '#ffffff') {
                if (currentPage !== '/index' && currentPage !== '/') {
                    menu.classList.add('visible-on-white');
                } else {
                    menu.classList.remove('visible-on-white');
                }
            } else {
                menu.classList.remove('visible-on-white');
            }
        });

        // Tambahkan kode untuk menambahkan kelas 'visible-on-white' saat halaman pertama kali dibuka
        document.addEventListener('DOMContentLoaded', function() {
            const menu = document.querySelector('.menu-item');
            const currentPage = window.location.pathname;
            const bgColor = window.getComputedStyle(document.body).backgroundColor;

            // Jika latar belakang adalah putih dan bukan halaman index, tambahkan kelas 'visible-on-white'
            if (bgColor === 'rgb(255, 255, 255)' || bgColor === '#ffffff') {
                if (currentPage !== '/index' && currentPage !== '/') {
                    menu.classList.add('visible-on-white');
                } else {
                    menu.classList.remove('visible-on-white');
                }
            } else {
                menu.classList.remove('visible-on-white');
            }
        });
    </script>
@endpush
