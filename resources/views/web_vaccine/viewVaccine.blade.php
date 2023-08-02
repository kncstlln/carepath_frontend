<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="../css/sidebar.css" rel="stylesheet"/>
    <link href="../css/index.css" rel="stylesheet"/>
    <link href="../css/viewVaccine.css" rel="stylesheet"/>
    <script src="../js/sidebar.js" defer></script>
    <script src="../js/index.js"></script>
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/2eead9cc17.js" crossorigin="anonymous"></script>
    <title>Add Infant</title>    
</head>
  <body>
  @include('sidebar')
        <div class="container-sm mt-4">
            <div class="row">
                <div class="col-sm mb-5" id="infantsTxt">View Vaccine Record</div>
            </div>
            <div class="container-sm ps-4 createRecord">
                <div class="row">
                    <div class="col-md-1 mt-3"><a href="{{ url('/vaccine') }}"><i class="fa-solid fa-angle-up fa-rotate-270 fa-2xl"></i></a></div>
                    <div class="col-md-10 h2 mb-5 mt-3 text-center">View Vaccine Record</div>
                </div>
                <div>
                    <form>
                        <div class="row mb-4">
                            <div class="col-md-2 txtBold pt-1">Name of Vaccine:</div>
                            <div class="col-md-3 pt-1">Pentavalent Vaccine </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-2 pt-2 txtBold">Vaccination Doses:  </div>
                            <div class="col-md-1 pt-2 "> 3</div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-2 pt-2 txtBold">Dose 1:  </div>
                            <div class="col-md-3 pt-2 ">1.5 months from birth</div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-2 pt-2 txtBold">Dose 2:  </div>
                            <div class="col-md-3 pt-2 ">2.5 months from birth</div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-2 pt-2 txtBold">Dose 3:  </div>
                            <div class="col-md-3 pt-2 ">3.5 months from birth</div>
                        </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
  </body>
</html>