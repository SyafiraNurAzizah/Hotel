@extends('layouts.app')

@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>Meetings</h2>
                    <p>Explore our latest meetings and stay updated with the latest events and schedules.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->



<!-- Meetings Section Begin -->
<section class="meeting-section spad">
    <div class="container">
        <div class="row">
            <!-- Contoh item Meeting -->
            <div class="col-lg-4 col-md-6">
                <img src="{{ asset('img/meetings/meeting-1.jpg') }}" alt="Business Strategy Conference 2024" class="img-fluid mb-3">
                <div class="mi-text">
                    <span class="m-tag">Conference</span>
                    <h4><a href="#" data-bs-toggle="modal" data-bs-target="#meetingModal">Business Strategy Conference 2024</a></h4>
                    <div class="m-time"><i class="icon_clock_alt"></i> 12th March, 2024</div>
                    
                    <!-- Button Booking -->
                    <div class="mt-3">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#meetingModal">Booking Now</button>
                    </div>
                </div>
            </div>

            <!-- Tambah lebih banyak item sesuai kebutuhan -->
            <div class="col-lg-12">
                <div class="load-more">
                    <a href="#" class="primary-btn">Load More Meetings</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Meetings Section End -->

<!-- Modal -->
<div class="modal fade" id="meetingModal" tabindex="-1" aria-labelledby="meetingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="meetingModalLabel">Business Strategy Conference 2024</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4>Description</h4>
                <p>
                    Join us for the Business Strategy Conference 2024, where industry leaders will gather to discuss the latest trends and strategies in business development.
                </p>
                <h4>Details</h4>
                <p><strong>Date:</strong> 12th March, 2024</p>
                <p><strong>Time:</strong> 10:00 AM - 4:00 PM</p>
                <p><strong>Location:</strong> Grand Ballroom, City Center Hotel</p>
                
                <h4>Agenda</h4>
                <ol>
                    <li>10:00 AM - Registration</li>
                    <li>11:00 AM - Keynote Speech</li>
                    <li>12:00 PM - Panel Discussion</li>
                    <li>1:00 PM - Lunch Break</li>
                    <li>2:00 PM - Workshops</li>
                    <li>4:00 PM - Networking</li>
                </ol>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="#" class="btn btn-warning">Book Your Spot Now</a>
            </div>
        </div>
    </div>
</div>

@endsection
