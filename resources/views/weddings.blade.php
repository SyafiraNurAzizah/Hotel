@extends('layouts.app')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text m-5">
                        <h2>Weedings Rooms</h2>
                        <div class="bt-option">
                            <a href="{{ route('index')}}">Beranda</a>
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
                <div class="col-lg-4 col-md-6">
                    <div class="room-item">
                        <img src="img/weddings/weddings.jpg" alt="">
                        <div class="ri-text">
                            <h4>Weedings Room</h4>
                            
                            <h3>IDR 5.000.000 <br><span class="text-muted">nett min. 200 guests</span></h3>
                            <div class="btn-contact d-flex justify-content-between align-items-center my-3">
                                <a href="#" class="btn btn-outline-secondary w-35 contact-btn d-flex align-items-center">
                                    <i class="icon_phone" style="margin-right: 8px;"></i> Contact
                                </a>
                                <a href="#" class="btn btn-outline-secondary w-35 gmail-btn d-flex align-items-center">
                                    <i class="icon_mail_alt" style="margin-right: 8px;"></i> Gmail
                                </a>
                                
                                
                            </div>
                            <a href="{{ route('weddings.details')}}" class="primary-btn">More Details</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="room-item">
                        <img src="img/weddings/weddings.jpg" alt="">
                        <div class="ri-text">
                            <h4>Weedings Room</h4>
                            
                            <h3>IDR 5.000.000 <br><span class="text-muted">nett min. 200 guests</span></h3>
                            <div class="btn-contact d-flex justify-content-between align-items-center my-3">
                                <a href="#" class="btn btn-outline-secondary w-35 contact-btn d-flex align-items-center">
                                    <i class="icon_phone" style="margin-right: 8px;"></i> Contact
                                </a>
                                <a href="#" class="btn btn-outline-secondary w-35 gmail-btn d-flex align-items-center">
                                    <i class="icon_mail_alt" style="margin-right: 8px;"></i> Gmail
                                </a>
                                
                                
                            </div>
                            <a href="#" class="primary-btn">More Details</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="room-item">
                        <img src="img/weddings/weddings.jpg" alt="">
                        <div class="ri-text">
                            <h4>Weedings Room</h4>
                            
                            <h3>IDR 5.000.000 <br><span class="text-muted">nett min. 200 guests</span></h3>
                            <div class="btn-contact d-flex justify-content-between align-items-center my-3">
                                <a href="#" class="btn btn-outline-secondary w-35 contact-btn d-flex align-items-center">
                                    <i class="icon_phone" style="margin-right: 8px;"></i> Contact
                                </a>
                                <a href="#" class="btn btn-outline-secondary w-35 gmail-btn d-flex align-items-center">
                                    <i class="icon_mail_alt" style="margin-right: 8px;"></i> Gmail
                                </a>
                                
                                
                            </div>
                            <a href="#" class="primary-btn">More Details</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="room-item">
                        <img src="img/weddings/weddings.jpg" alt="">
                        <div class="ri-text">
                            <h4>Weedings Room</h4>
                            
                            <h3>IDR 5.000.000 <br><span class="text-muted">nett min. 200 guests</span></h3>
                            <div class="btn-contact d-flex justify-content-between align-items-center my-3">
                                <a href="#" class="btn btn-outline-secondary w-35 contact-btn d-flex align-items-center">
                                    <i class="icon_phone" style="margin-right: 8px;"></i> Contact
                                </a>
                                <a href="#" class="btn btn-outline-secondary w-35 gmail-btn d-flex align-items-center">
                                    <i class="icon_mail_alt" style="margin-right: 8px;"></i> Gmail
                                </a>
                                
                                
                            </div>
                            <a href="#" class="primary-btn">More Details</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="room-item">
                        <img src="img/weddings/weddings.jpg" alt="">
                        <div class="ri-text">
                            <h4>Weedings Room</h4>
                            
                            <h3>IDR 5.000.000 <br><span class="text-muted">nett min. 200 guests</span></h3>
                            <div class="btn-contact d-flex justify-content-between align-items-center my-3">
                                <a href="#" class="btn btn-outline-secondary w-35 contact-btn d-flex align-items-center">
                                    <i class="icon_phone" style="margin-right: 8px;"></i> Contact
                                </a>
                                <a href="#" class="btn btn-outline-secondary w-35 gmail-btn d-flex align-items-center">
                                    <i class="icon_mail_alt" style="margin-right: 8px;"></i> Gmail
                                </a>
                                
                                
                            </div>
                            <a href="#" class="primary-btn">More Details</a>
                        </div>
                    </div>
                </div>
                


                <div class="col-lg-12">
                    <div class="room-pagination">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">Next <i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Rooms Section End -->
@endsection
