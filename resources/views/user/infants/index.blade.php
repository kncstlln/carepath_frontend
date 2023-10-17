<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="{{ asset('css/user/sidebar.css') }}" rel="stylesheet"/>
    <script src="{{ asset('js/sidebar.js') }}" defer></script>
    <link href="{{ asset('css/user/index.css') }}" rel="stylesheet"/>
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/r-2.5.0/datatables.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2eead9cc17.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/index.js') }}"></script>
    <title>Dashboard</title>
</head>
<body>
  @include('user.sidebar')
  <div class="container-sm mt-4 content" id="targetclientlist">

      <div class="row mb-2">
          <div class="col-sm" id="infantsTxt">List of Infants</div>
      </div>

      <div class="row mb-5">
          <div class="col-3 w-auto">
              <select class="form-select mb-3" id="barangayDropdown" aria-label=".form-select-lg example">
                  <option value="0">All Barangays</option>
                  @foreach($barangays as $barangay)
                      <option value="{{ $barangay['id'] }}">{{ $barangay['name'] }}</option>
                  @endforeach
              </select>
          </div>
          <div class="col-6 w-auto">
              <select class="form-select mb-3" id="yearDropdown" aria-label=".form-select-lg example">
                  <option value="">All Years</option>
                  @foreach($uniqueBirthYears as $year)
                      <option value="{{ $year }}">{{ $year }}</option>
                  @endforeach
              </select>
          </div>
      </div>

      <div class="row d-flex justify-content-center justify-content-md-end">
          <div class="col-12 col-sm-8 col-md-5 col-lg-3 col-xl-2 mb-3 me-2">
              <a class="btn addButton w-100" href="{{ route('user.infants.add') }}" role="button" id="button-add">Add Infant +</a>
          </div>
      </div>

      <div class="table-responsive-xl">
      <table class="table table-striped" id="myTable">
          <thead>
              <tr class="table-danger">
                  <th scope="col">No.</th>
                  <th scope="col">Barangay</th>
                  <th scope="col">Name</th>
                  <th scope="col">Birth Date</th>
                  <th scope="col">Date of Registration</th>
                  <th scope="col">Family Serial Number</th>
                  <th scope="col">Sex</th>
                  <th scope="col">Tracking Number</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
              </tr>
          </thead>
          <tbody>
              @foreach($infants as $index => $infant)
              <tr>
                  <th scope="row">{{ $index + 1 }}</th>
                  <td scope="row">
                      @foreach($barangays as $barangay)
                          @if($barangay['id'] === $infant['barangay_id'])
                              {{ $barangay['name'] }}
                          @endif
                      @endforeach
                  </td>
                  <td class="table-secondary text-uppercase">{{ $infant['name'] }}</td>
                  <td>{{ $infant['birth_date'] }}</td>
                  <td class="table-secondary">{{ $infant['created_at'] }}</td>
                  <td>{{ $infant['family_serial_number'] }}</td>
                  <td class="table-secondary">{{ $infant['sex'] }}</td>
                  <td>{{ $infant['tracking_number'] }}</td>
                  <td class="table-secondary">{{ $infant['status'] }}</td>
                  <td>
                      <table>
                          <tr>
                              <td class="text-center align-middle"><a href="/user/history/add/{{ $infant['id'] }}" style="color: black;"><i class="fa-solid fa-syringe me-2"></i></a></td>
                              <td class="text-center align-middle"><a href="/user/infants/{{ $infant['id'] }}" style="color: black;"><i class="fa-solid fa-eye me-2"></i></a></td>
                              <td class="text-center align-middle">
                                  <a href="{{ route('user.infants.edit', ['id' => $infant['id']]) }}" style="color: black;">
                                      <i class='bx bxs-pencil me-2'></i>
                                  </a>
                              </td>    
                              <td>
                                  <form method="POST" action="{{ route('user.infants.delete', ['id' => $infant['id']]) }}">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="delete-infant" onclick="return confirm('Are you sure you want to delete the data of this infant?');">
                                          <i class="fa-solid fa-trash"></i>
                                      </button>
                                  </form>
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
              @endforeach 
          </tbody>
      </table>
          
  

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/r-2.5.0/datatables.min.js"></script>

  <script>
      $(document).ready( function () {
      $('#myTable').DataTable();
  } );ç
  </script>


</body>
</html>