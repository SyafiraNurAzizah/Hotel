@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text py-5">
                        <h2>Admin Review</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section>
        <div class="container p-0 mb-4">
            <div class="admin-rating">
                <div class="row" style="justify-content: center; gap: 35px">
                    {{-- <div class="col-lg-4" style="background-color: #f5b917"> --}}
                    <div class="col-lg-3 p-3" style="background-color: #efebdf; border-radius: 25px">
                        <h3 class="mb-2">Total Review</h3>
                        <div class="d-flex align-items-center">
                            <h4 class="px-2 py-1">10.0k</h4>
                        </div>
                        <p>Peningkatan ulasan pada tahun ini</p>
                    </div>
                    {{-- <div class="col-lg-4" style="background-color: #f5b917"> --}}
                    <div class="col-lg-3 p-3" style="background-color: #efebdf; border-radius: 25px">
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
                    <div class="col-lg-3 p-3" style="background-color: #efebdf; border-radius: 25px">
                        <h3 class="mb-2">Bar Chart Review</h3>
                        <div class="d-flex align-items-center">
                            <h4 class="px-2 py-1">10.0k</h4>
                        </div>
                        <p>Peningkatan ulasan pada tahun ini</p>

                        {{-- <div class="rate"> --}}
                        {{-- <h1>Hotel Rating Distribution</h1> --}}
                        {{-- @forelse ($ratings as $rating)
                                <canvas id="ratingChart" width="400" height="200"></canvas>
                            @empty
                                <p>Belum ada rating</p>
                            @endforelse --}}

                        {{-- <canvas id="ratingChart" width="400" height="200"></canvas> --}}
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

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-10">
                    <div class="rd-reviews">
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

                    {{-- <div class="rd-reviews">
                        <h3 class="mb-4">Reviews</h3>
                        <div class="review-item">
                            <div class="ri-pic">
                                <img src="img/room/avatar/avatar-1.jpg" alt="">
                            </div>
                            <div class="ri-text">
                                <h5 class="m-0">Brandon Kelley</h5>
                                <span>27 Aug 2019</span>
                                <div class="rating">
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star-half_alt"></i>
                                </div>
                                <p class="mt-2">Neque porro qui squam est, qui dolorem ipsum quia dolor sit amet,
                                    consectetur,
                                    adipisci velit, sed quia non numquam eius modi tempora. incidunt ut labore et dolore
                                    magnam.</p>
                                <form action="{{ route('admin.review.destroy', $room->id) }}" method="POST" id="form-delete"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                        <div class="review-item">
                            <div class="ri-pic">
                                <img src="img/room/avatar/avatar-1.jpg" alt="">
                            </div>
                            <div class="ri-text">
                                <h5 class="m-0">Brandon Kelley</h5>
                                <span>27 Aug 2019</span>
                                <div class="rating">
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star-half_alt"></i>
                                </div>
                                <p class="mt-2">Neque porro qui squam est, qui dolorem ipsum quia dolor sit amet,
                                    consectetur,
                                    adipisci velit, sed quia non numquam eius modi tempora. incidunt ut labore et dolore
                                    magnam.</p>
                            </div>
                        </div>
                        <div class="review-item">
                            <div class="ri-pic">
                                <img src="img/room/avatar/avatar-2.jpg" alt="">
                            </div>
                            <div class="ri-text">
                                <h5 class="m-0">Brandon Kelley</h5>
                                <span>27 Aug 2019</span>
                                <div class="rating">
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star-half_alt"></i>
                                </div>
                                <p class="mt-2">Neque porro qui squam est, qui dolorem ipsum quia dolor sit amet,
                                    consectetur,
                                    adipisci velit, sed quia non numquam eius modi tempora. incidunt ut labore et dolore
                                    magnam.</p>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- <script>
        var ctx = document.getElementById('ratingChart').getContext('2d');
        var ratingData = @json($ratingData); // This will pass the PHP array to JavaScript
    
        var chart = new Chart(ctx, {
            type: 'bar', // Define chart type
            data: {
                labels: ['1 Star', '2 Stars', '3 Stars', '4 Stars', '5 Stars'], // Rating labels
                datasets: [{
                    label: 'Number of Ratings',
                    data: [
                        ratingData[1],
                        ratingData[2],
                        ratingData[3],
                        ratingData[4],
                        ratingData[5]
                    ], // Rating counts
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Bar color
                    borderColor: 'rgba(54, 162, 235, 1)', // Bar border color
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script> --}}
@endpush


@push('styles')
    <style>
        #star-rating .icon_star {
            font-size: 20px;
            color: #e0e0e0;
            transition: color 0.2s ease;
        }

        #star-rating .icon_star.filled {
            color: #f5b917;
        }

        #star-rating .icon_star:hover {
            color: #f5b917;
        }
    </style>
@endpush
