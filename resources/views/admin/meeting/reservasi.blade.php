@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/hotel/admin/create.css') }}">
@endpush


@section('content')
<div class="back-button">
    <h3>
        <a href="javascript:history.back()" class="btn btn-back">
            <i class="bi bi-arrow-left"></i>
        </a>
    </h3>
</div>


<h2>Reservasi Meeting</h2>


<br>


<div class="step">
    <a href="{{ route('admin.meeting.list-tamu') }}">
        <i class="fa-solid fa-users" style="position: relative; top: 80px; left: 210px; color: #222736"></i>
    </a>
    <div class="stepbystep">
        <a href="{{ route('admin.meeting.tamu') }}">
            <i class="fa-solid fa-user" style="position: relative; bottom: 4px; left: 20px; color: #222736"></i>
        </a>
        <div class="garis" style="position: relative; left: 12px; border-color: #222736"></div>
        <a href="{{ route('admin.meeting.reservasi') }}">
            <i class="fa-solid fa-bed" style="padding-right: 60px; position: relative; left: 5px; color: #222736"></i>
        </a>
    </div>
</div>


<br>
<br>
<br>


<div class="container">
    <div class="card">
        <form action="{{ route('admin.meeting.store') }}" method="POST">
            @csrf

            <div class="form-group-user">
                <div class="form-group-group">
                    <label class="form-label">Tamu ID</label>
                    <input type="number" name="tamu_id" id="tamu_id_input" class="form-control" placeholder="Tamu ID" oninput="updateVisitorNameFromInput()" required>
                </div>
                <div class="form-group-group">
                    <label class="form-label">Nama Pengunjung</label>
                    <input type="text" id="visitor_name" class="form-control" readonly placeholder="Masukkan Tamu ID untuk melihat nama" style="background-color: #ffffff; width: 663px;">
                </div>
            </div>

            <div class="form-group-room">
                <div class="form-group-group">
                    <label class="form-label">Hotel</label>
                    <select name="hotel_id" id="hotel_select" class="form-control hotel-select" required onchange="showRoomSelect(this.value)">
                        <option value="" disabled selected>Pilih Hotel</option>
                        @foreach($hotels as $hotel)
                            <option value="{{ $hotel->id }}">{{ $hotel->nama_cabang }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group-group">
                    <label class="form-label">Ruang Meeting</label>
                
                    <input type="text" id="room_select_default" class="form-control room-select" readonly placeholder="Pilih Ruang Meeting" style="width: 663px;">
                    
                    <!-- Select untuk Hotel 1 -->
                    <select name="meeting_id" id="room_select_1" class="form-control room-select" style="display: none; width: 663px;">
                        <option value="" disabled selected>Pilih Ruang Meeting</option>
                        @foreach($meetings as $item)
                            @if($item->hotel_id == 1)
                                <option value="{{ $item->id }}" data-harga="{{ $item->harga_per_jam }}" data-kapasitas="{{ $item->kapasitas }}">{{ $item->nama_ruang }} - Rp {{ number_format($item->harga_per_jam, 2, ',', '.') }}</option>
                            @endif
                        @endforeach
                    </select>
            
                    <!-- Select untuk Hotel 2 -->
                    <select name="meeting_id" id="room_select_2" class="form-control room-select" style="display: none; width: 663px;">
                        <option value="" disabled selected>Pilih Ruang Meeting</option>
                        @foreach($meetings as $item)
                            @if($item->hotel_id == 2)
                            <option value="{{ $item->id }}" data-harga="{{ $item->harga_per_jam }}" data-kapasitas="{{ $item->kapasitas }}">{{ $item->nama_ruang }} - Rp {{ number_format($item->harga_per_jam, 2, ',', '.') }}</option>
                            @endif
                        @endforeach
                    </select>
            
                    <!-- Select untuk Hotel 3 -->
                    <select name="meeting_id" id="room_select_3" class="form-control room-select" style="display: none; width: 663px;">
                        <option value="" disabled selected>Pilih Ruang Meeting</option>
                        @foreach($meetings as $item)
                            @if($item->hotel_id == 3)
                                <option value="{{ $item->id }}" data-harga="{{ $item->harga_per_jam }}" data-kapasitas="{{ $item->kapasitas }}">{{ $item->nama_ruang }} - Rp {{ number_format($item->harga_per_jam, 2, ',', '.') }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- <div class="form-group-angka">
                <div class="form-group-group">
                    <label class="form-label">Jumlah Kamar</label>
                    <input type="number" name="jumlah_kamar" class="form-control" placeholder="Jumlah Kamar" required min="1">
                </div>
                <div class="form-group-group">
                    <label class="form-label">Tamu Dewasa</label>
                    <input type="number" name="tamu_dewasa" class="form-control" placeholder="Dewasa" required min="1" style="width: 316.5px;">
                </div>
                <div class="form-group-group">
                    <label class="form-label">Tamu Anak</label>
                    <input type="number" name="tamu_anak" class="form-control" placeholder="Anak-anak" required min="0" style="width: 316.5px;">
                </div>
            </div> --}}

            <div class="form-group">
                {{-- <div class="form-group-group"> --}}
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="date" class="form-control" required>
                {{-- </div>
                <div class="form-group-group">
                    <label class="form-label">Check Out</label>
                    <input type="date" name="check_out" class="form-control" required>
                </div> --}}
            </div>

            <div class="form-group-tanggal">
                <div class="form-group-group">
                    <label class="form-label">Jam Mulai</label>
                    <input type="time" name="start_time" class="form-control" required onchange="setMinutesToZero(this)">
                </div>
                <div class="form-group-group">
                    <label class="form-label">Jam Selesai</label>
                    <input type="time" name="end_time" class="form-control" required onchange="setMinutesToZero(this)">
                </div>
            </div>

            <div class="form-group-status">
                <div class="form-group-group">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="belum_selesai">Belum Selesai</option>
                        <option value="sedang_diproses">Sedang Diproses</option>
                        <option value="selesai">Selesai</option>
                        <option value="dibatalkan">Dibatalkan</option>
                    </select>
                </div>
                <div class="form-group-group">
                    <label class="form-label">Status Pembayaran</label>
                    <select name="status_pembayaran" class="form-control" required>
                        <option value="belum_dibayar">Belum Dibayar</option>
                        <option value="sudah_dibayar">Sudah Dibayar</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Total Harga (Rp)</label>
                <input type="number" name="jumlah_harga" class="form-control" placeholder="Total Harga" required min="0" id="jumlah_harga" readonly>
            </div>

            <div class="form-group-pembayaran">
                <div class="form-group-group">
                <label class="form-label">Metode Pembayaran</label>
                <select name="metode_pembayaran" class="form-control" required>
                    <option value="Cash">Tunai</option>
                    <option value="Kartu Kredit/Debit">Kartu Kredit/Debit</option>
                    <option value="DANA">DANA</option>
                    <option value="OVO">OVO</option>
                </select>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Pesan (Opsional)</label>
                <textarea name="pesan" class="form-control" rows="3" placeholder="Masukkan pesan" style="height: 150px;"></textarea>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>


