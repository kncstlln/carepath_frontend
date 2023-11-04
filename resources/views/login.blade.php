<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css" />
    <script src="js/login.js"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('/images/logo.png') }}">
    <title>Login</title>
</head>
<body style="background-color:#F2F8FD;">
    <div class="container pt-5 px-5">
        <img src="{{ asset('/images/aclogo.png') }}" class="rounded mx-auto d-block mt-5" height="250" alt="Angeles City logo">
        
        <!-- Display error message if it exists -->
        @if($errorMessage)
        <div class="row justify-content-center">
            <div class="col-10 col-md-6 col-lg-5">
                <div class="alert alert-danger" role="alert">
                    {{ $errorMessage }}
                </div>
            </div>
        </div>
        @endif
        
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="row justify-content-center mt-5">
                <div class="col-10 col-md-7 col-lg-5">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                        <p id="usernameError" style="color: red; display: none;">Please enter a valid username.</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-10 col-md-7 col-lg-5">
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        <p id="passwordError" style="color: red; display: none;">Please enter a valid password.</p>
                    </div>
                </div>
                <div class="col-12 col-md-7 d-lg-none text-center text-md-start">
                    <a href="forgot-password">Forgot Password?</a>
                </div>
            </div> 
            <div class="d-none d-lg-block">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <a href="forgot-password">Forgot Password?</a>
                    </div>
                </div>
            </div>
            <div class="col d-flex mt-3 justify-content-center">
                <button class="btn justify-content-center buttonColor" type="submit">Login</button>
            </div>
        </form>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-rTzBHQwb6a5STIIv73D4qa5SeJS6uNsfSlD1i6Mtpa/Irv3JxHQfa0bFMMNIp0bE" crossorigin="anonymous"></script>
</body>
</html>
