<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <link href="{{ asset('css/admin/sidebar.css') }}" rel="stylesheet"/>
    <title>Profile</title>

    <body>   
        <div class="dropdown d-flex justify-content-end mt-2 pe-md-3 pe-lg-5 profileUpper">
            <button class="btn buttonProfile p-1" style="border-color: none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('images/profile.jpg') }}" class="img-fluid" width="40" alt="profile">
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item text-end" href="#">Profile</a></li>
                <li><a class="dropdown-item text-end" href="{{ route('logout') }}">Logout</a></li>
            </ul>
        </div>
    </body>

</html>