<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/r-2.5.0/datatables.min.css" rel="stylesheet">
    <link href="{{ asset('css/admin/sidebar.css') }}" rel="stylesheet"/>
    <script src="{{ asset('js/admin/sidebar.js') }}" defer></script>
    <link href="{{ asset('css/admin/dashboard.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/admin/index.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/admin/vaccine.css') }}" rel="stylesheet"/>
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/2eead9cc17.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/admin/dashboard.js') }}"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('/images/logo.png') }}">
    <title>Barangay List</title>
</head>
<body>
@include('admin/sidebar')
         
    <div class="container-sm content mt-4" id="targetclientlist">
        <div class="row mb-2">
            <div class="col-sm" id="infantsTxt">List of Barangay</div>
        </div>
        <div class="row justify-content-center justify-content-lg-end mt-5">
            <div class="col-12 col-sm-8 col-md-5 col-lg-3 col-xl-2 mb-2">
                <a class="btn addButton w-100" href="{{ route('admin.barangays.add') }}" role="button" id="button-add">Add Barangay +</a>
            </div>
        </div>
        <div class="table-responsive-xl">
          <table class="table table-striped" id="barangayList">
            <thead>
              <tr class="table-danger">
                <th scope="col">No.</th>
                <th scope="col">Barangay</th>
                <th scope="col">Location</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody class="table-group-divider">
              @foreach($barangays as $barangay)
              <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td class="table-secondary align-middle">{{ $barangay['name'] }}</td>
                  <td class="align-middle">{{ $barangay['location'] }}</td>
                  <td class="table-secondary tableSize">
                      <form action="{{ route('admin.barangays.update-status', $barangay['id']) }}" method="POST">
                          @csrf
                          @method('PUT')
                          <select name="status" class="form-select" aria-label="Default select example" onchange="this.form.submit()">
                              <option value="1" {{ $barangay['status'] == 1 ? 'selected' : '' }}>Active</option>
                              <option value="0" {{ $barangay['status'] == 0 ? 'selected' : '' }}>Inactive</option>
                          </select>
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
        $('#barangayList').DataTable();
      });
    </script> 
</body>
]</html>