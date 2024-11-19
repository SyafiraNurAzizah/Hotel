@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/detailmeet.css') }}">

@section('content')
    {{-- <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>{{ $location }} Rooms</h2>
                        <div class="bt-option">
                            <a href="{{ route('ruang', ['location' => strtolower($location)]) }}" class="active">Home</a>
                            <span><a href="#">Gallery</a></span>
                            <span><a href="{{ route('gallery', ['location' => strtolower($location), 'roomId' => $roomId]) }}">Gallery</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <br><br><br><br>

    <section class="room-details-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="room-details-item">
                        <img src="{{ asset('img/meetings/rooms/' . $room->foto) }}" alt="Room image">
                        <div class="rd-text">
                            <div class="rd-title">
                                <h3>{{ $room->nama_ruang }}</h3>
                                <div class="rdt-right">
                                    <div class="rating">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star-half_alt"></i>
                                    </div>
                                    {{-- <a href="#">Booking Now</a --}}
                                </div>
                            </div>
                            <h2>Rp{{ number_format($room->harga_per_jam, 2, ',', '.') }}<span>/Malam</span></h2>
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
                            <p class="f-para">{!! nl2br(e($room->deskripsi)) !!}</p>
                        </div>
                    </div>
    {{-- <section class="room-details-section spad">
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
                    <div class="row"> --}}
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
                    
                <div class="col-lg-4">
                    @if(Auth::check() && Auth::user()->isUser())
                    @foreach($hotels as $hotel)
                    <form action="{{ route('booking.meeting.store', ['location' => strtolower($location), 'roomId' => $room->id]) }}" method="POST" class="appointment-form" id="appointmentForm">
                        @csrf
                        <div class="form-header">
                            <h2>Reservasi</h2>
                        </div>

                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
                        <input type="hidden" name="meeting_id" value="{{ $room->id }}">

                        <div class="form-group">
                            <div class="select-option">
                                <label for="guest">Guests:</label>
                                <select id="guest">
                                    <option value="">3 Adults</option>
                                </select>
                            </div>
                            {{-- <p class="error-message" id="dateError">Please select a date.</p> --}}
                        </div>

                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" id="date" name="date">
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
                    @endif
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
