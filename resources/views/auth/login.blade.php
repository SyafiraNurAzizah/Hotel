<div class="overlay" id="loginOverlay">
    <div class="login-form">
        <span class="close" id="closeLoginPopup"></span>
        <h3>Login to Your Account</h3>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <p class="mt-3">
            Don't have an account? <a href="#" id="openRegisterPopup">Register here</a>.
        </p>        
    </div>
</div>