<div class="overlay" id="registerOverlay">
    <div class="register-form">
        <span class="close" id="closeRegisterPopup">&times;</span>
        <h3>Register Your Account</h3>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="firstname">First Name:</label>
                <input type="text" class="form-control" id="firstname" name="firstname" required>
            </div>
            <div class="form-group">
                <label for="lastname">Last Name:</label>
                <input type="text" class="form-control" id="lastname" name="lastname" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="no_telp">Phone Number:</label>
                <input type="text" class="form-control" id="no_telp" name="no_telp" required>
            </div>            
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
        <p class="mt-3">
            Already have an account? <a href="#" id="openLoginPopup">Login here</a>.
        </p>
    </div>
</div>
