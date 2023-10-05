<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="{{ asset('css/admin/sidebar.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/admin/index.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/admin/viewVaccine.css') }}" rel="stylesheet"/>
    <script src="{{ asset('js/sidebar.js') }}" defer></script>
    <script src="{{ asset('js/index.js') }}"></script>
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/2eead9cc17.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('/images/logo.png') }}">
    <title>View Vaccine</title>    
</head>
<body>
@include('admin/sidebar')
    <div class="container-sm mt-4 content">
        <div class="row">
            <div class="col-sm mb-5" id="infantsTxt">View Vaccine Record</div>
        </div>
        <div class="container-sm ps-4 createRecord">
            <div class="row">
                <div class="col-md-1 mt-3"><a href="{{ url('/admin/vaccines') }}"><i class="fa-solid fa-angle-up fa-rotate-270 fa-2xl"></i></a></div>
                <div class="col-md-10 h2 mb-5 mt-3 text-center">View Vaccine Record</div>
            </div>
            <div>
                <form>
                    <div class="row mb-4">
                        <div class="col-md-3 txtBold pt-1">Name of Vaccine:</div>
                        <div class="col-md-5 pt-1">{{ $vaccine['name'] }}</div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-3 txtBold pt-1">Short Name:</div>
                        <div class="col-md-5 pt-1">{{ $vaccine['short_name'] }}</div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-4 col-lg-3 pt-2 txtBold">Vaccination Doses:</div>
                        <div class="col-md-1 pt-2">{{ count($vaccineDose) }}</div>
                    </div>
                    @foreach ($vaccineDose as $dose)
                        <div class="row mb-4">
                            <div class="col-md-2 pt-2 txtBold">Dose {{ $dose['dose_number'] }}:</div>
                            <div class="col-md-4 col-lg-3 pt-2">{{ $dose['months_to_take'] }} months from birth</div>
                        </div>
                    @endforeach
                </form>
            </div>
        </div>
    </div>
</body>
</html>
