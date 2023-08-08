<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css" />
    <script src="js/login.js"></script>
    <title>Login</title>
</head>
<body style="background-color:#F2F8FD;">
    <div class="container pt-5 px-5" >

            <img src="images/AC_logo.png" class="rounded mx-auto d-block mt-5" height="250" alt="Angeles City logo">
            <div class="row justify-content-center mt-5">
                <div class="col-10 col-md-6 col-lg-5">
                    <div class="mb-3">
                        <label for="userName" class="form-label">Username</label>
                        <input type="email" class="form-control" id="userName" placeholder="Username">
                        <p id="usernameError" style="color: red; display: none;">Please enter a valid username.</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-10 col-md-6 col-lg-5">
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password">
                        <p id="passwordError" style="color: red; display: none;">Please enter a valid password.</p>
                    </div>
                </div>
            </div>  
            <div class="col d-flex mt-3 justify-content-center">
                <input class="btn justify-content-center buttonColor" type="submit" value="Login" onclick="validateForm()">
            </div>

    </div>
    
</body>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</html>