<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="{{ asset('/images/logo.png') }}">
    <link href="{{ asset('css/user/index.css') }}" rel="stylesheet"/>
    <script src="{{ asset('js/index.js') }}"></script>
    <title>My Account</title>
</head>
<body>

    @include('admin/sidebar')
    <div class="container content createRecord mt-5">
        <div class="row mb-5 mt-3">
            <div class="col-1 pt-2">
                <a href="{{ route('admin.infants.index') }}"><i class="fa-solid fa-angle-up fa-rotate-270 fa-2xl"></i></a>
            </div>
            <div class="col-11 col-lg-10 fs-2 text-center">
                My Account       
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-7 mb-3">
                <label for="username" class="form-label">Username</label>
                <input class="form-control" type="text" value="PLACE USERNAME" aria-label="disabledUsername" disabled readonly>
            </div>
            <div class="col-12 col-md-7 mb-3">
                <label for="emailAccount" class="form-label">Email address</label>
                <input class="form-control" type="text" value="PLACE EMAIL HERE!!" aria-label="disabledEmail" disabled readonly>
            </div>
            <div class="col-12 col-md-7 mb-4">
                <label for="role" class="form-label">Role</label>
                <input class="form-control" type="text" value="PLACE ROLE!!" aria-label="disabledRole" disabled readonly>
            </div>
            <div class="col-12 col-md-7 text-center text-lg-start mb-3">
                <a class="btn btn-danger" href="changePassword" role="button">Change Password</a>
            </div>
        </div>
    </div>



    





    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>