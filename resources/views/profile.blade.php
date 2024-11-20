@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">

{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
@endpush

@section('content')

<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    @if (isset($profile) && $profile->foto)
                        <img src="{{ asset('storage/' . $profile->foto) }}" alt="Foto Profil" class="profile-image">
                    @else
                        <img src="{{ asset('img/profile-default.jpg') }}" alt="Foto Profil" class="profile-image">
                    @endif
                    
                    <h2>{{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}</h2>
                    <div class="bt-option">
                        <span>{{ Auth::user()->email }}</span>
                    </div>
                    <div class="bt-option">
                        <!-- Tombol untuk menampilkan popup profil -->
                        <button type="button" class="viewProfileButton" data-bs-toggle="modal" data-bs-target="#viewModal">Profil</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form action="{{ route('updateProfile', ['id' => Auth::user()->id, 'firstname' => Auth::user()->firstname, 'lastname' => Auth::user()->lastname]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-left">
                    <div class="form-group-img">
                        @if (isset($profile) && $profile->foto)
                            <img src="{{ asset('storage/' . $profile->foto) }}" alt="Foto Profil" class="profile-image">
                        @endif

                        <input type="file" name="foto" id="foto" class="form-control">
                    </div>
                    <div class="form-group-label">
                        <label for="foto" class="file-label"><i class="fa-solid fa-image"></i></label>
                        <div class="preview-container" id="preview-container" style="display: none;"> <!-- Sembunyikan container preview secara default -->
                            <img id="preview-image" alt="Preview Gambar" />
                        </div>
                    </div>

                    {{-- <div class="form-group" style="display: flex; width: 300px; position: relative; bottom: 150px; left: 30px;">
                        <div class="group-name">
                            <input type="text" name="firstname" id="firstname" class="form-control" value="{{ Auth::user()->firstname }}" required style="text-align: right; font-size: 22px; font-weight: 500; letter-spacing: 1px; border: none;">
                        </div>
                        <div class="group-name">
                            <input type="text" name="lastname" id="lastname" class="form-control" value="{{ Auth::user()->lastname }}" required style="text-align: left; font-size: 22px; font-weight: 500; letter-spacing: 1px; border: none;">
                        </div>
                    </div> --}}

                    
                    {{-- <div class="form-group" style="display: flex; gap: 10px;">
                        <div class="group-name">
                            <label for="firstname">Nama Depan</label>
                            <input type="text" name="firstname" id="firstname" class="form-control" value="{{ Auth::user()->firstname }}" required>
                        </div>
                        <div class="group-name">
                            <label for="lastname">Nama Belakang</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" value="{{ Auth::user()->lastname }}" required>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ Auth::user()->email }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="no_telp">Nomor Telepon</label>
                        <input type="text" name="no_telp" id="no_telp" class="form-control" value="{{ Auth::user()->no_telp }}">
                    </div> --}}
                </div>
                
                <div class="form-right">
                    <div class="form-group">
                        <label for="firstname">Nama Depan</label>
                        <input type="text" name="firstname" id="firstname" class="form-control" value="{{ Auth::user()->firstname }}" required>
                    </div>

                    <div class="form-group">
                        <label for="lastname">Nama Belakang</label>
                        <input type="text" name="lastname" id="lastname" class="form-control" value="{{ Auth::user()->lastname }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email" style="position: relative; top: 10px;">Email</label>
                        <p id="email" class="form-control" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">{{ Auth::user()->email }}</p>
                    </div>

                    <div class="form-group">
                        <label for="no_telp">Nomor Telepon</label>
                        <input type="text" name="no_telp" id="no_telp" class="form-control" value="{{ Auth::user()->no_telp }}">
                    </div>

                    <div class="form-group">
                        <label for="alamat" style="position: relative; top: 10px;">Alamat</label>
                        <input type="text" name="alamat" id="alamat" class=" form-control" value="{{ $profile->alamat ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{ $profile->tanggal_lahir ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <input type="text" name="jenis_kelamin" id="jenis_kelamin" class="form-control" value="{{ $profile->jenis_kelamin ?? '' }}">
                    </div>
                </div>
                

                <button type="submit" class="btn btn-primary">Edit Profil</button>
            </form>








            {{-- <p class="profile">Informasi yang Anda berikan akan digunakan untuk verifikasi akun, memastikan keamanan, serta memberikan layanan yang lebih sesuai dengan kebutuhan Anda.</p>

            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <i class="bi bi-x"></i>
            </button>

            <button type="button" class="viewProfileButton profile-button" data-bs-toggle="modal" data-bs-target="#viewProfileModal">Profil</button> --}}
        </div>
    </div>
</div>


{{-- <div class="modal fade" id="viewProfileModal" tabindex="-1" aria-labelledby="viewProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <p class="profile-title">Profil</p>
            
            <div class="button-profile">
                <button type="button" class="btn-close" data-bs-toggle="modal" data-bs-target="#viewModal">
                    <i class="bi bi-arrow-left"></i>
                </button>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x"></i>
                </button>
            </div>

            <div class="modal-body">
                <div class="profile-part">
                    <p>{{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}</p>
                    <div class="bottom-line"></div>
                </div>
                <div class="profile-part">
                    <p>{{ Auth::user()->email }}</p>
                    <div class="bottom-line"></div>
                </div>
                <div class="profile-part">
                    <p>{{ Auth::user()->no_telp }}</p>
                    <div class="bottom-line"></div>
                </div>
                <div class="profile-part">
                    <p>{{ $userProfile->jenis_kelamin }}</p>
                    <div class="bottom-line"></div>
                </div>
                <div class="profile-part">
                    <p>{{ $userProfile->tanggal_lahir }}</p>
                    <div class="bottom-line"></div>
                </div>
                <div class="profile-part">
                    <p class="profile-alamat">{{ $userProfile->alamat }}</p>
                    <div class="bottom-line-alamat"></div>
                </div>
                
            </div>

            <button type="button" class="viewEditProfileButton profile-button" data-bs-toggle="modal" data-bs-target="#viewEditProfileModal">Edit Profil</button>
        </div>
    </div>
</div> --}}


{{-- <div class="modal fade" id="viewEditProfileModal" tabindex="-1" aria-labelledby="viewEditProfileModalLabel" aria-hidden="true"> --}}
    {{-- <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewEditProfileModalLabel">Edit Profil Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('profile.update') }}" method="POST">
                <form action="#" method="POST">
                    @csrf
                    @method('PUT')  <!-- Menggunakan metode PUT untuk mengupdate data profil -->
                    <div class="form-group">
                        <label for="firstname">Nama Depan</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" value="{{ Auth::user()->firstname }}" required>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Nama Belakang</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" value="{{ Auth::user()->lastname }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="{{ Auth::user()->alamat }}" required>
                    </div>
                    <div class="form-group">
                        <label for="no_telp">Nomor Telepon</label>
                        <input type="text" class="form-control" id="no_telp" name="no_telp" value="{{ Auth::user()->no_telp }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div> --}}



    {{-- <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <p class="profile-title">Edit Profil</p>

            <div class="button-profile">
                <button type="button" class="btn-close" data-bs-toggle="modal" data-bs-target="#viewProfileModal">
                    <i class="bi bi-arrow-left"></i>
                </button>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x"></i>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname', $user->firstname) }}" required autocomplete="firstname" placeholder="Nama Depan">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname', $user->lastname) }}" required autocomplete="lastname" placeholder="Nama Belakang">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" id="loginEmail" name="email" value="{{ old('email', Auth::user()->email) }}" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="phone" name="no_telp" value="{{ old('no_telp', Auth::user()->no_telp) }}" placeholder="Nomor Telepon" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="gender" name="jenis_kelamin" value="{{ old('jenis_kelamin', $userProfile->jenis_kelamin) }}" placeholder="Jenis Kelamin" required>
                </div>
                <div class="form-group">
                    <input type="date" class="form-control" id="dob" name="tanggal_lahir" value="{{ old('tanggal_lahir', $userProfile->tanggal_lahir) }}" placeholder="Tanggal Lahir" required>
                </div>
                <div class="profile-part">
                    <p class="profile-alamat">{{ $userProfile->alamat }}</p>
                    <div class="bottom-line-alamat"></div>
                </div>
            </div>

            <button type="submit" class="profile-button">Simpan</button>
        </div>
    </div>
</div> --}}



<div class="icon-table">
    <i class="fa-solid fa-bed active" onclick="showTable('table-bed', this)" style="margin-right: 20px"></i>
    <div class="vertical-line"></div>
    <i class="fa-solid fa-users" onclick="showTable('table-users', this)"></i>
</div>


<div class="horizontal-line"></div>

<div class="container">
    <div id="table-bed" class="table-container" style="display: block;">
        <table class="table table-custom">
            <thead class="thead-custom">
                <tr>
                    <th>id</th>
                    <th>Hotel</th>
                    <th>Tipe Kamar</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $item)
                    <tr onclick="window.location='{{ route('hotel.transaksi.transaksi-hotel', ['location' => strtolower($item->hotel->nama_cabang), 'nama_tipe' => $item->tipe_kamar->nama_tipe, 'uuid' => $item->uuid]) }}'" style="cursor: pointer;">
                        <td><strong>#{{ substr($item->uuid, 0, 5) }}</strong></td>
                        <td>{{ $item->hotel->nama_cabang }}</td>
                        <td>{{ $item->tipe_kamar->nama_tipe }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->check_in)->format('d F Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->check_out)->format('d F Y') }}</td>
                        <td>
                            @if ($item->status == 'selesai')
                                {{-- {{ ucwords(str_replace('_', ' ', $item->status)) }} --}}
                                
                                <span style="background: #E9F1FE; color: #1967D3; padding: 5px 15px; border-radius: 5px;">
                                    {{ ucwords(str_replace('_', ' ', $item->status)) }}
                                </span>
                            @elseif($item->status == 'belum_selesai')
                                {{-- {{ ucwords(str_replace('_', ' ', $item->status)) }} --}}

                                <span style="background: #FDF6E4; color: #B06001; padding: 5px 15px; border-radius: 5px;">
                                    {{ ucwords(str_replace('_', ' ', $item->status)) }}
                                </span>
                            @elseif($item->status == 'sedang_diproses')
                                {{-- {{ ucwords(str_replace('_', ' ', $item->status)) }} --}}

                                <span style="background: #E7F2EA; color: #137333; padding: 5px 15px; border-radius: 5px;">
                                    {{ ucwords(str_replace('_', ' ', $item->status)) }}
                                </span>
                            @elseif($item->status == 'dibatalkan')
                                {{-- {{ ucwords(str_replace('_', ' ', $item->status)) }} --}}
                            
                                <span style="background: #FCEAEA; color: #C5211F; padding: 5px 15px; border-radius: 5px;">
                                    {{ ucwords(str_replace('_', ' ', $item->status)) }}
                                </span>
                            @else
                                <span>{{ ucwords(str_replace('_', ' ', $item->status)) }}</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="no-data">No data available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="container">
    <div id="table-users" class="table-container" style="display: none;">
        <table class="table table-custom">
            <thead class="thead-custom">
                <tr>
                    <th>id</th>
                    <th>Hotel</th>
                    <th>Tanggal</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings_meetings as $item)
                {{-- <tr onclick="window.location='{{ route('meeting.transaksi.transaksi-meeting', ['location' => strtolower($item->hotel->nama_cabang), 'roomId' => $item->meeting_id, 'uuid' => $item->uuid]) }}'" style="cursor: pointer;"> --}}
                <tr>
                    <td><strong>#{{ substr($item->uuid, 0, 5) }}</strong></td>
                        <td>{{ $item->hotel->nama_cabang }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->date)->format('d F Y') }}</td>
                        <td>{{ $item->start_time }}</td>
                        <td>{{ $item->end_time }}</td>
                        <td>
                            @if ($item->status == 'selesai')
                                {{-- {{ ucwords(str_replace('_', ' ', $item->status)) }} --}}
                                
                                <span style="background: #E9F1FE; color: #1967D3; padding: 5px 15px; border-radius: 5px;">
                                    {{ ucwords(str_replace('_', ' ', $item->status)) }}
                                </span>
                            @elseif($item->status == 'belum_selesai')
                                {{-- {{ ucwords(str_replace('_', ' ', $item->status)) }} --}}

                                <span style="background: #FDF6E4; color: #B06001; padding: 5px 15px; border-radius: 5px;">
                                    {{ ucwords(str_replace('_', ' ', $item->status)) }}
                                </span>
                            @elseif($item->status == 'sedang_diproses')
                                {{-- {{ ucwords(str_replace('_', ' ', $item->status)) }} --}}

                                <span style="background: #E7F2EA; color: #137333; padding: 5px 15px; border-radius: 5px;">
                                    {{ ucwords(str_replace('_', ' ', $item->status)) }}
                                </span>
                            @elseif($item->status == 'dibatalkan')
                                {{-- {{ ucwords(str_replace('_', ' ', $item->status)) }} --}}
                            
                                <span style="background: #FCEAEA; color: #C5211F; padding: 5px 15px; border-radius: 5px;">
                                    {{ ucwords(str_replace('_', ' ', $item->status)) }}
                                </span>
                            @else
                                <span>{{ ucwords(str_replace('_', ' ', $item->status)) }}</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="no-data">No data available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>



@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('foto').addEventListener('change', function(event) {
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
    });


    function showTable(tableId, clickedIcon) {
        // Sembunyikan semua tabel
        const tables = document.querySelectorAll('.table-container');
        tables.forEach(table => {
            table.style.display = 'none';
        });

        // Tampilkan tabel yang dipilih
        const selectedTable = document.getElementById(tableId);
        if (selectedTable) {
            selectedTable.style.display = 'block';
        }

        // Ganti kelas aktif pada ikon
        const icons = document.querySelectorAll('.icon-table i');
        icons.forEach(icon => {
            icon.classList.remove('active');
            icon.style.display = 'inline-block'; // Pastikan ikon terlihat
        });

        // Sembunyikan ikon yang tidak aktif
        clickedIcon.classList.add('active');
        clickedIcon.style.display = 'inline-block'; // Pastikan ikon terlihat
    }
    
</script>
@endpush
