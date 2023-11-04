<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/r-2.5.0/datatables.min.css" rel="stylesheet">
    <link href="css/admin/sidebar.css" rel="stylesheet"/>
    <script src="js/sidebar.js" defer></script>
    <link href="css/admin/dashboard.css" rel="stylesheet"/>
    <link href="css/admin/vaccine.css" rel="stylesheet"/>
    <link href="css/admin/brgySelect.css" rel="stylesheet"/>
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="{{ asset('/images/logo.png') }}">
    <script src="https://kit.fontawesome.com/2eead9cc17.js" crossorigin="anonymous"></script>
    <script src="js/dashboard.js"></script>
    <title>Upcoming Vaccination</title>
</head>
<body>
@include('admin/sidebar')
    <div class="container-sm mt-4 content" id="targetclientlist">
        <div class="row mb-2">
            <div class="col-sm" id="infantsTxt">Vaccinations for the Upcoming Week</div>
        </div>
        <div class="row mb-5">
            <!-- <select class="form-select form-select-lg mb-3 selectSize" aria-label=".form-select-lg example">
                <option selected value="1">Lourdes NorthWest</option>
                <option value="2">Ninoy Aquino(Marisol)</option>
                <option value="3">Salapungan</option>
            </select> -->
        </div>
        <div class="table-responsive-lg">
        <table class="table table-striped" id="upcomingTable">
            <thead>
                <tr class="table-danger">
                    <th scope="col">Barangay</th>
                    <th scope="col">Infant</th>
                    <th scope="col">Birth Date</th>
                    <th scope="col">Vaccine/s</th>
                    <th scope="col">Dose</th>
                    <th scope="col">Vaccination Day</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($upcomingVaccination as $vaccination)
                <tr>
                    <td class="align-middle">{{ $vaccination['barangay_name'] }}</td>
                    <td class="table-secondary align-middle"><b>{{ $vaccination['infant_name'] }}</b></td>
                    <td class="align-middle">{{ $vaccination['birth_date'] }}</td>
                    <td class="table-secondary align-middle">{{ $vaccination['vaccine_name'] }}</td>
                    <td class="align-middle">{{ $vaccination['dose_number'] }}</td>
                    <td class="table-secondary align-middle">{{ $vaccination['vaccination_date'] }}</td>
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
        $('#upcomingTable').DataTable();
      });
    </script> 
    
  </body>
</html>