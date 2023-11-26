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
        <div class="container-sm content mt-4 mb-5">
            <div class="row">
                <div class="col-sm mb-5" id="infantsTxt">Add User</div>
            </div>
            <div class="container-sm createRecord">
                <div class="row">
                    <div class="col h2 mb-5 mt-3 text-center">Add User</div>
                </div>
                <form action="{{ route('admin.users.register') }}" method="POST" onsubmit="return validateForm()">
                @csrf
                @if(session('error'))
                    <div class="alert alert-danger" id="error-message">
                        {{ session('error') }}
                    </div>

                    <script>
                        setTimeout(function() {
                            document.getElementById('error-message').style.display = 'none';
                        }, 3000);
                    </script>
                @endif
                  <div class="row mb-4">
                      <div class="col-md-2 pt-1 text-center">Full Name:<span style="color:red;"> *</span></div>
                      <div class="col-md-3">
                          <input class="form-control" name="name" min="" type="text" placeholder="Name" aria-label="default input" required/>
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
                      <div class="col-md-5 col-lg-3 pt-2 text-center">
                          <input type="password" name="password" id="inputPassword" class="form-control" aria-labelledby="passwordHelpBlock"required/>
                          <div id="passwordHelpBlock" class="form-text">
                              Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces or emoji.
                          </div>
                      </div>
                  </div>

                  <div class="row mb-4">
                      <div class="col-md-2  pt-2 text-center">Confirm Password:<span style="color:red;"> *</span></div>
                      <div class="col-md-5 col-lg-3 pt-2 text-center">
                          <input type="password" name="password_confirmation" id="confirmPassword" class="form-control" aria-labelledby="passwordHelpBlock" data-toggle="tooltip" data-placement="top" title="Passwords do not match" required/>
                      </div>
                      <div class="col-md-5 text-center text-md-start mt-3">
                        <div id="errorText" style="color: red; display: none">Passwords do not match</div>
                      </div>
                  </div>
                  <div class="row mb-4">
                      <div class="col-md-2 pt-1 text-center">Position:<span style="color:red;"> *</span></div>
                      <div class="col-md-3">
                          <select class="form-select" id="position" name="user_type" required>
                              <option value="">Select Position</option>
                              <option value="1">Health Worker</option>
                              <option value="0">Admin</option>
                          </select>
                      </div>
                  </div>
                  <div class="row mb-4">
                    <div class="col-md-2 pt-1 text-center" id="barangayRow" style="display: none;">Barangay:<span style="color:red;"> *</span></div>
                    <div class="col-md-3" id="selectBarangay" style="display: none;">
                        <select class="form-select" name="barangay_id">
                            <option value="">Select Barangay</option>
                            @foreach($barangays as $barangay)
                                <option value="{{ $barangay['id'] }}">{{ $barangay['name'] }}</option>
                            @endforeach
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
    const positionSelect = document.getElementById('position');
    const barangayRow = document.getElementById('barangayRow');
    const barangaySelect = document.getElementById('selectBarangay');

    positionSelect.addEventListener('change', function() {
        if (positionSelect.value === '1') {
            barangayRow.style.display = 'block';
            barangaySelect.style.display = 'block';
        } else {
            barangayRow.style.display = 'none';
            barangaySelect.style.display = 'none';
        }
    });
</script>

<script>
function validatePassword() {
  var passwordInput = document.getElementById("inputPassword");
  var confirmPasswordInput = document.getElementById("confirmPassword");
  var errorText = document.getElementById("errorText");
  var password = passwordInput.value;
  var confirmPassword = confirmPasswordInput.value;

  // Define regular expressions for letters and numbers
  var letterRegex = /[a-zA-Z]/;
  var numberRegex = /[0-9]/;
  var spaceRegex = /\s/; // Regular expression to check for spaces
  var emojiRegex = /[\uD800-\uDBFF][\uDC00-\uDFFF]/; // Regular expression to check for emojis

  // Check if passwords match
  if (password === confirmPassword) {
    // Passwords match, remove focus ring and message
    confirmPasswordInput.style.borderColor = "";
    errorText.style.display = "none";
  } else {
    // Passwords don't match, add focus ring and display message
    confirmPasswordInput.style.borderColor = "red";
    errorText.style.display = "block";
  }

  // Your existing password validation code here

  // Check other password criteria
  if (password.length >= 8 && password.length <= 20 && letterRegex.test(password) && numberRegex.test(password) && !spaceRegex.test(password) && !emojiRegex.test(password)) {
    // Password meets all criteria
    return true;
  } else {
    // Password does not meet the criteria
    alert("Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces or emoji.");
    passwordInput.value = ""; // Clear the input field
    return false;
  }
}

// Add an event listener to the form to call the validatePassword function when the form is submitted
document.querySelector("form").addEventListener("submit", function(event) {
  if (!validatePassword()) {
    event.preventDefault(); 
  }
});

// Add an event listener to the confirmPassword input to call the validatePassword function when its value changes
document.getElementById("confirmPassword").addEventListener("input", validatePassword);
</script>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"> </script>
</html>