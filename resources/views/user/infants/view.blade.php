<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="{{ asset('css/user/sidebar.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/user/index.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/user/viewInfant.css') }}" rel="stylesheet"/>
    <script src="{{ asset('js/sidebar.js') }}" defer></script>
    <script src="{{ asset('js/index.js') }}"></script>
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/2eead9cc17.js" crossorigin="anonymous"></script>
    <title>View Infant</title>    
</head>
  <body>
    @include('user.sidebar')
        <div class="container-sm mt-4">
            <div class="row">
                <div class="col-sm mb-5" id="infantsTxt">View Infant Record</div>
            </div>
            <div class="container-sm ps-4 createRecord">
                <div class="row">
                    <div class="col-1 col-md-1 mt-3"><a href="{{ url('/infant') }}"><i class="fa-solid fa-angle-up fa-rotate-270 fa-2xl" style="color:black;"></i></a></div>
                    <div class="col-9 col-md-10 h2 mb-5 mt-3 text-center">View Infant Record</div>
                </div>
                <div>
                    <form>
                        <div class="row mb-4">
                            <div class="col-2 col-md-1 pt-1"><strong> Name: </strong></div>
                            <div class="col-12 col-md-4 col-lg-3 pt-1">Kane Erryl G. Castillano</div>
                            <div class="col-md-1 pt-1"><strong>Sex: </strong></div>
                            <div class="col-md pt-1 "> M </div>
                            <div class="col-md-2 pt-1 "><strong> Barangay: </strong> </div>
                            <div class="col-md-3 pt-1"> Salapungan </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-1 pe-1 pt-2"><strong>Birth date:</strong> </div>
                            <div class="col-md-2 pt-2 "> 06/15/2002</div>
                            <div class="col-md-2 pt-2"><strong> Family Serial Number:</strong></div>
                            <div class="col-md-2 pt-2 "> 123456789 </div>
                            <div class="col-md-2 pt-2"><strong> Tracking Number:  </strong></div>
                            <div class="col-md-3 pt-2 "> 123456789 </div>
                        </div>
                        <div class="row mb-5">
                          <div class="col-md-2 pt-2"><strong>Weight (kg): </strong></div>
                          <div class="col-md-1 ps-md-0 pt-2"> 7 </div>
                          <div class="col-md-2 pt-2"><strong>Length (cm): </strong></div>
                          <div class="col-md-1 ps-md-0 pt-2"> 54</div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-md-5 h4"><strong>Parents Information </strong></div>
                        </div>
                        <div class="row mb-2">
                          <div class="col-md-3 col-lg-2 pt-2"><strong>Father's Name:</strong> </div>
                          <div class="col-md-3 pt-2">Jello P. Mangune</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3 col-lg-2 pt-2"><strong>Mother's Name: </strong></div>
                            <div class="col-md-3 pt-2">Nathaniel T. Allapitan</div>
                        </div>
                        <div class="row mb-2">
                          <div class="col-md-2 ms-lg-2 ps-lg-0 pt-2"><strong>Contact Number</strong></div>
                          <div class="col-md-1 pt-2">09429900320</div>
                        </div>
                        <div class="row mb-4">
                          <div class="col-md-4 pt-2"><strong>Complete Address: </strong> </div>
                          <div class="col-md-10 pt-2">Angeles University Foundation, Brgy. Salapungan, 2009 Angeles City, Philippines</div>
                        </div>
                        <div class="table-responsive-lg text-center">
                        <table class="table table-striped">
                          <thead>
                            <tr class="table-danger">
                              <th scope="col">Date</th>
                              <th scope="col">Vaccine</th>
                              <th scope="col">Vaccinator</th>
                              <th scope="col">Remarks</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th scope="row">06/15/2002</th>
                              <td class="table-secondary">BCG Vaccine</td>
                              <td>Dr. Kane Castillano</td>
                              <td class="table-secondary">Good</td>
                            </tr>
                            <tr>
                              <th scope="row">07/23/2021</th>
                              <td class="table-secondary">Hepa Vaccine</td>
                              <td>Dr. Jello Mangune</td>
                              <td class="table-secondary">Not Good</td>
                            </tr>
                            <tr>
                              <th scope="row">08/03/2022</th>
                              <td class="table-secondary">Oral Polio Vaccine</td>
                              <td>Dr. Nathaniel Allapitan</td>
                              <td class="table-secondary">Good</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
  </body>
</html>