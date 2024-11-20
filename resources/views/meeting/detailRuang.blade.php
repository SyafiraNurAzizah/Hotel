@extends('layouts.app')


@push('styles')
<link rel="stylesheet" href="{{ asset('css/detailmeet.css') }}">
@endpush

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

    <div class="back-button"style="z-index: 10;">
        <h3>
            <a href="javascript:history.back()" class="btn btn-back">
                <i class="bi bi-arrow-left"></i>
            </a>
        </h3>
    </div>

    <br><br><br>

    <section class="room-details-section spad" style="position: relative; bottom: 9px; z-index: 5;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="room-details-item">
                        <img src="{{ asset('img/meetings/rooms/' . $room->foto) }}" alt="Room image">
                        <div class="rd-text">
                            <div class="rd-title">
                                <h3>{{ $room->nama_ruang }}</h3>
                                <div class="rdt-right">
                                    {{-- <div class="rating">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star-half_alt"></i>
                                    </div> --}}
                                    {{-- <a href="#">Booking Now</a --}}
                                </div>
                            </div>
                            <h2>Rp{{ number_format($room->harga_per_jam, 2, ',', '.') }}<span>/Jam</span></h2>
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
                
                @if(Auth::check() && Auth::user()->isUser())
                    <div class="col-lg-4">
                        @foreach($hotels as $hotel)
                            <div class="room-booking">
                                {{-- <h3>Your Reservation at {{ $hotel->nama_cabang }} - {{ $room->nama_tipe }}</h3> --}}
                                <h3>Reservasi</h3>
                                <form action="{{ route('booking.meeting.store', ['location' => strtolower($location), 'roomId' => $room->id]) }}" method="POST">                                
                                    @csrf
                    
                                    <div class="hotel-input">
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
                                        <input type="hidden" name="meeting_id" value="{{ $room->id }}">
                                        {{-- <input type="hidden" name="status" value="belum_selesai">
                                        <input type="hidden" name="status_pembayaran" value="belum_dibayar"> --}}
                                    </div>
                    
                                    <div class="check-date">
                                        <label for="date">Tanggal</label>
                                        <input type="text" class="date-input" id="date" name="date">
                                        <i class="bi bi-calendar2-fill"></i>
                                    </div>
                                    <div class="tamu-option" style="margin-bottom: 20px">
                                        <label for="startTime">Jam Mulai</label>
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
                    
                                    <div class="tamu-option" style="margin-bottom: 20px">
                                        <label for="endTime">Jam Selesai</label>
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
                                    <div class="note">
                                        <label for="pesan">Pesan</label>
                                        <textarea type="text" class="pesan" id="pesan" name="pesan"></textarea>
                                        <i class="bi bi-chat-left-text-fill"></i>
                                    </div>
                                    <button type="submit">Reservasi Sekarang</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>


    <div class="overlay" id="errorKetersediaanRuang">
        <div class="bukti">
            <span class="close" id="closeErrorKetersediaanRuangPopup"></span>
            
            <div id="ketersediaanRuang">
                <div class="circle-1">
                    <div class="circle-2">
                        <i class="bi bi-exclamation-circle"></i>
                    </div>
                </div>
                <h1>Ruang Tidak Tersedia</h1>
                <p>Mohon maaf, ruang yang Anda pilih tidak tersedia pada waktu yang Anda tentukan.</p>
            </div>
        </div>
    </div>
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


    document.addEventListener('DOMContentLoaded', function() {
        // Cek apakah session error ada
        @if(session('ruangTersediaError'))
            // Menampilkan popup jika session error ada
            const errorKetersediaanRuangOverlay = document.getElementById('errorKetersediaanRuang');
            errorKetersediaanRuangOverlay.style.display = 'flex';  // Menampilkan overlay

            const closeErrorKetersediaanRuangPopup = document.getElementById('closeErrorKetersediaanRuangPopup');
            
            // Menutup popup jika tombol close diklik
            if (closeErrorKetersediaanRuangPopup) {
                closeErrorKetersediaanRuangPopup.addEventListener('click', function() {
                    errorKetersediaanRuangOverlay.style.display = 'none';  // Menutup overlay
                });
            }

            // Menutup popup jika area luar popup diklik
            errorKetersediaanRuangOverlay.addEventListener('click', function(e) {
                if (e.target === errorKetersediaanRuangOverlay) {
                    errorKetersediaanRuangOverlay.style.display = 'none';  // Menutup overlay
                }
            });
        @endif
    });
</script>
@endpush
