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
                @if ($room->isNotEmpty())
                    {{-- <div class="manage-system">
                        <div class="filter">
                            <form action="{{ route('admin.review.index') }}" method="GET">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="year">Year</label>
                                            <select name="year" id="year" class="form-control">
                                                <option value="">All</option>
                                                @foreach ($years as $year)
                                                    <option value="{{ $year->year }}">{{ $year->year }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="month">Month</label>
                                            <select name="month" id="month" class="form-control">
                                                <option value="">All</option>
                                                @foreach ($months as $month)
                                                    <option value="{{ $month->month }}">{{ $month->month }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> --}}
                    <div class="row" style="justify-content: center; gap: 35px">
                        <!-- Total Review Box -->
                        <div class="col-lg-3 p-3 shadow-lg" style="background-color: #efebdf; border-radius: 25px">
                            <h3 class="mb-2">Total Review</h3>
                            <div class="d-flex align-items-center">
                                <h4 class="px-3 py-2">{{ $totalReviews }}</h4>
                                <p class="mb-0 ms-2">reviews</p>
                            </div>
                            <p>Total reviews this year</p>
                        </div>

                        <!-- Average Rating Box -->
                        <div class="col-lg-3 p-3 shadow-lg" style="background-color: #efebdf; border-radius: 25px">
                            <h3 class="mb-2">Average Rating</h3>
                            <div class="d-flex align-items-center">
                                <h4 class="px-3 py-2">{{ number_format($averageRating, 1) }}</h4>
                                <div class="rating" style="color: #f5b917">
                                    @for ($i = 1; $i <= floor($averageRating); $i++)
                                        <i class="icon_star"></i>
                                    @endfor
                                    @for ($i = ceil($averageRating) + 1; $i <= 5; $i++)
                                        <i class="icon_star-empty"></i>
                                    @endfor
                                </div>
                            </div>
                            <p>Average rating on this year</p>
                        </div>

                        <!-- Bar Chart Box -->
                        <div class="col-lg-3 p-3 shadow-lg" style="background-color: #efebdf; border-radius: 25px">
                            {{-- <h3 class="mb-2">Bar Chart Review</h3> --}}
                            <div class="bar-chart">
                                <canvas id="barChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                @else
                    <p>No reviews yet.</p>
                @endif
            </div>
        </div>
    </section>






    {{-- <section>
        <div class="container p-0 mb-4">
            <div class="admin-rating">
                @forelse ($room as $item)
                    @foreach ($item->ratings as $rating)
                        <div class="row" style="justify-content: center; gap: 35px">
                            <div class="col-lg-3 p-3" style="background-color: #efebdf; border-radius: 25px">
                                <h3 class="mb-2">Total Review</h3>
                                <div class="d-flex align-items-center">
                                    <h4 class="px-2 py-1 m-0">{{ $rating->count() }}</h4>
                                    <p class="mb-0 ms-2">reviews</p>
                                </div>
                                <p>Peningkatan ulasan pada tahun ini</p>
                            </div>

                            <div class="col-lg-3 p-3" style="background-color: #efebdf; border-radius: 25px">
                                <h3 class="mb-2">Average Rating</h3>
                                <div class="d-flex align-items-center">
                                    <h4 class="px-2 py-1">{{ $rating->avg('rating') }}</h4>
                                    <div class="rating" style="color: #f5b917">
                                        @for ($i = 1; $i <= $rating->avg('rating'); $i++)
                                            <i class="icon_star"></i>
                                        @endfor
                                        @for ($i = $rating->avg('rating') + 1; $i <= 5; $i++)
                                            <i class="icon_star-empty"></i>
                                        @endfor
                                    </div>
                                </div>
                                <p>Average rating on this year</p>
                            </div>

                            <div class="col-lg-3 p-3" style="background-color: #efebdf; border-radius: 25px">
                                <h3 class="mb-2">Bar Chart Review</h3>
                                <div class="bar-chart">
                                    <canvas id="barChart" width="400" height="200"></canvas>
                                </div>
                                <p>Review per bulan</p>
                            </div>
                        </div>
                    @endforeach
                @empty
                    <p>No reviews yet.</p>
                @endforelse

            </div>
        </div>
    </section> --}}

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-10">
                    <div class="rd-reviews">
                        {{-- <div class="reviews"> --}}
                            <h3 class="mb-4">Reviews</h3>
                            @forelse ($room as $item)
                                @foreach ($item->ratings as $rating)
                                <div class="review d-flex shadow-sm p-3 mb-3" style="background-color: #efebdf; border-radius: 25px;">
                                    <div class="review-item col-lg-8 m-0">
                                        <div class="ri-pic">
                                            <img src="img/room/avatar/avatar-1.jpg" alt="">
                                        </div>
                                        <div class="ri-text">
                                            <h5 class="m-0">{{ $rating->user->firstname }}</h5>
                                            <span>{{ $rating->created_at->format('Y-m-d') }}</span>
                                            <div class="rating">
                                                @for ($i = 1; $i <= $rating->rating; $i++)
                                                    <i class="icon_star" style="float: right;"></i>
                                                @endfor
                                                @for ($i = $rating->rating + 1; $i <= 5; $i++)
                                                    <i class="icon_star-empty"></i>
                                                @endfor
                                            </div>
                                            <p class="mt-2">{{ $rating->comment }}</p>
                                        </div>
                                    </div>
                                    {{-- <div class="aksi m-0 p-0" style="background-color: #abab"> --}}
                                        
                                        <form action="{{ route('admin.review.destroy', $rating->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                                        </form>
                                    {{-- </div> --}}
                                </div>
                                
                                
                                @endforeach
                            @empty
                                <p>No reviews yet.</p>
                            @endforelse
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- menampilkan data --}}
    {{-- <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Admin Reviews</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Rating</th>
                                            <th>Komentar</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($room as $item)
                                            @foreach ($item->ratings as $rating)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $rating->user->firstname }}</td>
                                                <td>
                                                    @for ($i = 1; $i <= $rating->rating; $i++)
                                                        <i class="icon_star"></i>
                                                    @endfor
                                                </td>
                                                <td>{{ $rating->comment }}</td>
                                                <td>{{ $rating->created_at->format('d-m-Y, H:i') }}</td>
                                            </tr>
                                            @endforeach
                                        @empty
                                            <tr>
                                                <td colspan="8" class="no-data">No data available</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

    {{-- <section>
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
                    </div> --}}

    {{-- <div class="rd-reviews">
                        <h3 class="mb-4">Reviews</h3>
                        <div class="review-item mb-4">
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
                                <button type="reset" class="btn btn-outline-danger btn-sm mt-2">Delete</button>
                                
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
                                    <button type="reset" class="btn btn-outline-danger btn-sm mt-2">Delete</button>
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
                                    <button type="reset" class="btn btn-outline-danger btn-sm mt-2">Delete</button>
                            </div>
                        </div>
                    </div> --}}
    {{-- </div>
            </div>
        </div>
    </section> --}}
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const labels = @json($labels);
            const data = @json($data);

            const ctx = document.getElementById('barChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels, // Labels untuk x-axis
                    datasets: [{
                        label: 'Jumlah Ulasan',
                        data: data, // Data untuk y-axis
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Ulasan'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Rating'
                            }
                        }
                    }
                }
            });
        });
    </script>
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
