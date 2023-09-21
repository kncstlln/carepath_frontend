<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="{{ asset('css/admin/sidebar.css') }}" rel="stylesheet"/>
    <script src="{{ asset('js/sidebar.js') }}" defer></script>
    <link href="{{ asset('css/admin/dashboard.css') }}" rel="stylesheet"/>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('/images/logo.png') }}">
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <title>Dashboard</title>
</head>
<body>
  @include('admin.sidebar')
      <div class="container"> 
        <div class="row mt-3 mb-5" id="rectangle">
          <div class="col-sm-10" id="user">Hello Varona,
            <div class="row">
              <div class="col-sm" id="subtitle">
                Have a nice day and do not forget to take care of your health!
              </div>
            </div>
          </div>
          <div class="col-sm-2 mt-2 d-none d-lg-block"><img src="{{ asset('images/AC_LOGO.png') }}" width="139px" height="139px"/></div>
        </div>
          <div class="row g-4 mb-5 text-center">
            <div class="col-6 col-md-3">
              <div class="p-1 pt-4" id="listbox1"><i class='bx bx-injection'></i>  Vaccine Listed</div>
            </div>
            <div class="col-6 col-md-3">
              <div class="p-1 pt-4" id="listbox2">Barangay List</div>
            </div>
            <div class="col-6 col-md-3">
              <div class="p-1 pt-4" id="listbox3">Partially Vaccinated</div>
            </div>
            <div class="col-6 col-md-3">
              <div class="p-1 pt-4" id="listbox4">Fully Vaccinated</div>
            </div>
          </div>
          <div class="row g-2" style="border:1px solid red;">
            <div class="col-sm-9 p-3" style="border:1px solid blue;">Column</div>
            <div class="col-sm-3 p-3" style="border:1px solid blue;">Column</div>
          </div>
      </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</html>