<div class="overlay" id="loginOverlay">
    <div class="login-form">
        <span class="close" id="closeLoginPopup"></span>
        {{-- <h3>LOGIN</h3> --}}
        <img src="img/logo.png" alt="Logo" class="logo-img">
        {{-- <p class="welcome">Welcome back! Please login to your account.</p> --}}

        @if (session('error'))
            <div class="alert alert-danger" id="errorAlert">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" required>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Kata Sandi" required oninput="toggleEyeIcon()">
                    <div class="input-group-append" id="eyeIconContainer" style="display: none;">
                        <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                            <i class="fa-regular fa-eye" id="eyeIcon"></i> <!-- Ikon mata regular -->
                        </span>
                    </div>
                </div>
            </div>

            <button type="submit" id="loginButton" disabled>Masuk</button>
        </form>

        {{-- <a href="#" id="openRegisterPopup">Sign Up</a> --}}
        <p class="mt-3">
            Belum punya akun? <a href="#" id="openRegisterPopup">Daftar</a>.
        </p>

    </div>
</div>

<script>
    // Fungsi untuk menampilkan atau menyembunyikan ikon mata
    function toggleEyeIcon() {
        const passwordInput = document.getElementById('password');
        const eyeIconContainer = document.getElementById('eyeIconContainer');

        // Menampilkan ikon mata hanya jika ada input
        if (passwordInput.value.length > 0) {
            eyeIconContainer.style.display = 'block';
        } else {
            eyeIconContainer.style.display = 'none';
        }
    }

    // Menangani klik pada ikon mata untuk menampilkan/menghilangkan password
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text'; // Ubah tipe menjadi text
            eyeIcon.classList.remove('fa-regular', 'fa-eye'); // Ganti ikon menjadi mata tertutup
            eyeIcon.classList.add('fa-regular', 'fa-eye-slash');
        } else {
            passwordInput.type = 'password'; // Kembalikan tipe menjadi password
            eyeIcon.classList.remove('fa-regular', 'fa-eye-slash'); // Kembali ke ikon mata terbuka
            eyeIcon.classList.add('fa-regular', 'fa-eye');
        }
    });

    // Menambahkan event listener untuk memeriksa input
    document.addEventListener("DOMContentLoaded", function() {
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const loginButton = document.getElementById('loginButton');
        const loginOverlay = document.getElementById('loginOverlay');
        const errorAlert = document.getElementById('errorAlert');

        // Fungsi untuk memeriksa input dan mengaktifkan/menonaktifkan tombol
        function checkInput() {
            if (emailInput.value && passwordInput.value) {
                loginButton.classList.add('enabled'); // Menambahkan kelas aktif
                loginButton.disabled = false; // Mengaktifkan tombol
                loginButton.style.cursor = 'pointer'; // Mengubah kursor
            } else {
                loginButton.classList.remove('enabled'); // Menghapus kelas aktif
                loginButton.disabled = true; // Menonaktifkan tombol
                loginButton.style.cursor = 'not-allowed'; // Kursor tidak bisa di klik
            }
        }

        // Menambahkan event listener untuk input
        emailInput.addEventListener('input', checkInput);
        passwordInput.addEventListener('input', checkInput);

        // Cek jika ada error, maka tampilkan popup login
        if (errorAlert) {
            loginOverlay.style.display = 'flex'; // Menampilkan pop-up
        }

        // Menangani close button untuk pop-up
        document.getElementById('closeLoginPopup').addEventListener('click', function () {
            loginOverlay.style.display = 'none';
        });
    });
</script>
