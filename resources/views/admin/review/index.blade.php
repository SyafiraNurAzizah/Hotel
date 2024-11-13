@extends('layouts.app')

@section('content')
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text py-4">
                        <h2>Admin Review</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="mb-5">
        <div class="container">
            <div class="admin-rating">
                <div class="row">
                    {{-- <div class="col-lg-4" style="background-color: #f5b917"> --}}
                        <div class="col-lg-4">
                            <h3 class="mb-2">Total Review</h3>
                            <div class="d-flex align-items-center">
                                <h4 class="px-2 py-1">10.0k</h4>
                            </div>
                            <p>Peningkatan ulasan pada tahun ini</p>
                        </div>
                    {{-- <div class="col-lg-4" style="background-color: #f5b917"> --}}
                    <div class="col-lg-4">
                        <h3 class="mb-2">Average Rating</h3>
                        <div class="d-flex align-items-center">
                            <h4 class="px-2 py-1">4.5</h4>
                            <div class="rating" style="color: #f5b917">
                                {{-- @for ($i = 1; $i <= $room->ratings->avg('rating'); $i++)
                                <i class="icon_star"></i>
                            @endfor
                            @for ($i = $room->ratings->avg('rating') + 1; $i <= 5; $i++)
                                <i class="icon_star-empty"></i>
                            @endfor --}}

                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star-half_alt"></i>
                            </div>
                        </div>
                        <p>Average rating on this year</p>
                    </div>
                    {{-- <div class="col-lg-4" style="background-color: #f5b917"> --}}
                    <div class="col-lg-4">
                        <div class="rate">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <section>
        <div class="container">
            <div class="row">
                <div class="reviews">
                    <h4>Reviews</h4>
                    @forelse ($room->ratings as $rating)
                        <div class="review">
                            <div class="review-item">
                                <div class="ri-pic">
                                    <img src="img/room/avatar/avatar-1.jpg" alt="">
                                </div>
                                <div class="ri-text">
                                    <h5 class="m-0">{{ $rating->user->firstname }}</h5>
                                    <span>{{ $rating->created_at->format('Y-m-d') }}</span>
                                    <div class="rating">
                                        @for ($i = 1; $i <= $rating->rating; $i++)
                                            <i class="icon_star"></i>
                                        @endfor
                                        @for ($i = $rating->rating + 1; $i <= 5; $i++)
                                            <i class="icon_star-empty"></i>
                                        @endfor
                                    </div>
                                    <p class="mt-2">{{ $rating->comment }}</p>
                                </div>
                            </div>


                        </div>
                    @empty
                        <P>Belum ada rating</P>
                    @endforelse
                </div>
            </div>
        </div>
    </section> --}}

@endsection
