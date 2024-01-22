@include('admin/head')
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
        const passwordInput = document.getElementById('inputPassword');
        const confirmPasswordInput = document.getElementById('confirmPassword');
        const errorText = document.getElementById('errorText');

        positionSelect.addEventListener('change', function() {
            if (positionSelect.value === '1') {
                barangayRow.style.display = 'block';
                barangaySelect.style.display = 'block';
            } else {
                barangayRow.style.display = 'none';
                barangaySelect.style.display = 'none';
            }
        });

        function validateForm() {
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;

            // Check if passwords match
            if (password !== confirmPassword) {
                errorText.textContent = 'Passwords do not match';
                errorText.style.display = 'block';
                confirmPasswordInput.classList.add('error');
                return false;
            }

            // Check if the password meets the criteria
            const passwordRegex = /^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]{8,20}$/;

            if (!password.match(passwordRegex)) {
                errorText.textContent = 'Password must be 8-20 characters long, contain letters and numbers, and must not contain spaces or emoji.';
                errorText.style.display = 'block';
                confirmPasswordInput.classList.add('error');
                return false;
            }

            // Passwords match and meet the criteria
            errorText.style.display = 'none';
            confirmPasswordInput.classList.remove('error');
            return true;
        }

        confirmPasswordInput.addEventListener('input', function() {
            errorText.style.display = 'none';
            confirmPasswordInput.classList.remove('error');
        });
    </script>





  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"> </script>
</html>