<div class="overlay" id="errorKetersediaanKamar">
    <div class="bukti">
        <span class="close" id="closeErrorKetersediaanKamarPopup"></span>
        
        <div id="ketersediaanKamar">
            <div class="circle-1">
                <div class="circle-2">
                    <i class="bi bi-exclamation-circle"></i>
                </div>
            </div>
            <h1>Kamar Tidak Tersedia</h1>
            <p>Mohon maaf, kamar yang Anda pilih tidak tersedia untuk tanggal ini.</p>
        </div>
    </div>
</div>
@endsection



@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>


<script>
const tamu = @json($tamu); // Mengambil data tamu dari server

function updateVisitorNameFromInput() {
    const userIdInput = document.getElementById('tamu_id_input').value;
    const visitorNameInput = document.getElementById('visitor_name');

    // Cek apakah input kosong
    if (userIdInput === '') {
        visitorNameInput.value = ''; // Kosongkan input nama pengunjung
        visitorNameInput.placeholder = "Masukkan Tamu ID untuk melihat nama"; // Reset placeholder
        visitorNameInput.classList.remove('error-placeholder'); // Hapus kelas error
        return; // Keluar dari fungsi
    }

    // Mencari tamu berdasarkan ID
    const visitor = tamu.find(tamu => tamu.id == userIdInput);

    if (visitor) {
        // Jika tamu ditemukan, tampilkan nama lengkap
        visitorNameInput.value = `${visitor.nama}`; // Gantilah sesuai dengan kolom nama di tabel tamu
        visitorNameInput.placeholder = "Masukkan Tamu ID untuk melihat nama"; // Reset placeholder
        visitorNameInput.classList.remove('error-placeholder'); // Hapus kelas error
    } else {
        // Jika tidak ditemukan, tampilkan pesan kesalahan di placeholder
        visitorNameInput.value = '';
        visitorNameInput.placeholder = 'Tamu dengan ID tersebut belum tersedia';
        visitorNameInput.classList.add('error-placeholder'); // Tambahkan kelas error
    }
};



