<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="../css/sidebar.css" rel="stylesheet"/>
    <link href="../css/index.css" rel="stylesheet"/>
    <link href="../css/addVaccine.css" rel="stylesheet"/>
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
                <div class="col-sm mb-5" id="infantsTxt">Create Vaccine Record</div>
            </div>
            <div class="container-sm createRecord">
                <div class="row">
                    <div class="col h2 mb-5 mt-3 text-center">Create Vaccine Record</div>
                </div>
                <form>
                  <div class="row mb-4">
                      <div class="col-md-2 ms-3 pt-1 text-center">Name of Vaccine: </div>
                      <div class="col-md-3">
                        <input class="form-control" type="text" placeholder="Vaccine Name" aria-label="default input" required/>
                      </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-md-2 ms-3 pt-2 text-center">Vaccination Doses:</div>
                    <div class="col-md-1">
                        <select class="form-select" aria-label="Default select example">
                            <option selected></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
                    </div>
                  </div>
                  <div class="row mb-1">
                    <div class="col-md-3 pt-2 text-center">Vaccination Date from Birth:</div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-md-2 pt-2 text-center">Dose 1:</div>
                    <div class="col-md-1">
                        <input class="form-control" type="text" placeholder="" aria-label="default input" required/>
                    </div>
                    <div class="col-md-2 pt-2 text-center">months from birth</div>
                  </div>
    
                  <div class="row mb-4 justify-content-center text-center">
                    <div class="col-lg-2 mt-1">
                      <a href="{{ url('/addVaccine') }}"><button type="button" class="btn btn-secondary cancelButton">Cancel</button></a>
                    </div>
                    <div class="col-lg-2 mt-1">
                      <button type="button" class="btn submitButton">Submit</button>
                    </div>
                  </div>
                </div>
              </form>
          </div>
        </div>
    </body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"> </script>
</html>