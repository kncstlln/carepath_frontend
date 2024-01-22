@include('admin/head')
    <title>My Account</title>
<body>

@include('admin/sidebar')
    <div class="container content createRecord mt-5">
        <div class="row mb-5 mt-3">
            <div class="col-12 fs-2 text-center">
                My Account       
            </div>
        </div>
        <form onsubmit="return validatePassword()" action="{{ route('admin.update-password') }}" method="POST">
        @csrf
        @method('PUT')
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
            <div class="col-12 col-md-7 mb-3">
                <label for="currentPassword" class="form-label">New Password:</label>
                <input class="form-control" type="password" name="password" id="password" placeholder="Password" aria-label="currentPassword">
            </div>
            <div class="col-12 col-md-7 mb-3">
                <label for="currentPassword" class="form-label">Confirm Password:</label>
                <input class="form-control" type="password" name="password_confirmation" id="confirmPassword" placeholder="Confirm Password" aria-label="currentPassword">
                <p id="passwordMatchError" class="text-danger"></p>
            </div>
        </div>
        <div class="row mb-4 mt-5 justify-content-center text-center">
            <div class="col-md-3 col-lg-2 mt-1">
                <a href="{{ route('admin.account') }}"><button type="button" class="btn btn-secondary cancelButton">Cancel</button></a>
            </div>
            <div class="col-md-3 col-lg-2 mt-1">
                <button type="submit" class="btn submitButton">Submit</button>
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