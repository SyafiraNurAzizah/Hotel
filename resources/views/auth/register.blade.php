<div class="overlay" id="registerOverlay">
    <div class="register-form">
        <span class="close" id="closeRegisterPopup"></span>
        <h3>Register Your Account</h3>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="form-group">
                <label for="firstname">First Name:</label>
                <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname">
            </div>
            <div class="form-group">
                <label for="lastname">Last Name:</label>
                <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" required autocomplete="new-password">
            </div>
            <div class="form-group">
                <label for="password-confirm">Password:</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
            <div class="form-group">
                <label for="no_telp">Phone Number:</label>
                <input id="no_telp" type="text" class="form-control" name="no_telp" value="{{ old('no_telp') }}" required autocomplete="no_telp">
            </div>            
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
        <p class="mt-3">
            Already have an account? <a href="#" id="openLoginPopup">Login here</a>.
        </p>
    </div>
</div>
