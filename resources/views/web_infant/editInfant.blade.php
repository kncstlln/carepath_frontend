<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="../css/sidebar.css" rel="stylesheet"/>
    <link href="../css/index.css" rel="stylesheet"/>
    <link href="../css/addInfant.css" rel="stylesheet"/>
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
                <div class="col-sm mb-5" id="infantsTxt">Edit Infant Record</div>
            </div>
            <div class="container-sm createRecord">
                <div class="row">
                    <div class="col h2 mb-5 mt-3 text-center">Edit Infant Record</div>
                </div>
                <form>
                  <div class="row mb-4">
                      <div class="col-sm-1 pt-1 text-center"> Name:</div>
                      <div class="col-sm-5 me-4">
                      <input class="form-control" type="text" placeholder="Full Name" aria-label="default input" required/></div>
                      <div class="col-2 me-5"></div>
                      <div class="col-sm-2 p-2 text-center"> Barangay: Salapungan</div>
                  </div>
                  <div class="row mb-4">
                      <div class="col-md-1 mt-2 text-center">Sex: </div>
                      <div class="col-md-1 mt-2">
                          <div class="form-check">
                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                              <label class="form-check-label" for="flexRadioDefault1">
                                  Male
                              </label>
                          </div>
                      </div>
                      <div class="col-md-1 mt-2 me-5">
                          <div class="form-check">
                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                              <label class="form-check-label" for="flexRadioDefault1">
                                  Female
                              </label>
                          </div>
                      </div>
                      <div class="col-md-1 pt-2 text-center">Birth date: </div>
                      <div class="col-md-2 me-4">
                          <div class="input-group date" id="datepicker">
                              <input type="date" class="form-control" required/>
                          </div>
                      </div>
                      <div class="col-md-2 pt-2 text-center"> Family Serial Number: </div>
                      <div class="col-md-2">
                          <input class="form-control" type="number" placeholder="Number" aria-label="default input"/>
                      </div>
                  </div>
                  <div class="row mb-5">
                    <div class="col-md-1 pt-2 text-center">Weight (kg): </div>
                    <div class="col-md-1 col-md-1">
                      <input class="form-control" type="number" placeholder="kg" aria-label="default input" min="1" max="50"/>
                    </div>
                    <div class="col-md-1 pt-2 text-center">Length (cm):</div>
                    <div class="col-md-1 ">
                      <input class="form-control" type="number" placeholder="cm" aria-label="default input" min="1" max="50"/>
                    </div>
                  </div>
                  <div class="row mb-4">
                    <div class="col-md-3 h4 text-center">Parents Information</div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-md-2 pt-2 text-center">Father's Name:</div>
                    <div class="col-md-5">
                      <input class="form-control" type="text" placeholder="Full Name" aria-label="default input" required/>
                    </div>
                  </div>
                  <div class="row mb-2 justify-content-end">
                    <div class="col-md-2 pt-2 text-center">Contact Number:</div>
                    <div class="col-md-3">
                      <input class="form-control" type="text" placeholder="Contact Number" aria-label="default input" required/>
                    </div>
                  </div>
                  <div class="row mb-5">
                    <div class="col-md-2 pt-2 text-center">Mother's Name:</div>
                    <div class="col-md-5">
                      <input class="form-control" type="text" placeholder="Full Name" aria-label="default input" required/>
                    </div>
                  </div>
                  <div class="row mb-4">
                    <div class="col-md-3 h4 text-center">Complete Address:</div>
                    <div class="mb-3">
                      <textarea class="form-control" rows="2"></textarea>
                    </div>
                  </div>
                  <div class="row mb-4 justify-content-center text-center">
                    <div class="col-lg-2 mt-1">
                      <a href="{{ url('/infant') }}"><button type="button" class="btn btn-secondary cancelButton">Cancel</button></a>
                    </div>
                    <div class="col-lg-2 mt-1">
                      <button type="button" class="btn submitButton">Update</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
    </body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"> </script>
</html>