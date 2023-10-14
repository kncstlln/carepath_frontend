<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="{{ asset('css/user/sidebar.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/user/addHistory.css') }}" rel="stylesheet"/>
    <script src="{{ asset('js/sidebar.js') }}" defer></script>
    <script src="{{ asset('js/index.js') }}"></script>
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/2eead9cc17.js" crossorigin="anonymous"></script>
    <title>Add Infant</title>    
</head>
  <body>
  @include('user.sidebar')
        <div class="container-sm mt-4">
            <div class="row">
                <div class="col-sm mb-5" id="infantsTxt">Create Vaccination History Record</div>
            </div>
            <div class="container-sm createRecord">
                <div class="row">
                    <div class="col h2 mb-5 mt-3 text-center">Create Vaccination History Record</div>
                </div>
                <form>
                  <div class="row mb-4">
                      <div class="col-md-1 pt-1 text-center"> Name:</div>
                      <div class="col-md-5 me-4">
                      <input class="form-control" type="text" placeholder="Full Name" aria-label="default input" required/></div>
                      <div class="col-md-2 p-2 text-center"> Tracking Number:</div>
                      <div class="col-md-3 me-4">
                        <input class="form-control" type="number" placeholder="Tracking Number" aria-label="default input" required/></div>
                  </div>
                  <div class="row mb-4">
                      <div class="col-md-1 mt-2">Sex: </div>
                      <div class="col-md-1 mt-2 me-5">
      
                      </div>
                      <div class="col-md-2 pt-2">Birth date: </div>
                      <div class="col-md-2 me-4">
                          
                      </div>
                      <div class="col-md-3 pt-2"> Barangay: Salapungan </div>
                  </div>
                  <div class="row mb-5">
                    <div class="col-md-3 pt-2">Weight (kg): </div>
                    
                    <div class="col-md-3 pt-2">Length (cm):</div>
                   
                  </div>
                  <div class="row mb-2">
                    <div class="col-md-2 pt-2 text-center">Vaccine Used:</div>
                    <div class="col-md-5">
                        <select class="form-select" aria-label="Default select example">
                            <option selected></option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                          </select>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-md-2 pt-2 text-center">Vaccination Type:</div>
                    <div class="col-md-3">
                        <select class="form-select" aria-label="Default select example">
                            <option selected></option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                          </select>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-md-2 pt-2 text-center">Vaccinated By:</div>
                    <div class="col-md-5">
                      <select class="form-select" aria-label="Default select example">
                        <option selected></option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                      </select>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-md-2 pt-2 text-center">Vaccination Location:</div>
                    <div class="col-md-5">
                      <select class="form-select" aria-label="Default select example">
                        <option selected></option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                      </select>
                    </div>
                  </div>
                  <div class="row mb-4">
                    <div class="col-md-2 text-center">Remarks: </div>
                    <div class="col-md-4 mb-3">
                      <textarea class="form-control" rows="2"></textarea>
                    </div>
                  </div>
                  <div class="row mb-4 justify-content-center text-center">
                    <div class="col-md-3 col-lg-2 mt-1">
                      <a href="{{ url('user/history') }}"><button type="button" class="btn btn-secondary cancelButton">Cancel</button></a>
                    </div>
                    <div class="col-md-3 col-lg-2 mt-1">
                      <button type="button" class="btn submitButton" style="background-color:#980B0B; color:white; ">Submit</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
    </body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"> </script>
</html>