function showRoomSelect(hotelId) {
    // Sembunyikan semua select tipe kamar
    var allSelects = document.getElementsByClassName('room-select');
    for(var i = 0; i < allSelects.length; i++) {
        allSelects[i].style.display = 'none';
    }
    
    // Tampilkan select yang sesuai
    if(hotelId) {
        document.getElementById('room_select_' + hotelId).style.display = 'block';
        document.getElementById('room_select_default').style.display = 'none';
    } else {
        document.getElementById('room_select_default').style.display = 'block';
    }
}

// Jalankan saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    // Tampilkan select default
    document.getElementById('room_select_default').style.display = 'block';
    
    // Sembunyikan select lainnya
    var allSelects = document.getElementsByClassName('room-select');
    for(var i = 0; i < allSelects.length; i++) {
        if(allSelects[i].id !== 'room_select_default') {
            allSelects[i].style.display = 'none';
        }
    }
});


function setMinutesToZero(input) {
    const timeValue = input.value;
    const [hours] = timeValue.split(':');
    input.value = `${hours}:00`;
    calculateTotalPrice();
}


function calculateTotalPrice() {
    const startTime = document.querySelector('input[name="start_time"]').value;
    const endTime = document.querySelector('input[name="end_time"]').value;
    const roomSelects = document.getElementsByClassName('room-select'); // Ambil semua select
    let selectedRoom = null;

    // Temukan select yang terlihat
    for (let i = 0; i < roomSelects.length; i++) {
        if (roomSelects[i].style.display === 'block') {
            selectedRoom = roomSelects[i];
            break;
        }
    }

    if (startTime && endTime && selectedRoom) {
        const selectedOption = selectedRoom.options[selectedRoom.selectedIndex];
        const hargaPerJam = selectedOption.dataset.harga;

        if (hargaPerJam) {
            const start = new Date(`1970-01-01T${startTime}:00`);
            const end = new Date(`1970-01-01T${endTime}:00`);

            // Hitung selisih waktu dalam jam
            const hoursDiff = (end - start) / (1000 * 60 * 60);

            if (hoursDiff > 0) {
                const totalPrice = hoursDiff * parseFloat(hargaPerJam);
                document.getElementById('jumlah_harga').value = totalPrice.toFixed(2); // Set total harga
            } else {
                document.getElementById('jumlah_harga').value = 0; // Reset jika waktu tidak valid
            }
        }
    }
}

// Pasang event listener untuk waktu mulai dan selesai
document.querySelector('input[name="start_time"]').addEventListener('change', calculateTotalPrice);
document.querySelector('input[name="end_time"]').addEventListener('change', calculateTotalPrice);

// Pasang event listener untuk perubahan ruang meeting
document.querySelectorAll('.room-select').forEach(select => {
    select.addEventListener('change', calculateTotalPrice);
});






document.addEventListener('DOMContentLoaded', function() {
    // Cek apakah session error ada
    @if(session('kamarTersediaError'))
        // Menampilkan popup jika session error ada
        const errorKetersediaanKamarOverlay = document.getElementById('errorKetersediaanKamar');
        errorKetersediaanKamarOverlay.style.display = 'flex';  // Menampilkan overlay

        const closeErrorKetersediaanKamarPopup = document.getElementById('closeErrorKetersediaanKamarPopup');
        
        // Menutup popup jika tombol close diklik
        if (closeErrorKetersediaanKamarPopup) {
            closeErrorKetersediaanKamarPopup.addEventListener('click', function() {
                errorKetersediaanKamarOverlay.style.display = 'none';  // Menutup overlay
            });
        }

        // Menutup popup jika area luar popup diklik
        errorKetersediaanKamarOverlay.addEventListener('click', function(e) {
            if (e.target === errorKetersediaanKamarOverlay) {
                errorKetersediaanKamarOverlay.style.display = 'none';  // Menutup overlay
            }
        });
    @endif
});



</script>
@endpush
