<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">

<header class="header-section">
    <div class="menu-item">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="logo">
                        <a href="./index.html">
                            <img src="img/berlian.png" alt="Logo" class="logo-img">
                        </a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="nav-menu">
                        <nav class="mainmenu">
                            <ul>
                                <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ route('index') }}">Beranda</a></li>
                                <li class="{{ Request::is('hotel') ? 'active' : '' }}"><a href="{{ url('hotel') }}">Hotel</a></li>
                                <li class="{{ Request::is('meeting') ? 'active' : '' }}"><a href="{{url('meeting')}}">Meetings</a></li>
                                <li class="{{ Request::is('pages') ? 'active' : '' }}"><a href="./pages.html">Weedings</a></li>
                                <li class="{{ Request::is('contact') ? 'active' : '' }}"><a href="./contact.html">Contact</a></li>
                            </ul>
                        </nav>                        
                        <div class="nav-right search-switch">
                            <i class="icon_search"></i>
                        </div>
                        <div class="nav-right login-button">
                            @if (Auth::check())

                                <div class="profile-user">
                                    <span>{{ Auth::user()->firstname }}</i></span>
                                    <div class="user-dropdown">
                                        <ul>
                                            <li><a href="#">Profile</a></li>
                                            <li>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                </form>
                                                <a href="#"
                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    <i class="fa fa-sign-out"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @else
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