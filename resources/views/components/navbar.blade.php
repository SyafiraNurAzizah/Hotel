<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">

<header class="header-section">
    <div class="menu-item">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="logo">
                        <a href="{{ route('index') }}">
                            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo-img">
                        </a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="nav-menu">
                        <nav class="mainmenu">
                            <ul>
                                @if (Auth::guest())
                                    <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ route('index') }}">Beranda</a></li>
                                    <li class="{{ Request::is('hotel') ? 'active' : '' }}"><a href="{{ url('hotel') }}">Hotel</a></li>
                                    <li class="{{ Request::is('meeting') ? 'active' : '' }}"><a href="{{url('meeting')}}">Meetings</a></li>
                                    <li class="{{ Request::is('pages') ? 'active' : '' }}"><a href="./pages.html">Weedings</a></li>
                                    <li class="{{ Request::is('contact') ? 'active' : '' }}"><a href="./contact.html">Contact</a></li>
                                @elseif (Auth::check() && Auth::user()->role == 'user')
                                    <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ route('index') }}">Beranda</a></li>
                                    <li class="{{ Request::is('hotel') ? 'active' : '' }}"><a href="{{ url('hotel') }}">Hotel</a></li>
                                    <li class="{{ Request::is('meeting') ? 'active' : '' }}"><a href="{{url('meeting')}}">Meetings</a></li>
                                    <li class="{{ Request::is('pages') ? 'active' : '' }}"><a href="./pages.html">Weedings</a></li>
                                    <li class="{{ Request::is('contact') ? 'active' : '' }}"><a href="./contact.html">Contact</a></li>
                                @elseif (Auth::check() && Auth::user()->role == 'admin')
                                    <li class="{{ Request::is('admin') ? 'active' : '' }}"><a href="{{ route('admin.index') }}">ADMIN</a></li>
                                    <li class="{{ Request::is('hotel') ? 'active' : '' }}"><a href="{{ route('admin.hotel.index') }}">Hotel</a></li>
                                @endif
                            </ul>
                        </nav>                        
                        <div class="nav-right search-switch">
                            <i class="icon_search"></i>
                        </div>
                        <div class="nav-right login-button">
                            @if (Auth::check() && Auth::user()->role == 'user')
                                <div class="profile-user">
                                    <span>{{ Auth::user()->firstname }}</span>
                                    <div class="user-dropdown">
                                        <div class="bridge"></div>
                                        <ul>
                                            <li onclick="window.location.href='{{ route('profile', ['firstname' => auth()->user()->firstname, 'lastname' => auth()->user()->lastname]) }}'">
                                                <i class="fa-regular fa-user"></i>
                                                <a>Profil</a>
                                            </li>
                                            <div class="horizontal-line-dropdown"></div>
                                            <li onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                                <a>Keluar</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @elseif (Auth::check() && Auth::user()->role == 'admin')
                                <div class="profile-user">
                                    <span>{{ Auth::user()->firstname }}</span>
                                    <div class="user-dropdown">
                                        <div class="bridge"></div>
                                        <ul>
                                            <li onclick="window.location.href='{{ route('profile', ['firstname' => auth()->user()->firstname, 'lastname' => auth()->user()->lastname]) }}'">
                                                <i class="fa-regular fa-user"></i>
                                                <a>Profil</a>
                                            </li>
                                            <div class="horizontal-line-dropdown"></div>
                                            <li onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                                <a>Keluar</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @else
                                <a href="#" id="openLoginPopup"><i class="fa fa-user guest"></i></a>
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
        window.addEventListener('scroll', function() {
            const menu = document.querySelector('.menu-item');
            const currentPage = window.location.pathname;
            const bgColor = window.getComputedStyle(document.body).backgroundColor;

            if (window.scrollY > 50) {
                menu.classList.add('scrolled');
            } else {
                menu.classList.remove('scrolled');
            }

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


        document.addEventListener('DOMContentLoaded', function() {
            const menu = document.querySelector('.menu-item');
            const currentPage = window.location.pathname;
            const bgColor = window.getComputedStyle(document.body).backgroundColor;

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


        const navMenu = document.querySelector('.nav-menu');
        const loginButton = navMenu.querySelector('.nav-right.login-button');

        if (loginButton.querySelector('.user-dropdown')) {
            navMenu.classList.add('dropdown-present');
        } else {
            navMenu.classList.remove('dropdown-present');
        }
    </script>
@endpush