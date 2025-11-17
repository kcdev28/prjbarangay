<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <title>SAN AGUSTIN E-SERVICE</title>
</head>


<body>
    <div class="login-container">
        <div class="login-row">

            <div class="login-image">
                <img src="images/sanagustinlogo.png" alt="Login">
            </div>

            <div class="login-form-panel">
                <h2 class="text-center">Log In</h2>


                <form id="loginForm">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
                    </div>

                    <div class="form-group password-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter your password"
                            required>
                        <div class="show-password-wrapper">
                            <input type="checkbox" id="showPassword">
                            <label for="showPassword">Show Password</label>
                        </div>
                    </div>

                    <button type="submit" id="submit" class="btn-login" onclick="">Sign In</button>
                </form>

                <div class="register-link">
                    Don't have an account? <a href="{{ route('register') }}">Register Now</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    const showPasswordCheckbox = document.getElementById('showPassword');
    const passwordInput = document.getElementById('password');

    showPasswordCheckbox.addEventListener('change', function() {
        const type = this.checked ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
    });

    document.getElementById('submit').addEventListener('click', function() {
        window.location.href = 'landingPage.blade.php';
    });
</script>