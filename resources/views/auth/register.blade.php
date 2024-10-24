<div class="register_form">
    <div class="container">
        <div class="register-box">
            @include('auth.register_form')
        </div>
    </div>
    <div class="login-route">
        <p class="mt-3">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>.
        </p>
    </div>
</div>


<style>
    /* .register_form {
        position: fixed
    } */

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding-left: 450px;
        padding-top: 40px;
        padding-right: 430px;
    }

    .register-box {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        padding: 20px;
        background-color: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.212);
        border-radius: 8px;
        width: 500px;
    }

    .login-route {
        position: relative;
        bottom: 158px;
        left: 578px;
        background-color: #ffffff;
        width: 200px;
        height: 30px;
        font-family: 'Cabin', sans-serif;
    }
    .login-route p {
        font-size: 15px;
        color: #707079;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .login-route p a {
        display: inline;
        font-size: 15px;
        font-weight: bold;
        color: #dfa974;
        display: block;
        padding-left: 5px;
        text-decoration: none;
    }
</style>






{{-- <link rel="stylesheet" href="{{ asset('css/register.css') }}">

<div class="overlay" id="registerOverlay">
    <div class="register-form">
        <span class="close" id="closeRegisterPopup"></span>

        <img src="img/logo.png" alt="Logo" class="logo-img" id="logo-img">

        @if ($errors->any())
            <div class="alert alert-danger" id="registerErrorAlert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" placeholder="Nama Depan">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" placeholder="Nama Belakang">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <input id="registerEmail" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
            </div>

            <div class="form-group">
                <div class="input-group">
                    <input type="password" class="form-control mb-2" id="registerPassword" name="password" value="{{ old('password') }}" placeholder="Kata Sandi" required oninput="toggleRegisterEyeIcon()" onkeyup="hitungKarakter()">
                    <div class="input-group-append" id="registerEyeIconContainer" style="display: none;">
                        <span class="input-group-text" id="toggleRegisterPassword" style="cursor: pointer;">
                            <i class="fa-regular fa-eye" id="registerEyeIcon"></i>
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <input id="password-confirm" type="password" class="form-control mb-2" name="password_confirmation" value="{{ old('password_confirmation') }}" required autocomplete="new-password" placeholder="Konfirmasi Kata Sandi" oninput="toggleConfirmPasswordEyeIcon()">
                    <div class="input-group-append" id="confirmPasswordEyeIconContainer" style="display: none;">
                        <span class="input-group-text" id="toggleConfirmPassword" style="cursor: pointer;">
                            <i class="fa-regular fa-eye" id="confirmPasswordEyeIcon"></i>
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <input id="no_telp" type="text" class="form-control" name="no_telp" value="{{ old('no_telp') }}" required autocomplete="no_telp" placeholder="Nomor Telepon" oninput="formatPhoneNumber(this)">
            </div>       

            <button type="submit" id="registerButton" disabled>Daftar</button>
        </form>

        <p class="mt-3 route-login">
            Sudah punya akun? <a href="#" id="openLoginPopup">Masuk</a>.
        </p>

        <input type="text" class="hitung-password" readonly id="jumlah" name="jumlah" value="1/8" placeholder="1/8" />
    </div>
</div>

<script>
    let isRegisterPasswordVisible = false;

    function toggleRegisterEyeIcon() {
        const passwordInput = document.getElementById('registerPassword');
        const eyeIconContainer = document.getElementById('registerEyeIconContainer');
        const countPassword = document.getElementById('jumlah');

        if (passwordInput.value.length > 0) {
            eyeIconContainer.style.display = 'block';
            countPassword.style.display = 'block';
        } else {
            eyeIconContainer.style.display = 'none';
            countPassword.style.display = 'none';
        }
    }

    document.getElementById('toggleRegisterPassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('registerPassword');
        const eyeIcon = document.getElementById('registerEyeIcon');

        if (!isRegisterPasswordVisible) {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('fa-regular', 'fa-eye');
            eyeIcon.classList.add('fa-regular', 'fa-eye-slash');
            isRegisterPasswordVisible = true;
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('fa-regular', 'fa-eye-slash');
            eyeIcon.classList.add('fa-regular', 'fa-eye');
            isRegisterPasswordVisible = false;
        }
    });


    let isConfirmPasswordVisible = false;

    function toggleConfirmPasswordEyeIcon() {
        const confirmPasswordInput = document.getElementById('password-confirm');
        const eyeIconContainer = document.getElementById('confirmPasswordEyeIconContainer');

        if (confirmPasswordInput.value.length > 0) {
            eyeIconContainer.style.display = 'block';
        } else {
            eyeIconContainer.style.display = 'none';
        }
    }

    document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
        const confirmPasswordInput = document.getElementById('password-confirm');
        const eyeIcon = document.getElementById('confirmPasswordEyeIcon');

        if (!isConfirmPasswordVisible) {
            confirmPasswordInput.type = 'text';
            eyeIcon.classList.remove('fa-regular', 'fa-eye');
            eyeIcon.classList.add('fa-regular', 'fa-eye-slash');
            isConfirmPasswordVisible = true;
        } else {
            confirmPasswordInput.type = 'password';
            eyeIcon.classList.remove('fa-regular', 'fa-eye-slash');
            eyeIcon.classList.add('fa-regular', 'fa-eye');
            isConfirmPasswordVisible = false;
        }
    });


    function formatPhoneNumber(input) {
        let phoneNumber = input.value.replace(/\D/g, '');
    
        if (phoneNumber.length > 3 && phoneNumber.length <= 6) {
            phoneNumber = phoneNumber.replace(/^(\d{3})(\d+)/, '$1-$2');
        } else if (phoneNumber.length > 6 && phoneNumber.length <= 10) {
            phoneNumber = phoneNumber.replace(/^(\d{3})(\d{3})(\d+)/, '$1-$2-$3');
        } else if (phoneNumber.length > 10) {
            phoneNumber = phoneNumber.replace(/^(\d{3})(\d{3})(\d{4})(\d+)/, '$1-$2-$3-$4');
        }
    
        input.value = phoneNumber;
    }


    document.addEventListener("DOMContentLoaded", function() {
        const firstnameInput = document.getElementById('firstname');
        const lastnameInput = document.getElementById('lastname');
        const emailInput = document.getElementById('registerEmail');
        const passwordInput = document.getElementById('registerPassword');
        const confirmPasswordInput = document.getElementById('password-confirm');
        const phoneInput = document.getElementById('no_telp');
        const registerButton = document.getElementById('registerButton');
        const registerOverlay = document.getElementById('registerOverlay');
        const registrationError = @json(session('registration_error'));
        const registerErrorAlert = document.getElementById('registerErrorAlert');
        const image = document.getElementById('logo-img');
        const routeLogin = document.querySelector('.route-login');

        function checkInput() {
            const passwordLength = passwordInput.value.length;

            if (
                firstnameInput.value &&
                lastnameInput.value &&
                emailInput.value &&
                passwordLength >= 8 &&
                confirmPasswordInput.value &&
                phoneInput.value
            ) {
                registerButton.classList.add('enabled');
                registerButton.disabled = false;
                registerButton.style.cursor = 'pointer';
            } else {
                registerButton.classList.remove('enabled');
                registerButton.disabled = true;
                registerButton.style.cursor = 'not-allowed';
            }
        }

        firstnameInput.addEventListener('input', checkInput);
        lastnameInput.addEventListener('input', checkInput);
        emailInput.addEventListener('input', checkInput);
        passwordInput.addEventListener('input', checkInput);
        confirmPasswordInput.addEventListener('input', checkInput);
        phoneInput.addEventListener('input', checkInput);

        if (registrationError || {{ $errors->any() ? 'true' : 'false' }}) {
            registerOverlay.style.display = 'flex';
        }

        document.getElementById('closeRegisterPopup').addEventListener('click', function () {
            registerOverlay.style.display = 'none';
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                registerOverlay.style.display = 'none';
            }
        });

        if (registerErrorAlert) {
            image.style.marginBottom = '5px';
            routeLogin.classList.add('route-login-with-alert');
        } else {
            image.style.marginBottom = '';
            routeLogin.classList.remove('route-login-with-alert');
        }
    });

    
    function hitungKarakter() {
        var password = document.getElementById('registerPassword').value;

        var jumlahKarakter = password.length;

        document.getElementById('jumlah').value = jumlahKarakter + "/8";

        var jumlahInput = document.getElementById('jumlah');
        if (jumlahKarakter >= 8) {
            jumlahInput.style.color = '#94999e';
        } else {
            jumlahInput.style.color = '#ced4da';
        }
    }
</script> --}}
