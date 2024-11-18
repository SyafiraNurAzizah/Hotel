<!-- Footer Section Begin -->
<footer class="footer-section">
    <div class="container">
        <div class="footer-text">
            <div class="row">
                <div class="col-lg-4">
                    <div class="ft-about">
                        <p>Kami menginspirasi dan menjangkau jutaan wisatawan di seluruh belahan dunia.</p>
                        <div class="fa-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-tripadvisor"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-youtube-play"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="ft-contact">
                        <h6>Contact Us</h6>
                        <ul>
                            <li>(12) 345 67890</li>
                            <li>berlianhotel@gmail.com</li>
                            <li>Jl. Jendral Sudirman No. 123 Jakarta, Indonesia</li>
                        </ul>
                    </div>
                </div>
                <div class="logo">
                    <a href="#">
                        <img src="{{ asset('img/berlian-white.png') }}" alt="" class="logo-footer">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <ul>
                        <li><a href={{( route('contact'))}}>Contact</a></li>
                        <li><a href={{( route('termofus'))}}>Terms of use</a></li>
                        <li><a href={{( route('privacyhotel'))}}>Privacy</a></li>
                        <li><a href={{ route('kebpolice')}}>Environmental Policy</a></li>
                    </ul>
                </div>
               
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->