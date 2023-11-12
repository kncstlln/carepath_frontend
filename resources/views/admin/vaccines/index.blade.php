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
    <title>Vaccine List</title>
</head>
<body>
@include('admin/sidebar')
    <div class="container-sm mt-4 content" id="targetclientlist" >
        
        <div class="row mb-2">
            <div class="col-sm" id="VaccinesTxt">List of Vaccines</div>
        </div>

        <div class="row justify-content-center justify-content-md-end mt-5">
            <div class="col-12 col-sm-8 col-md-5 col-lg-3 col-xl-2 mb-2">
                <a class="btn addButton w-100" href="{{ route('admin.vaccines.add') }}" role="button" id="button-add">Add Vaccines +</a>
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
          <table class="table table-striped" id="myTable">
            <thead>
              <tr class="table-danger">
                <th scope="col">No.</th>
                <th scope="col">Name</th>
                <th scope="col">Short Name</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody class="table-group-divider">
              @foreach($vaccines as $vaccine)
              <tr>
                  <td scope="row">{{ $vaccine['id'] }}</td>
                  <td class="table-secondary align-middle">{{ $vaccine['name'] }}</td>
                  <td class="align-middle">{{ $vaccine['short_name'] }}</td>
                  <td class="table-secondary tableSize">
                      <select class="form-select vaccine-status" data-vaccine-id="{{ $vaccine['id'] }}" aria-label="Default select example">
                          <option value="1" {{ $vaccine['status'] == 1 ? 'selected' : '' }}>Active</option>
                          <option value="0" {{ $vaccine['status'] == 0 ? 'selected' : '' }}>Inactive</option>
                      </select>
                  </td>
                  <td class="align-middle">
                      <table style="margin: 0 auto;">
                            <tr >
                                <td class="align-middle" style="text-align: center;">
                                    <a href="{{ route('admin.vaccines.view', ['id' => $vaccine['id']]) }}"><i class="fa-solid fa-eye me-2"></i></a>
                                </td>
                                <td class="align-middle" style="text-align: center;">
                                    <a href="{{ route('admin.vaccines.edit', ['id' => $vaccine['id']]) }}"><i class='bx bxs-pencil me-2'></i></a>
                                </td>
                                <td class="align-middle" style="text-align: center;">
                                    <a href="{{ route('admin.vaccines.delete', ['id' => $vaccine['id']]) }}" class="delete-vaccine" onclick="return confirm('Are you sure you want to delete this vaccine?');">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                      </table>
                  </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
    </div>

    <script>
    // Wait for the DOM to load
    document.addEventListener('DOMContentLoaded', function () {
        // Get all vaccine status select elements
        var vaccineStatusSelects = document.querySelectorAll('.vaccine-status');

        // Attach change event listeners to each select element
        vaccineStatusSelects.forEach(function (select) {
            select.addEventListener('change', function () {
                var vaccineId = select.getAttribute('data-vaccine-id');
                var newStatus = select.value;

                // Send API request to update the status
                fetch(`/admin/vaccines/${vaccineId}/update-status`, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        status: newStatus
                    })
                })
                .then(function (response) {
                    console.log(response); // Add this line to see the response
                    if (response.ok) {
                        // Rest of your code
                    } else {
                        // Rest of your code
                    }
                })
                .catch(function (error) {
                    // Handle error
                    console.error('An error occurred', error);
                });

            });
        });
    });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/r-2.5.0/datatables.min.js"></script>
  
    
    <script>
        $(document).ready( function () {
        $('#myTable').DataTable();
        });
    </script>

    </body>
</html>