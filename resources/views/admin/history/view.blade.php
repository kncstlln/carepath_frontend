<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="css/admin/sidebar.css" rel="stylesheet"/>
    <link href="css/admin/index.css" rel="stylesheet"/>
    <link href="css/admin/viewInfant.css" rel="stylesheet"/>
    <script src="js/sidebar.js" defer></script>
    <script src="js/index.js"></script>
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/2eead9cc17.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('/images/logo.png') }}">
    <title>View History</title>    
</head>
  <body>
  @include('admin/sidebar')
        <div class="container-sm mt-4">
            <div class="row">
                <div class="col-sm mb-5" id="infantsTxt">View Vaccination History Record</div>
            </div>
            <div class="container-sm ps-4 createRecord">
                <div class="row">
                    <div class="col-1 col-md-1 mt-3"><a href="{{ url('/history') }}"><i class="fa-solid fa-angle-up fa-rotate-270 fa-2xl"></i></a></div>
                    <div class="col-10 col-md-10 h2 mb-5 mt-3 text-center">View Vaccination History Record</div>
                </div>
                <div>
                    <form>
                        <div class="row mb-4">
                            <div class="col-md-1 pt-1 txtBold"> Name:</div>
                            <div class="col-10 col-md-4 pt-1">Kane Erryl G. Castillano</div>
                            <div class="col-md-1 pt-1 txtBold">Sex: </div>
                            <div class="col-md-1 pt-1 "> M </div>
                            <div class="col-md-2 pt-1 txtBold"> Barangay: </div>
                            <div class="col-md-2 pt-1"> Salapungan </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-1 pe-1 pt-2 txtBold">Birth date: </div>
                            <div class="col-md-2 pt-2 "> 06/15/2002</div>
                            <div class="col-md-2 pt-2 txtBold"> Family Serial Number: </div>
                            <div class="col-md-2 pt-2 "> 123456789 </div>
                            <div class="col-md-2 pt-2 txtBold"> Tracking Number:  </div>
                            <div class="col-md-3 pt-2 "> 123456789 </div>
                        </div>
                        <div class="row mb-5">
                          <div class="col-md-3 col-lg-2 pt-2 txtBold">Weight (kg): </div>
                          <div class="col-md-1 pt-2"> 7 </div>
                          <div class="col-md-3 col-lg-2 pt-2 txtBold">Length (cm): </div>
                          <div class="col-md-1 pt-2"> 54</div>
                        </div>
                        <div class="row mb-4">
                          <div class="col">Vaccine Information</div>
                        </div>
                        <div class="row mb-2">
                          <div class="col-md-3 col-lg-2 txtBold">Vaccine Used:</div>
                          <div class="col-md-3 col-lg-2"></div>
                          <div class="col-md-3 col-lg-2 txtBold">Vaccination Type:</div>
                          <div class="col-md-3 col-lg-2"></div>
                        </div>
                        <div class="row mb-5">
                          <div class="col-md-3 col-lg-2 txtBold">Vaccinated By:</div>
                          <div class="col-md-3 col-lg-2"></div>
                          <div class="col-md-3 col-lg-2 txtBold">Vaccination At:</div>
                          <div class="col-md-3 col-lg-2"></div>
                        </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
  </body>
</html>