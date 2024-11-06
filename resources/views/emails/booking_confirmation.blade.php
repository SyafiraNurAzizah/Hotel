<!-- resources/views/emails/booking_confirmation.blade.php -->
<h1>Terima Kasih atas Pemesanan Anda di Berlian Hotel</h1>
<p>Detail pemesanan Anda sebagai berikut:</p>
<p><strong>Nama:</strong> {{ $user->firstname }} {{ $user->lastname }}</p>
<p><strong>Check-In:</strong> {{ \Carbon\Carbon::parse($booking->check_in)->format('d F Y') }}</p>
<p><strong>Check-Out:</strong> {{ \Carbon\Carbon::parse($booking->check_out)->format('d F Y') }}</p>
<p><strong>Total Harga:</strong> Rp{{ number_format($booking->jumlah_harga, 2, ',', '.') }}</p>
<p><strong>Metode Pembayaran:</strong> {{ $pembayaran->metode_pembayaran }}</p>
<p>Semoga Anda memiliki pengalaman yang menyenangkan bersama kami!</p>