<title>Berlian Hotel</title>
<link rel="icon" href="{{ asset('img/logo-title.png') }}" type="image/png">

{{-- ------------------------------------------------------------------------------------------------------- --}}


<link rel="stylesheet" href="{{ asset('css/pembayaran.css') }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">


{{-- @foreach ($hotels as $hotel)
    <div class="previous">
        <a href="{{ route('hotel.transaksi.transaksi-hotel', ['location' => strtolower($hotel->nama_cabang), 'nama_tipe' => $room->nama_tipe, 'uuid' => $booking->uuid]) }}"><i class="bi bi-arrow-left"></i></a>
    </div>
@endforeach --}}


{{-- <div class="page">
    @foreach ($hotels as $hotel)
        <p>Lokasi Hotel</p>
        <p>Informasi Booking</p>
        <p class="active">Informasi Pembayaran</p>    
    @endforeach
</div>

<div class="horizontal-line-1"></div> --}}


<div class="container">
    <div class="container-card">
        @if ($pembayaran->metode_pembayaran == 'DANA')
            <div class="card-dana">
                {{-- <h6>Detail Pembayaran</h6> --}}
                <img src="{{ asset('img/hotels/metode_pembayaran/DANA.png') }}" alt="DANA">
                <p>Nomor Telepon</p>
                <h3>0881 2721 410</h3>
                <h5>BERLIAN HOTEL</h5>
            </div>
        @elseif ($pembayaran->metode_pembayaran == 'OVO')
            <div class="card-ovo">
                {{-- <h6>Detail Pembayaran</h6> --}}
                <img src="{{ asset('img/hotels/metode_pembayaran/OVO.png') }}" alt="OVO">
                <p>Nomor Telepon</p>
                <h3>0881 2721 410</h3>
                <h5>BERLIAN HOTEL</h5>
            </div>
        @elseif ($pembayaran->metode_pembayaran == 'BCA')
            <div class="card-bca">
                {{-- <h6>Detail Pembayaran</h6> --}}
                <img src="{{ asset('img/hotels/metode_pembayaran/BCA.png') }}" alt="BCA">
                <p>Nomor Rekening</p>
                <h3>0923 1263 74</h3>
                <h5>BERLIAN HOTEL</h5>    
            </div>
        @elseif ($pembayaran->metode_pembayaran == 'BRI')
        <div class="card-bri">
            {{-- <h6>Detail Pembayaran</h6> --}}
            <img src="{{ asset('img/hotels/metode_pembayaran/BRI.png') }}" alt="BRI">
            <p>Nomor Rekening</p>
            <h3>1293 9730 4763 588</h3>
            <h5>BERLIAN HOTEL</h5>    
        </div>
        @elseif ($pembayaran->metode_pembayaran == 'BNI')
        <div class="card-bni">
            {{-- <h6>Detail Pembayaran</h6> --}}
            <img src="{{ asset('img/hotels/metode_pembayaran/BNI.png') }}" alt="BNI">
            <p>Nomor Rekening</p>
            <h3>0836 2197 45</h3>
            <h5>BERLIAN HOTEL</h5>    
        </div>
        @elseif ($pembayaran->metode_pembayaran == 'Mandiri')
        <div class="card-mandiri">
            {{-- <h6>Detail Pembayaran</h6> --}}
            <img src="{{ asset('img/hotels/metode_pembayaran/Mandiri.png') }}" alt="Mandiri">
            <p>Nomor Rekening</p>
            <h3>2836 0128 3574</h3>
            <h5>BERLIAN HOTEL</h5>    
        </div>
        @endif
    </div>
    

    <div class="container-right">
        {{-- <p>Terima kasih telah memilih Berlian Hotel! Kami tunggu konfirmasi pembayaran Anda.</p> --}}

        @foreach ($hotels as $hotel)
            @if ($pembayaran->metode_pembayaran == 'Cash' || $pembayaran->metode_pembayaran == 'Kartu Kredit/Debit')
                <div class="cardnt">
                    <h2>Terima kasih telah memilih Berlian Hotel!</h2>
                    <p class="p-1">Harap bawa bukti reservasi Anda untuk memudahkan proses pembayaran.</p>
                    <p class="p-2">Jika Anda memiliki pertanyaan, silakan hubungi kami di nomor <strong>{{ substr($hotel->no_telp, 0, 4) . '-' . substr($hotel->no_telp, 4, 4) . '-' . substr($hotel->no_telp, 8) }}</strong>.</p>
                    {{-- <div class="total-harga">
                        <h3>Total</h3>
                        <h1>Rp{{ number_format($booking->jumlah_harga, 2, ',', '.') }}</h1>
                    </div> --}}
                </div>
            @endif
        @endforeach


        @if ($pembayaran->metode_pembayaran == 'DANA' || $pembayaran->metode_pembayaran == 'OVO')
            <p>Lakukan pembayaran ke nomor telepon yang tertera.</p>
            <p style="top: 270px; line-height: 20px; width: 380px;">Unggah bukti transfer Anda di formulir bawah ini. Verifikasi akan dilakukan dalam 1x24 jam.</p>
        @elseif ($pembayaran->metode_pembayaran == 'BCA' || $pembayaran->metode_pembayaran == 'BRI' || $pembayaran->metode_pembayaran == 'BNI' || $pembayaran->metode_pembayaran == 'Mandiri')
            <p>Lakukan pembayaran ke nomor rekening yang tertera.</p>
            <p style="top: 270px; line-height: 20px; width: 380px;">Unggah bukti transfer Anda di formulir bawah ini. Verifikasi akan dilakukan dalam 1x24 jam.</p>
        @endif


        @if ($pembayaran->metode_pembayaran == 'DANA' || $pembayaran->metode_pembayaran == 'OVO' || $pembayaran->metode_pembayaran == 'BCA' || $pembayaran->metode_pembayaran == 'BRI' || $pembayaran->metode_pembayaran == 'BNI' || $pembayaran->metode_pembayaran == 'Mandiri')
            {{-- <h2>Detail Pembayaran - <a>{{ $pembayaran->metode_pembayaran }}</a></h2> --}}
            <h2>Detail Pembayaran</h2>
            <p style="margin-bottom: 60px;">Terima kasih telah memilih Berlian Hotel!</p>

            <div class="total-harga">
                <p>Total pembayaran</p>
                <h2>Rp{{ number_format($booking->jumlah_harga, 2, ',', '.') }}</h2>
            </div>
        @endif


    </div>

    @if ($pembayaran->metode_pembayaran == 'DANA' || $pembayaran->metode_pembayaran == 'OVO' || $pembayaran->metode_pembayaran == 'BCA' || $pembayaran->metode_pembayaran == 'BRI' || $pembayaran->metode_pembayaran == 'BNI' || $pembayaran->metode_pembayaran == 'Mandiri')
        <div class="popup-bukti-pembayaran">
            @if ($pembayaran->bukti_pembayaran != null)
                <a href="#" id="openBuktiPopup">
                    {{-- <i class="fa fa-bookmark"></i> --}}
                    <p>Bukti Pembayaran</p>
                </a>
            @else
                <a href="#" id="openFormBuktiPopup">
                    {{-- <i class="fa fa-user guest"></i> --}}
                    <p>Unggah Bukti Pembayaran</p>
                </a>
            @endif
        </div>
    @endif


    @if ($pembayaran->metode_pembayaran == 'DANA' || $pembayaran->metode_pembayaran == 'OVO' || $pembayaran->metode_pembayaran == 'BCA' || $pembayaran->metode_pembayaran == 'BRI' || $pembayaran->metode_pembayaran == 'BNI' || $pembayaran->metode_pembayaran == 'Mandiri')
        <div class="overlay" id="formBuktiOverlay">
            <div class="bukti-form">
                <span class="close" id="closeFormBuktiPopup"></span>

                @foreach ($hotels as $hotel)
                    <div class="bukti-pembayaran">
                        <p>Bukti Pembayaran</p>
                        <form action="{{ route('booking.hotel.pembayaran.update', ['location' => strtolower($hotel->nama_cabang), 'nama_tipe' => $room->nama_tipe, 'uuid' => $booking->uuid]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                
                            <input type="hidden" name="booking_hotel_id" value="{{ $booking->id }}">
                            <input type="hidden" name="metode_pembayaran" value="{{ $pembayaran->metode_pembayaran }}">
            
                            <div class="file-preview-container">
                                <input type="file" id="file-input" name="bukti_pembayaran" accept="image/*" required>
                                <label for="file-input" class="file-label"><i class="fa-solid fa-image"></i></label>
                                <div class="preview-container" id="preview-container">
                                    <img id="preview-image" alt="Preview Gambar" />
                                </div>
                            </div>

                            <button type="submit" class="button-pembayaran">Unggah Bukti Pembayaran</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>


        <div class="overlay" id="buktiOverlay">
            <div class="bukti">
                <span class="close" id="closeBuktiPopup"></span>

                <div class="bukti-pembayaran">
                    <p>Bukti Pembayaran</p>
                    <img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="bukti-pembayaran-image">
                </div>
            </div>
        </div>
    @endif
