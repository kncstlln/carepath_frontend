@include('admin/head')
<title>Edit User</title>   
<body>
@include('admin/sidebar')
  <div class="container-sm content mt-4">
      <div class="row">
          <div class="col-sm mb-5" id="infantsTxt">Edit User</div>
      </div>
      <div class="container-sm createRecord">
          <div class="row">
              <div class="col h2 mb-5 mt-3 text-center">Edit User</div>
          </div>
          <form action="{{ route('admin.users.update', ['id' => $user['id']]) }}" method="POST">
              @csrf
              @method('PUT')
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
                  <div class="col-md-2 pt-1 text-center">Full Name:</div>
                  <div class="col-md-3">
                      <input class="form-control" name="name" type="text" placeholder="Name" aria-label="default input" value="{{ $user['name'] }}" required/>
                  </div>
              </div>
              <div class="row mb-4">
                  <div class="col-md-2 pt-1 text-center">Username:</div>
                  <div class="col-md-3">
                      <input class="form-control" name="username" type="text" placeholder="Username" aria-label="default input" value="{{ $user['username'] }}" required/>
                  </div>
              </div>
              <div class="row mb-4">
                  <div class="col-md-2 pt-1 text-center">Email:</div>
                  <div class="col-md-3">
                      <input class="form-control" name="email" type="email" placeholder="Email" aria-label="default input" value="{{ $user['email'] }}" required/>
                  </div>
              </div>
              <div class="row mb-4">
                      <div class="col-md-2 pt-1 text-center">Position:<span style="color:red;"> *</span></div>
                      <div class="col-md-3">
                          <select class="form-select" id="position" name="user_type" required>
                          <option value="">Select Position</option>
                          <option value="1" {{ $user['user_type'] === 1 ? 'selected' : '' }}>Health Worker</option>
                          <option value="0" {{ $user['user_type'] === 0 ? 'selected' : '' }}>Admin</option>
                          </select>
                      </div>
                  </div>
                  <div class="row mb-4">
                    <div class="col-md-2 pt-1 text-center" id="barangayRow" style="display: none;">Barangay:<span style="color:red;"> *</span></div>
                    <div class="col-md-3" id="selectBarangay" style="display: none;">
                        <select class="form-select" name="barangay_id">
                            <option value="">Select Barangay</option>
                            @foreach($barangays as $barangay)
                            <option value="{{ $barangay['id'] }}" {{ $barangay['id'] === $user['barangay_id'] ? 'selected' : '' }}>{{ $barangay['name'] }}</option>
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

    var letterRegex = /[a-zA-Z]/;
    var numberRegex = /[0-9]/;
    var spaceRegex = /\s/;
    var emojiRegex = /[\uD800-\uDBFF][\uDC00-\uDFFF]/;


    if (password === confirmPassword) {
        confirmPasswordInput.style.borderColor = "";
        errorText.style.display = "none";
    } else {
        confirmPasswordInput.style.borderColor = "red";
        errorText.style.display = "block";
    }

    if (password.length >= 8 && password.length <= 20 && letterRegex.test(password) && numberRegex.test(password) && !spaceRegex.test(password) && !emojiRegex.test(password)) {
        return true;
    } else {
        alert("Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces or emoji.");
        passwordInput.value = "";
        return false;
    }
    }
document.querySelector("form").addEventListener("submit", function(event) {
  if (!validatePassword()) {
    event.preventDefault(); 
  }
});

document.getElementById("confirmPassword").addEventListener("input", validatePassword);
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"> </script>

</body>
</html>