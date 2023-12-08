<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="{{ asset('css/admin/sidebar.css') }}" rel="stylesheet"/>
    <script src="{{ asset('js/sidebar.js') }}" defer></script>
    <link href="{{ asset('css/admin/index.css') }}" rel="stylesheet"/>
    <link rel="icon" type="image/x-icon" href="{{ asset('/images/logo.png') }}">
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/r-2.5.0/datatables.min.css" rel="stylesheet">
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/2eead9cc17.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/index.js') }}"></script>
    <title>Vaccine History</title>
</head>
<body>
@include('user.sidebar')
<div class="container-sm content mt-4" id="vaccineHistory">
    <div class="row mb-2">
        <div class="col-sm" id="vaccineHistoryTxt">Vaccine History</div>
    </div>

    <div class="row justify-content-center justify-content-md-between">
            <div class="col-12 col-sm-8 col-md-5 col-lg-3 col-xl-2 mb-3 me-2">
                <a class="btn addButton w-100" role="button" id="button-export" style="border:solid">Export To Excel</a>
            </div>
            <!-- <div class="col-12 col-sm-8 col-md-5 col-lg-3 col-xl-2 mb-3 me-2">
                <a class="btn addButton w-100"  role="button" id="button-add">Add Infant +</a>
            </div> -->
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

    <div class="row d-flex justify-content-center justify-content-md-end">
        <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-3 mb-3 me-2">
            <a class="btn addButton w-100" href="{{ route('user.other-barangay-infants') }}" role="button" id="button-add">Vaccinate Other Barangay's Infant</a>
        </div>
    </div>

    <div class="table-responsive-lg" id="filteredImmunizationRecords">
        <table class="table table-striped align-middle" id="myHistory">
            <thead>
                <tr class="table-danger">
                    <th scope="col">Immunization Date</th>
                    <th scope="col">Name</th>
                    <th scope="col">Vaccine</th>
                    <th scope="col">Dose Number</th>
                    <th scope="col">Administered In</th>
                    <th scope="col">Administered By</th>
                    <th scope="col">Remarks</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($responseRecords['data']))
                    @foreach($responseRecords['data'] as $record)
                        <tr>
                            <td>{{ $record['immunization_date'] }}</td>
                            <td class="text-uppercase"><b>{{ $record['infant_name'] }}</b></td>
                            <td>{{ $record['vaccine_name'] }}</td>
                            <td>{{ $record['dose_number'] }}</td>
                            <td>{{ $allBarangays[$record['barangay_id']] }}</td>
                            <td>{{ $record['administered_by'] }}</td>
                            <td>{{ $record['remarks'] ?? '-' }}</td>
                            <td>
                                <table style="margin: 0 auto;">
                                    <tr>
                                        <td class="text-center align-middle">
                                            <button class="deleteButton" data-record-id="{{ $record['id'] }}" style="border:none; background:transparent">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                            </td>

                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>No data available.</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/r-2.5.0/datatables.min.js"></script>

<script>
    $(document).ready(function () {
 
        let searchInputsContainer = $('<div class="search-inputs row mb-3"></div>');
    searchInputsContainer.insertBefore('#filteredImmunizationRecords');

    $('#myHistory').DataTable({
        "order": [
            [0, "asc"],
            [1, "desc"]
        ],
        "initComplete": function () {
            this.api().columns().every(function () {
                let column = this;
                let title = column.header().textContent;

           
                if (title.toLowerCase() !== 'action') {
                    let searchInputColumn = $('<div class="col"></div>');

                    if (title.toLowerCase() === 'immunization date') {
                        searchInputColumn = $('<div class="col-2"></div>');
                    }

                    searchInputsContainer.append(searchInputColumn);

                    let input;

                    if (title.toLowerCase() === 'immunization date') {
                        input = document.createElement('input');
                        input.className = 'form-control';
                        input.type = 'date';
                    } else {
                        input = document.createElement('input');
                        input.className = 'form-control';
                    }

                    input.placeholder = title;

                    searchInputColumn.append(input);

                    input.addEventListener('input', () => {
                        if (column.search() !== input.value) {
                            column.search(input.value).draw();
                        }
                    });
                }
            });
        },
        "dom": "lrtip"
        });
    });



    function attachDeleteButtonListeners() {
        const deleteButtons = document.querySelectorAll('.deleteButton');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const recordId = this.getAttribute('data-record-id');

                if (confirm('Are you sure you want to delete this history record?')) {
                    // Make an AJAX request to delete the infant record
                    fetch(`/user/history/delete/${recordId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Remove the row from the table
                            const grandparentRow = this.closest('tr').closest('table').closest('tr');
                            grandparentRow.remove();
                        } else {
                            alert('Failed to delete the record. Please try again.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                }
            });
        });
    }

        function convertJSONToCSV(data) {
            const table = document.getElementById('myHistory');
            const headers = Array.from(table.querySelectorAll('thead th')).map(th => th.textContent.trim());

            const rows = Array.from(table.querySelectorAll('tbody tr'));
            const csvRows = rows.map(row => {
                const cells = Array.from(row.children);
                // Exclude the last column (Action) from the map
                const csvValues = cells.slice(0, -1).map(cell => {
                    let value = cell.textContent.trim();
                    // Check if the value contains a comma and wrap it in double quotes
                    if (value.includes(',')) {
                        value = `"${value}"`;
                    }
                    return value;
                });

                return csvValues.join(',');
            });

            return [headers.slice(0, -1).join(','), ...csvRows].join('\n'); // Exclude the last header (Action) as well
        }

        document.getElementById('button-export').addEventListener('click', function () {
            // Fetch the current data from the DataTable
            const table = $('#myHistory').DataTable();
            const data = table.data().toArray();

            if (data.length > 0) {
                // Here, convert the data to CSV format
                const csvContent = convertJSONToCSV(data);
                downloadCSV(csvContent, 'myHistory.csv');
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