</div>








<script>
    document.addEventListener("DOMContentLoaded", function() {
    // Fungsi untuk preview gambar setelah dipilih
    document.getElementById('file-input').addEventListener('change', function(event) {
        const fileInput = event.target;
        const previewContainer = document.getElementById('preview-container');
        const previewImage = document.getElementById('preview-image');
        const fileLabel = document.querySelector('.file-label');

        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.style.display = 'block';
                fileLabel.style.display = 'none'; // Sembunyikan label setelah preview muncul
            };
            reader.readAsDataURL(fileInput.files[0]);
        }

        // Klik pada preview untuk mengubah gambar kembali
        previewImage.addEventListener('click', function() {
            fileInput.click(); // Membuka input file saat gambar preview diklik
        });
    });

    // Element-elemen overlay dan tombol pop-up
    const formBuktiOverlay = document.getElementById('formBuktiOverlay');
    const openFormBuktiPopup = document.getElementById('openFormBuktiPopup');
    const closeFormBuktiPopup = document.getElementById('closeFormBuktiPopup');

    const buktiOverlay = document.getElementById('buktiOverlay');
    const openBuktiPopup = document.getElementById('openBuktiPopup');
    const closeBuktiPopup = document.getElementById('closeBuktiPopup');

    // Buka form bukti pembayaran jika tombol openFormBuktiPopup diklik
    if (openFormBuktiPopup) {
        openFormBuktiPopup.addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah action default dari link
            formBuktiOverlay.style.display = 'flex';
            buktiOverlay.style.display = 'none';
        });
    }

    // Tutup form bukti pembayaran jika tombol closeFormBuktiPopup diklik
    if (closeFormBuktiPopup) {
        closeFormBuktiPopup.addEventListener('click', function() {
            formBuktiOverlay.style.display = 'none';
        });
    }

    // Tutup form bukti pembayaran jika area di luar form diklik
    if (formBuktiOverlay) {
        formBuktiOverlay.addEventListener('click', function(e) {
            if (e.target === formBuktiOverlay) {
                formBuktiOverlay.style.display = 'none';
            }
        });
    }

    // Buka tampilan bukti pembayaran jika tombol openBuktiPopup diklik
    if (openBuktiPopup) {
        openBuktiPopup.addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah action default dari link
            buktiOverlay.style.display = 'flex';
            formBuktiOverlay.style.display = 'none';
        });
    }

    // Tutup tampilan bukti pembayaran jika tombol closeBuktiPopup diklik
    if (closeBuktiPopup) {
        closeBuktiPopup.addEventListener('click', function() {
            buktiOverlay.style.display = 'none';
        });
    }

    // Tutup tampilan bukti pembayaran jika area di luar tampilan diklik
    if (buktiOverlay) {
        buktiOverlay.addEventListener('click', function(e) {
            if (e.target === buktiOverlay) {
                buktiOverlay.style.display = 'none';
            }
        });
    }
});

</script>