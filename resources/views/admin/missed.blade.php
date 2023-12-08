<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/r-2.5.0/datatables.min.css" rel="stylesheet">
    <link href="css/admin/sidebar.css" rel="stylesheet"/>
    <script src="js/sidebar.js" defer></script>
    <link href="{{ asset('css/admin/index.css') }}" rel="stylesheet"/>
    <link href="css/admin/dashboard.css" rel="stylesheet"/>
    <link href="css/admin/vaccine.css" rel="stylesheet"/>
    <link href="css/admin/brgySelect.css" rel="stylesheet"/>
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="{{ asset('/images/logo.png') }}">
    <script src="https://kit.fontawesome.com/2eead9cc17.js" crossorigin="anonymous"></script>
    <script src="js/dashboard.js"></script>
    <title>Missed Vaccinations</title>
</head>
<body>
  @include('admin/sidebar')
    <div class="container-md mt-4 content" id="targetclientlist">
        <div class="row mb-2">
            <div class="col-sm" id="infantsTxt">Missed Vaccinations</div>
        </div>

        <div class="row justify-content-center justify-content-md-between">
            <div class="col-12 col-sm-8 col-md-5 col-lg-3 col-xl-2 mb-3 me-2">
                <a class="btn addButton w-100" role="button" id="button-export" style="border:solid">Export To Excel</a>
            </div>
            <!-- <div class="col-12 col-sm-8 col-md-5 col-lg-3 col-xl-2 mb-3 me-2">
                <a class="btn addButton w-100"  role="button" id="button-add">Add Infant +</a>
            </div> -->
        </div>

        <div class="table-responsive-lg">
          <table class="table table-striped" id="missedTable" >
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
                  @foreach ($missedVaccination as $vaccination)
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
        $(document).ready(function () {
   
        let searchInputsContainer = $('<div class="search-inputs row mb-3"></div>');
        searchInputsContainer.insertBefore('#missedTable');

        $('#missedTable').DataTable({
            "initComplete": function () {
                let table = this;

                table.api()
                    .columns()
                    .every(function () {
                        let column = this;
                        let title = column.header().textContent;

             
                        let searchInputColumn = $('<div class="col"></div>');

                    
                        if (title.toLowerCase() === 'birth date') {
                            searchInputColumn = $('<div class="col-2"></div>');
                        }

                        if (title.toLowerCase() === 'dose') {
                            searchInputColumn = $('<div class="col-1"></div>');
                        }

                        searchInputsContainer.append(searchInputColumn);

                     
                        let input;

                        
                        if (title.toLowerCase() === 'birth date') {
                            input = document.createElement('input');
                            input.className = 'form-control';
                            input.type = 'date';
                        } else {
                            input = document.createElement('input');
                            input.className = 'form-control';
                        }

                        input.placeholder = title;

                 
                        searchInputColumn.append(input);

                        $(input).on('keyup change clear', function () {
                            if (column.search() !== this.value) {
                                column.search(this.value).draw();
                            }
                        });
                    });
            }
        });
    });



        
        function convertJSONToCSV(data) {
            const table = document.getElementById('missedTable');
            const headers = Array.from(table.querySelectorAll('thead th')).map(th => th.textContent.trim());

            const rows = Array.from(table.querySelectorAll('tbody tr'));
            const csvRows = rows.map(row => {
                const cells = Array.from(row.children);
                const csvValues = cells.map(cell => {
                    let value = cell.textContent.trim();
                    // Check if the value contains a comma and wrap it in double quotes
                    if (value.includes(',')) {
                        value = `"${value}"`;
                    }
                    return value;
                });

                return csvValues.join(',');
            });

            return [headers.join(','), ...csvRows].join('\n')
        }

        document.getElementById('button-export').addEventListener('click', function () {
            // Fetch the current data from the DataTable
            const table = $('#missedTable').DataTable();
            const data = table.data().toArray();

            if (data.length > 0) {
                // Here, convert the data to CSV format
                const csvContent = convertJSONToCSV(data);
                downloadCSV(csvContent, 'missedTable.csv');
            } else {
                alert('No data available for export.');
            }
        });

        function downloadCSV(content, fileName) {
            const blob = new Blob([content], { type: 'text/csv' });
            const link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = fileName;
            link.click();
        }
    </script>
  </body>
</html>