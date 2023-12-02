<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/r-2.5.0/datatables.min.css" rel="stylesheet">
    <link href="{{ asset('css/admin/sidebar.css') }}" rel="stylesheet"/>
    <script src="{{ asset('js/sidebar.js') }}" defer></script>
    <link href="{{ asset('css/admin/dashboard.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/admin/vaccine.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/admin/index.css') }}" rel="stylesheet"/>
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/2eead9cc17.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('/images/logo.png') }}">
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <title>Users List</title>
</head>
<body>
@include('admin/sidebar')
    <div class="container-sm content mt-4" id="targetclientlist">
      <div class="row mb-2">
          <div class="col-sm" id="infantsTxt">List of User</div>
      </div>
      <div class="row justify-content-center justify-content-md-end mt-5">
          <div class="col-12 col-sm-8 col-md-5 col-lg-3 col-xl-2 mb-2">
              <a class="btn addButton w-100" href="{{ route('admin.users.add') }}" role="button" id="button-add">Add Users +</a>
          </div>
      </div>

      @if(session('success'))
      <div class="alert alert-success" id="success-message">
          {{ session('success') }}
      </div>

      <script>
          setTimeout(function() {
              document.getElementById('success-message').style.display = 'none';
          }, 3000);
      </script>
      @endif
      <div class="table-responsive-xl">
        <table class="table table-striped" id="userList">
          <thead>
            <tr class="table-danger">
              <th scope="col">No.</th>
              <th scope="col">Location</th>
              <th scope="col">Username</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Position</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            @foreach($users as $key => $user)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td class="align-middle">
                        @if(isset($user['barangay']))
                            {{ $user['barangay']['name'] }}
                        @else
                            <!-- Leave it as a blank -->
                        @endif
                    </td>
                    <td class="table-secondary align-middle">{{ $user['username'] }}</td>
                    <td class="table-secondary align-middle">{{ $user['name'] }}</td>
                    <td class="table-secondary align-middle">{{ $user['email'] }}</td>
                    <td class="table-secondary">{{ $user['user_type'] === 0 ? 'Admin' : 'Health Worker' }}</td>
                    <td class="align-middle d-flex justify-content-center">
                        <a href="{{ route('admin.users.edit', ['id' => $user['id']]) }}" class="my-auto"><i class='bx bxs-pencil me-2'></i></a>
                        <form action="{{ route('admin.users.delete', ['id' => $user['id']]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link" onclick="return confirm('Are you sure you want to delete this user?')"><i class="fa-solid fa-trash" style="color: black; "></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
      
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
      <script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/r-2.5.0/datatables.min.js"></script>

      <script>
        $(document).ready( function () {
          $('#userList').DataTable();
        });
      </script> 

      </body>
</html>