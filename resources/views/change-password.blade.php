@include('admin/head')
<title>My Account</title>
<body>

    <div class="container content createRecord mt-5">
        <div class="row mb-5 mt-3">
            <div class="col-12 fs-2 text-center">
                Change Password       
            </div>
        </div>
        <form action="{{ route('update-password') }}" method="POST">
            @csrf
            @if(session('success'))
            <div class="alert alert-success" id="success-message">
                {{ session('success') }}
            </div>

            <script>
                setTimeout(function() {
                    document.getElementById('success-message').style.display = 'none';
                }, 3000);
            </script>
            @endif
            @if(session('error'))
                <div class="alert alert-danger" id="error-message">
                    {{ session('error') }}
                </div>

                <script>
                    setTimeout(function() {
                        document.getElementById('error-message').style.display = 'none';
                    }, 3000);
                </script>
            @endif
            <div class="row">
                <div class="col-12 col-md-6 mb-3">
                    <input type="hidden" name="password_reset_token" value="{{ $token }}">
                    <label for="password" class="form-label">Password</label>
                    <input class="form-control" type="password" name="password" placeholder="Password" id="password" aria-label="password">
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 mb-3">
                    <label for="password" class="form-label">Confirm Password</label>
                    <input class="form-control" type="password" name="password_confirmation" id="confirmPassword" placeholder="Confirm Password" aria-label="password">
                    <p id="passwordMatchError" class="text-danger"></p>
                </div>
            </div>
            <div class="row mb-4 mt-5 justify-content-center text-center">
                <div class="col-md-3 mt-1">
                    <a href="{{ route('login') }}"><button type="button" class="btn btn-secondary cancelButton">Cancel</button></a>
                </div>
                <div class="col-md-3 mt-1 align-items-center">
                    <button type="submit" class="btn" style="background-color: #980B0B; color: white; height: 90%;">Reset Password</button>
                </div>
            </div>
        </form>
    </div>
    
            <script>
        function validatePassword() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirmPassword").value;
            var errorElement = document.getElementById("passwordMatchError");

            if (password !== confirmPassword) {
                errorElement.textContent = "Passwords do not match!";
                return false; // Prevent form submission
            } else {
                errorElement.textContent = "";
                return true; // Allow form submission
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>