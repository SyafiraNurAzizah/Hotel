@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/detailmeet.css') }}">
@section('content')
    <style>
        .gallery-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .card-container {
            flex: 1 1 300px;
            max-width: 300px;
        }

        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card img {
            width: 100%;
            height: auto;
        }

        .card-content {
            padding: 16px;
            text-align: center;
        }

        .appointment-form {
            width: 100%;
            max-width: 600px;
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
        }

        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-header h2 {
            color: #1e3c72;
            font-size: 2em;
            margin-bottom: 10px;
        }

        .form-header p {
            color: #666;
            font-size: 1.1em;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #1e3c72;
            font-weight: 500;
        }

        .input-group {
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #1e3c72;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 1em;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        .form-control:focus {
            border-color: #1e3c72;
            box-shadow: 0 0 10px rgba(30, 60, 114, 0.2);
            outline: none;
        }

        .error-message {
            color: #e74c3c;
            font-size: 0.9em;
            margin-top: 5px;
            display: none;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .form-control.error {
            border-color: #e74c3c;
        }

        .form-control.success {
            border-color: #2ecc71;
        }

        .time-slots {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 10px;
            margin-top: 10px;
        }

        .time-slot {
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 6px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .time-slot:hover {
            background: rgba(30, 60, 114, 0.1);
        }

        .time-slot.selected {
            background: #1e3c72;
            color: white;
            border-color: #1e3c72;
        }

        .submit-btn {
            width: 100%;
            padding: 15px;
            background: #1e3c72;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1em;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .submit-btn:hover {
            background: #2a5298;
            transform: translateY(-2px);
        }

        .success-message {
            display: none;
            text-align: center;
            color: #2ecc71;
            margin-top: 20px;
            font-size: 1.1em;
            padding: 10px;
            border-radius: 8px;
            background: rgba(46, 204, 113, 0.1);
        }

        @keyframes shake {
            0%, 100% {
                transform: translateX(0);
            }
            25% {
                transform: translateX(-5px);
            }
            75% {
                transform: translateX(5px);
            }
        }

        .shake {
            animation: shake 0.4s ease-in-out;
        }

        @media (max-width: 480px) {
            .appointment-form {
                padding: 20px;
            }

            .form-header h2 {
                font-size: 1.5em;
            }

            .time-slots {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>{{ $location }} Rooms</h2>
                        <div class="bt-option">
                            <a href="{{ route('ruang', ['location' => strtolower($location)]) }}" class="active">Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="room-details-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="room-details-item">
                        <img src="{{ $room->foto }}" alt="">
                        <div class="rd-text">
                            <div class="rd-title">
                                <h3>{{ $room->nama_ruang }}</h3>
                            </div>
                            <h2> Rp.{{ $room->harga_per_jam }}<span>/Jam</span></h2>
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="r-o">Ukuran:</td>
                                        <td>{{ $room->ukuran_ruang }} m²</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Kapasitas:</td>
                                        <td>{{ $room->kapasitas }} orang</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Fasilitas:</td>
                                        <td>{{ $room->fasilitas }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <p class="f-para">{{ $room->deskripsi }}</p>
                        </div>
                    </div>

                    @foreach ($gallery as $item)
                        <div class="card-container">
                            <div class="card">
                                <img src="{{ asset('img/meetings/gallery/' . $item->foto) }}" alt="">
                                <div class="card-content">
                                    <h4 class="card-title">{{ $item->deskripsi }}</h4>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="row">
                        <div class="gallery-grid">
                            @foreach ($gallery as $item)
                                <div class="card-container">
                                    <div class="card">
                                        <img src="{{ asset('img/meetings/' . $item->foto) }}" alt="">
                                        <div class="card-content">
                                            <h4 class="card-title">{{ $item->deskripsi }}</h4>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>

                    <div class="rd-reviews">
                        <h4>Reviews</h4>
                    </div>
                    <div class="review-add">
                        <h4>Add Review</h4>
                        <form action="#" class="ra-form">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Name*">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Email*">
                                </div>
                            </div>
                            <textarea placeholder="Your Review"></textarea>
                            <button type="submit">Submit Now</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    @foreach($hotels as $hotel)
                    <form action="{{ route('booking.meeting.store', ['location' => strtolower($location), 'roomId' => $room->id]) }}" method="POST" class="appointment-form" id="appointmentForm">
                        @csrf
                        <div class="form-header">
                            <h2>Reservasi</h2>
                        </div>

                        <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
                        <input type="hidden" name="meeting_id" value="{{ $room->id }}">

                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <div class="input-group">
                                <i class="fas fa-user"></i>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>
                            <p class="error-message" id="nameError">Please enter your full name.</p>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <div class="input-group">
                                <i class="fas fa-envelope"></i>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                            <p class="error-message" id="emailError">Please enter a valid email.</p>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <div class="input-group">
                                <i class="fas fa-phone"></i>
                                <input type="text" id="phone" name="phone" class="form-control" required>
                            </div>
                            <p class="error-message" id="phoneError">Please enter a valid phone number.</p>
                        </div>

                        <div class="form-group">
                            <label for="date">Date</label>
                            <div class="input-group">
                                <i class="fas fa-calendar"></i>
                                <input type="date" id="date" name="date" class="form-control" required>
                            </div>
                            <p class="error-message" id="dateError">Please select a date.</p>
                        </div>

                        <div class="form-group">
                            <label for="startTime">Start Time</label>
                            <input type="hidden" id="startTime" name="start_time">
                            <div class="time-slots" id="startTimeSlots">
                                <div class="time-slot" data-time="08:00 AM">08:00 AM</div>
                                <div class="time-slot" data-time="09:00 AM">09:00 AM</div>
                                <div class="time-slot" data-time="10:00 AM">10:00 AM</div>
                                <div class="time-slot" data-time="11:00 AM">11:00 AM</div>
                                <div class="time-slot" data-time="12:00 PM">12:00 PM</div>
                                <div class="time-slot" data-time="01:00 PM">01:00 PM</div>
                                <div class="time-slot" data-time="02:00 PM">02:00 PM</div>
                                <div class="time-slot" data-time="03:00 PM">03:00 PM</div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="endTime">End Time</label>
                            <input type="hidden" id="endTime" name="end_time">
                            <div class="time-slots" id="endTimeSlots">
                                <div class="time-slot" data-time="09:00 AM">09:00 AM</div>
                                <div class="time-slot" data-time="10:00 AM">10:00 AM</div>
                                <div class="time-slot" data-time="11:00 AM">11:00 AM</div>
                                <div class="time-slot" data-time="12:00 PM">12:00 PM</div>
                                <div class="time-slot" data-time="01:00 PM">01:00 PM</div>
                                <div class="time-slot" data-time="02:00 PM">02:00 PM</div>
                                <div class="time-slot" data-time="03:00 PM">03:00 PM</div>
                                <div class="time-slot" data-time="04:00 PM">04:00 PM</div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="submit-btn">Book Now</button>
                        </div>
                    </form>
                    @endforeach
                    <div class="success-message" id="successMessage">Your reservation was successfully made!</div>
                </div>
            </div>
        </div>
    </section>
@endsection



@push('scripts')
<script>
    const startTimeSlots = document.querySelectorAll('#startTimeSlots .time-slot');
    const endTimeSlots = document.querySelectorAll('#endTimeSlots .time-slot');
    const startTimeInput = document.getElementById('startTime');
    const endTimeInput = document.getElementById('endTime');

    startTimeSlots.forEach(startSlot => {
        startSlot.addEventListener('click', () => {
            const selectedStartTime = startSlot.getAttribute('data-time');
            startTimeInput.value = selectedStartTime;

            startTimeSlots.forEach(s => s.classList.remove('selected'));
            startSlot.classList.add('selected');

            endTimeSlots.forEach(endSlot => {
                const endTime = endSlot.getAttribute('data-time');
                endSlot.style.display = isValidEndTime(selectedStartTime, endTime) ? 'block' : 'none';
            });
        });
    });

    endTimeSlots.forEach(endSlot => {
        endSlot.addEventListener('click', () => {
            const selectedEndTime = endSlot.getAttribute('data-time');
            endTimeInput.value = selectedEndTime;

            endTimeSlots.forEach(s => s.classList.remove('selected'));
            endSlot.classList.add('selected');
        });
    });

    function isValidEndTime(startTime, endTime) {
        const parseTime = timeStr => new Date(`1970/01/01 ${timeStr}`);
        return parseTime(endTime) > parseTime(startTime);
    }
</script>
@endpush
