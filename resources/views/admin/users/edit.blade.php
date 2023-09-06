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
    <script src="{{ asset('js/index.js') }}"></script>
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/2eead9cc17.js" crossorigin="anonymous"></script>
    <title>Add Infant</title>    
</head>
<body>
@include('admin/sidebar')
  <div class="container-sm mt-4">
      <div class="row">
          <div class="col-sm mb-5" id="infantsTxt">Edit User</div>
      </div>
      <div class="container-sm createRecord">
          <div class="row">
              <div class="col h2 mb-5 mt-3 text-center">Edit User</div>
          </div>
          <form action="" method="PUT">
              @csrf
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
              <!-- ... (other form fields) ... -->
              <div class="row mb-4">
                  <div class="col-md-2 pt-1 text-center">Barangay:</div>
                  <div class="col-md-3">
                      <select class="form-select" name="barangay_id" required>
                          <option value="">Select Barangay</option>
                          @foreach($barangays as $barangay)
                              <option value="{{ $barangay['id'] }}" {{ $barangay['id'] === $user['barangay_id'] ? 'selected' : '' }}>{{ $barangay['name'] }}</option>
                          @endforeach
                      </select>
                  </div>
              </div>
              <div class="row mb-4">
                  <div class="col-md-2 pt-1 text-center">Position:</div>
                  <div class="col-md-3">
                      <select class="form-select" name="user_type" required>
                          <option value="">Select Position</option>
                          <option value="1" {{ $user['user_type'] === 1 ? 'selected' : '' }}>Health Worker</option>
                          <option value="10" {{ $user['user_type'] === 10 ? 'selected' : '' }}>Admin</option>
                      </select>
                  </div>
              </div>
              <!-- ... (other form fields) ... -->
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"> </script>
</html>