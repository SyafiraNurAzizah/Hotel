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
                                <li class="active"><a href="./index.html">Beranda</a></li>
                                <li><a href="./rooms.html">Hotel</a></li>
                                <li><a href="./about-us.html">Meetings</a></li>
                                <li><a href="./pages.html">Weedings</a>
                                    {{-- <ul class="dropdown">
                                        <li><a href="./room-details.html">Room Details</a></li>
                                        <li><a href="./blog-details.html">Blog Details</a></li>
                                        <li><a href="#">Family Room</a></li>
                                        <li><a href="#">Premium Room</a></li>
                                    </ul> --}}
                                </li>
                            
                                <li><a href="./contact.html">Contact</a></li>
                            </ul>
                        </nav>
                        <div class="nav-right search-switch">
                            <i class="icon_search"></i>
                        </div>
                        <div class="nav-right login-button">
                            <a href="{{ route('login') }}"><i class="fa fa-user"></i></a>
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
        
        // Jika halaman digulir lebih dari 50px, tambahkan kelas 'scrolled'
        if (window.scrollY > 50) {
            menu.classList.add('scrolled');
        } else {
            menu.classList.remove('scrolled');
        }
    });
</script>

@endpush