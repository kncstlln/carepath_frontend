<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="{{ asset('css/admin/sidebar.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/admin/index.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/admin/addVaccine.css') }}" rel="stylesheet"/>
    <script src="{{ asset('js/sidebar.js') }}" defer></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('/images/logo.png') }}">
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/2eead9cc17.js" crossorigin="anonymous"></script>
    <title>Add User</title>    
    <style>
        .error {
            border-color: red;
        }
    </style>
</head>
    <body>
        @include('admin/sidebar')
        <div class="container-sm content mt-4">
            <div class="row">
                <div class="col-sm mb-5" id="infantsTxt">Add User</div>
            </div>
            <div class="container-sm createRecord">
                <div class="row">
                    <div class="col h2 mb-5 mt-3 text-center">Add User</div>
                </div>
                <form action="{{ route('admin.users.register') }}" method="POST" onsubmit="return validateForm()">
                @csrf
                  <div class="row mb-4">
                      <div class="col-md-2 pt-1 text-center">Full Name:<span style="color:red;"> *</span></div>
                      <div class="col-md-3">
                          <input class="form-control" name="name" type="text" placeholder="Name" aria-label="default input" required/>
                      </div>
                  </div>
                  <div class="row mb-4">
                      <div class="col-md-2 pt-1 text-center">Username:<span style="color:red;"> *</span></div>
                      <div class="col-md-3">
                          <input class="form-control" name="username" type="text" placeholder="Username" aria-label="default input" required/>
                      </div>
                  </div>
                  <div class="row mb-4">
                      <div class="col-md-2 pt-1 text-center">Email:<span style="color:red;"> *</span></div>
                      <div class="col-md-3">
                          <input class="form-control" name="email" type="email" placeholder="Email" aria-label="default input" required/>
                      </div>
                  </div>
                  <div class="row mb-4">
                      <div class="col-md-2  pt-2 text-center">Password:<span style="color:red;"> *</span></div>
                      <div class="col-md-5 pt-2 text-center">
                          <input type="password" name="password" id="inputPassword" class="form-control" aria-labelledby="passwordHelpBlock"required/>
                          <div id="passwordHelpBlock" class="form-text">
                              Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                          </div>
                      </div>
                  </div>

                  <div class="row mb-4">
                      <div class="col-md-2  pt-2 text-center">Confirm Password:<span style="color:red;"> *</span></div>
                      <div class="col-md-5 pt-2 text-center">
                          <input type="password" name="password_confirmation" id="confirmPassword" class="form-control" aria-labelledby="passwordHelpBlock" data-toggle="tooltip" data-placement="top" title="Passwords do not match" required/>
                          <div id="passwordHelpBlock" class="form-text">
                              Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                          </div>
                      </div>
                      <div class="col-md-5 text-center text-md-start mt-3">
                        <div id="errorText" style="color: red; display: none">Passwords do not match</div>
                      </div>
                  </div>
                  <div class="row mb-4">
                      <div class="col-md-2 pt-1 text-center">Barangay:</div>
                      <div class="col-md-3">
                          <select class="form-select" name="barangay_id">
                              <option value="">Select Barangay</option>
                              @foreach($barangays as $barangay)
                                  <option value="{{ $barangay['id'] }}">{{ $barangay['name'] }}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>
                  <div class="row mb-4">
                      <div class="col-md-2 pt-1 text-center">Position:<span style="color:red;"> *</span></div>
                      <div class="col-md-3">
                          <select class="form-select" name="user_type" required>
                              <option value="">Select Position</option>
                              <option value="1">Health Worker</option>
                              <option value="0">Admin</option>
                          </select>
                      </div>
                  </div>
                  <div class="row mb-4 mt-5 justify-content-center text-center">
                      <div class="col-md-3 col-lg-2 mt-1">
                          <a href="{{ route('admin.users.index') }}"><button type="button" class="btn btn-secondary cancelButton">Cancel</button></a>
                      </div>
                      <div class="col-md-3 col-lg-2 mt-1">
                          <button type="submit" class="btn submitButton">Submit</button>
                      </div>
                  </div>
              </form>

          </div>
        </div>
    </body>

<script>
    function validateForm() {
        var password = document.getElementById("inputPassword");
        var confirmPassword = document.getElementById("confirmPassword");
        var errorText = document.getElementById("errorText");

        if (password.value !== confirmPassword.value) {
            password.classList.add("error");
            confirmPassword.classList.add("error");
            errorText.style.display = "block";
            return false;
        } else {
            password.classList.remove("error");
            confirmPassword.classList.remove("error");
            errorText.style.display = "none"; 
        }

        return true;
    }


</script>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"> </script>
</html>