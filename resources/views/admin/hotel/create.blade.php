@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/hotel/admin/create.css') }}">
@endpush


@section('content')
<div class="back-button">
    <h3><a href="javascript:history.back()" class="btn btn-back">←</a></h3>
</div>


<h2>Reservasi Hotel</h2>


<br>


<div class="step">
    <a href="{{ route('admin.hotel.list-tamu') }}">
        <i class="fa-solid fa-users" style="position: relative; top: 80px; left: 210px; color: #222736"></i>
    </a>
    <div class="stepbystep">
        <a href="{{ route('admin.hotel.tamu') }}">
            <i class="fa-solid fa-user" style="position: relative; bottom: 4px; left: 20px; color: #222736"></i>
        </a>
        <div class="garis" style="position: relative; left: 12px; border-color: #222736"></div>
        <a href="{{ route('admin.hotel.create') }}">
            <i class="fa-solid fa-bed" style="padding-right: 60px; position: relative; left: 5px; color: #222736"></i>
        </a>
    </div>
</div>


<br>
<br>
<br>


<div class="container">
    <div class="card">
        <form action="{{ route('admin.hotel.store') }}" method="POST">
            @csrf

            <div class="form-group-user">
                <div class="form-group-group">
                    <label class="form-label">User  ID</label>
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
                    <label class="form-label">Tipe Kamar</label>
                
                    <input type="text" id="room_select_default" class="form-control room-select" readonly placeholder="Pilih Tipe Kamar" style="width: 663px;">
                    
                    <!-- Select untuk Hotel 1 -->
                    <select name="tipe_kamar_id" id="room_select_1" class="form-control room-select" style="display: none; width: 663px;">
                        <option value="" disabled selected>Pilih Tipe Kamar</option>
                        @foreach($room as $item)
                            @if($item->hotel_id == 1)
                                <option value="{{ $item->id }}" data-harga="{{ $item->harga_per_malam }}" data-kapasitas="{{ $item->kapasitas }}">{{ $item->nama_tipe }} - Rp {{ number_format($item->harga_per_malam, 2, ',', '.') }}</option>
                            @endif
                        @endforeach
                    </select>
            
                    <!-- Select untuk Hotel 2 -->
                    <select name="tipe_kamar_id" id="room_select_2" class="form-control room-select" style="display: none; width: 663px;">
                        <option value="" disabled selected>Pilih Tipe Kamar</option>
                        @foreach($room as $item)
                            @if($item->hotel_id == 2)
                                <option value="{{ $item->id }}" data-harga="{{ $item->harga_per_malam }}" data-kapasitas="{{ $item->kapasitas }}">{{ $item->nama_tipe }} - Rp {{ number_format($item->harga_per_malam, 2, ',', '.') }}</option>
                            @endif
                        @endforeach
                    </select>
            
                    <!-- Select untuk Hotel 3 -->
                    <select name="tipe_kamar_id" id="room_select_3" class="form-control room-select" style="display: none; width: 663px;">
                        <option value="" disabled selected>Pilih Tipe Kamar</option>
                        @foreach($room as $item)
                            @if($item->hotel_id == 3)
                                <option value="{{ $item->id }}" data-harga="{{ $item->harga_per_malam }}" data-kapasitas="{{ $item->kapasitas }}">{{ $item->nama_tipe }} - Rp {{ number_format($item->harga_per_malam, 2, ',', '.') }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group-angka">
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
            </div>

            <div class="form-group-tanggal">
                <div class="form-group-group">
                    <label class="form-label">Check In</label>
                    <input type="date" name="check_in" class="form-control" required>
                </div>
                <div class="form-group-group">
                    <label class="form-label">Check Out</label>
                    <input type="date" name="check_out" class="form-control" required>
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


function calculateTotalPrice() {
    const roomSelect = document.querySelector('select[name="tipe_kamar_id"]:not([style*="display: none"])'); // Ambil select yang terlihat
    const jumlahKamar = parseInt(document.querySelector('input[name="jumlah_kamar"]').value) || 0; // Ambil jumlah kamar
    const checkInDate = new Date(document.querySelector('input[name="check_in"]').value);
    const checkOutDate = new Date(document.querySelector('input[name="check_out"]').value);
    
    // Hitung jumlah malam
    const timeDifference = checkOutDate - checkInDate;
    const jumlahMalam = Math.ceil(timeDifference / (1000 * 3600 * 24)); // Menghitung jumlah malam

    if (roomSelect && roomSelect.selectedIndex > 0) { // Pastikan ada tipe kamar yang dipilih
        const hargaPerMalam = parseFloat(roomSelect.options[roomSelect.selectedIndex].getAttribute('data-harga'));
        const totalHarga = hargaPerMalam * jumlahKamar * jumlahMalam; // Hitung total harga

        // Update total harga di input
        document.getElementById('jumlah_harga').value = totalHarga.toFixed(2); // Tampilkan dengan 2 desimal
    } else {
        document.getElementById('jumlah_harga').value = 0; // Reset jika tidak ada kamar yang dipilih
    }
}

// Panggil fungsi calculateTotalPrice ketika ada perubahan
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

    // Tambahkan event listener untuk menghitung total harga
    document.querySelector('select[name="tipe_kamar_id"]').addEventListener('change', calculateTotalPrice);
    document.querySelector('input[name="jumlah_kamar"]').addEventListener('input', calculateTotalPrice);
    document.querySelector('input[name="check_in"]').addEventListener('change', calculateTotalPrice); // Tambahkan event listener untuk check in
    document.querySelector('input[name="check_out"]').addEventListener('change', calculateTotalPrice); // Tambahkan event listener untuk check out
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
