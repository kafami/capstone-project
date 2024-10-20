    <!DOCTYPE html>
    <html lang="en">
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
        <title>{{ $title }}</title>
    </head>
    <body>
    <div class="elements">
        <div class="navbar-holder">
            @include('partials.navbar')
        </div>
        {{-- <div class="login-holder">
            <div class="login">
                <h1 class="welcome-text">Sign in</h1>
                <input class="input" type="text" placeholder="Email">
                <input class="input" type="text" placeholder="Password">
                <p class="forgot">Forgot Password</p>
                <div class="button-holder">
                    <button class="login-button">Login</button>
                </div>
                <p class="donthaveaccount">Don't have an account?</p><p class="signup">Sign Up</p>
            </div>
        </div> --}}
        <div class="body-replace">
            <div class="login-container">
                <form>
                    <h1>Login</h1>
                    <div class="form-row">
                        <input type="email" id="emailInput" class="form-input" placeholder="example@email.com">
                        <label for="emailInput" class="form-label">Email</label>
                    </div>
                    <div class="form-row">
                        <input type="password" id="passwordInput" class="form-input" placeholder="1234password">
                        <label for="passwordInput" class="form-label">Password</label>
                    </div>
                    <a href="#" class="forgotPwd">forgot password</a>
        
                    <button type="submit" class="submitBtn">Login</button>
                </form>
                <p class="signUpText">Don't have an account? <a href="#"></a></p>
            </div>
        </div>
    </div>
    </body>
    </html>