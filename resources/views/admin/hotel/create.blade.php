@extends('layouts.app')

@push('styles')
<style>
    /* CSS untuk Tombol Kembali */
    .back-button {
        position: fixed;
        top: 90px;
        left: 40px;
    }

    .btn-back {
        background-color: #dfa974;
        color: white;
        padding: 10px 15px;
        border-radius: 50%;
        text-decoration: none;
        font-size: 20px;
        transition: background-color 0.3s ease;
    }

    .btn-back:hover {
        background-color: #c97a5b;
    }

    /* Gaya Card */
    .card {
        margin-top: 20px;
        padding: 20px 30px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        background-color: #fff;
    }

    .card h2 {
        margin-bottom: 20px;
        color: #333;
        text-align: center;
    }

    /* Gaya Form */
    .form-group {
        margin-bottom: 15px;
    }

    .form-label {
        color: #777;
        font-weight: 500;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ddd;
        border-radius: 5px;
        transition: border-color 0.3s;
    }

    .form-control:focus {
        border-color: #dfa974;
    }

    .btn-submit {
        background-color: #dfa974;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    .btn-submit:hover {
        background-color: #c97a5b;
    }
</style>
@endpush

@section('content')
<br><br><br><br><br>
<div class="back-button">
    <h3><a href="javascript:history.back()" class="btn btn-back">←</a></h3>
</div>
<br><br>
<div class="container">
    <div class="card">
        <h2>Buat Reservasi Baru</h2>
        <form action="{{ route('admin.hotel.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Nama Pengguna</label>
                <select name="user_id" class="form-control" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->lastname }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Jumlah Kamar</label>
                <input type="number" name="jumlah_kamar" class="form-control" required min="1">
            </div>

            <div class="form-group">
                <label class="form-label">Tamu Dewasa</label>
                <input type="number" name="tamu_dewasa" class="form-control" required min="1">
            </div>

            <div class="form-group">
                <label class="form-label">Tamu Anak</label>
                <input type="number" name="tamu_anak" class="form-control" min="0">
            </div>

            <div class="form-group">
                <label class="form-label">Status Pembayaran</label>
                <select name="status_pembayaran" class="form-control" required>
                    <option value="belum_dibayar">Belum Dibayar</option>
                    <option value="dibayar">Dibayar</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Check-In</label>
                <input type="date" name="check_in" class="form-control" required id="check_in">
            </div>

            <div class="form-group">
                <label class="form-label">Check-Out</label>
                <input type="date" name="check_out" class="form-control" required id="check_out">
            </div>

            <div class="form-group">
                <label class="form-label">Hotel</label>
                <select name="hotel_id" class="form-control" required id="hotel_id">
                    @foreach($hotels as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_cabang }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label">Tipe Kamar</label>
                <select name="tipe_kamar_id" class="form-control" required id="tipe_kamar">
                    <option value="" disabled selected>Pilih Tipe Kamar</option>
                    @foreach($roomstype as $item)
                        <option value="{{ $item->id }}" data-hotel-id="{{ $item->hotel_id }}" data-harga="{{ $item->harga_per_malam }}">
                            {{ $item->nama_tipe }} - Rp {{ number_format($item->harga_per_malam, 2, ',', '.') }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            
            
            <div class="form-group">
                <label class="form-label">Harga per Malam (Rp)</label>
                <input type="number" name="harga_per_malam" class="form-control" id="harga_per_malam" readonly>
            </div>
            
            <div class="form-group">
                <label class="form-label">Jumlah Harga (Rp)</label>
                <input type="number" name="jumlah_harga" class="form-control" required min="0" id="jumlah_harga" readonly>
            </div>
            

            <div class="form-group">
                <label class="form-label">Status</label>
                <select name="status" class="form-control" required>
                    <option value="belum_selesai">Belum Selesai</option>
                    <option value="selesai">Selesai</option>
                    <option value="dibatalkan">Dibatalkan</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Pesan (Opsional)</label>
                <textarea name="pesan" class="form-control" rows="3"></textarea>
            </div>

            <div class="form-group text-center">
                <button type="submit" class="btn-submit">Simpan Reservasi</button>
            </div>
        </form>
    </div>
</div>
<br><br><br>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkIn = document.getElementById('check_in');
    const checkOut = document.getElementById('check_out');
    const tipeKamarSelect = document.getElementById('tipe_kamar');
    const hotelSelect = document.getElementById('hotel_id');
    const hargaPerMalamInput = document.getElementById('harga_per_malam');
    const jumlahHargaInput = document.getElementById('jumlah_harga');

    // Fungsi untuk menghitung jumlah hari
    function calculateDays() {
        const checkInDate = new Date(checkIn.value);
        const checkOutDate = new Date(checkOut.value);
        const timeDifference = checkOutDate - checkInDate;
        return timeDifference / (1000 * 3600 * 24); // Menghitung jumlah hari
    }

    // Fungsi untuk menghitung harga total
    function calculateTotalPrice() {
        // Ambil harga per malam berdasarkan tipe kamar yang dipilih
        const selectedOption = tipeKamarSelect.selectedOptions[0]; // Opsi yang dipilih
        const hargaPerMalam = parseFloat(selectedOption.dataset.harga); // Ambil harga dari data-harga
        const jumlahHari = calculateDays(); // Hitung jumlah hari

        // Update harga per malam
        hargaPerMalamInput.value = hargaPerMalam ? hargaPerMalam.toFixed(2) : 0;

        // Hitung jumlah harga
        const totalHarga = hargaPerMalam * jumlahHari;
        jumlahHargaInput.value = totalHarga ? totalHarga.toFixed(2) : 0;
    }

    // Fungsi untuk filter tipe kamar berdasarkan hotel yang dipilih
    function filterTipeKamar() {
        const hotelId = hotelSelect.value;

        // Menyembunyikan semua opsi tipe kamar terlebih dahulu
        for (let option of tipeKamarSelect.options) {
            option.style.display = 'none';
        }

        // Menampilkan tipe kamar yang sesuai dengan hotel yang dipilih
        for (let option of tipeKamarSelect.options) {
            if (option.dataset.hotelId == hotelId) {
                option.style.display = 'block'; // Tampilkan opsi yang sesuai
            }
        }

        // Pilih opsi tipe kamar pertama setelah filter
        if (tipeKamarSelect.options.selectedIndex === 0) {
            tipeKamarSelect.selectedIndex = 1;
        }

        // Hitung harga total ketika hotel atau tipe kamar berubah
        calculateTotalPrice();
    }
    

    // Event listener untuk perubahan hotel dan tipe kamar
    hotelSelect.addEventListener('change', filterTipeKamar);
    tipeKamarSelect.addEventListener('change', calculateTotalPrice);
    checkIn.addEventListener('change', calculateTotalPrice);
    checkOut.addEventListener('change', calculateTotalPrice);

    // Menjalankan filter tipe kamar pertama kali saat halaman dimuat
    filterTipeKamar();
});

</script>
@endpush
@endsection
