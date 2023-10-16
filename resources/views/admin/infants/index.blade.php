<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="{{ asset('css/admin/sidebar.css') }}" rel="stylesheet"/>
    <script src="{{ asset('js/sidebar.js') }}" defer></script>
    <link href="{{ asset('css/admin/index.css') }}" rel="stylesheet"/>
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/r-2.5.0/datatables.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('/images/logo.png') }}">
    <script src="https://kit.fontawesome.com/2eead9cc17.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/index.js') }}"></script>
    <title>Infants</title>
</head>
<body>
@include('admin.sidebar')
<div class="container-sm mt-4 content" id="targetclientlist" style="border:1px solid red">

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
        <div class="col-12 col-sm-8 col-md-5 col-lg-3 col-xl-2 mb-3 me-2" style="border:1px solid red">
            <a class="btn addButton w-100" href="{{ route('admin.infants.add') }}" role="button" id="button-add">Add Infant +</a>
        </div>
    </div>

    <div class="table-responsive-xl" id="filteredInfants">

    </div>
    
        
 

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/r-2.5.0/datatables.min.js"></script>

<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );ç
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const barangayDropdown = document.querySelector('#barangayDropdown');
        const yearDropdown = document.querySelector('#yearDropdown');
        const filteredInfantsDiv = document.querySelector('#filteredInfants');

        // Function to fetch filtered infants and update the table
        function fetchFilteredInfants(barangayId, year) {
            const url = `/admin/getFilteredInfants/${barangayId}/${year}`;
            fetch(url)
              .then(response => response.json()) // Parsing JSON response
              .then(data => {
                  console.log('Received data:', data);
                  // Generate HTML for the table
                  const tableHtml = generateTableHtml(data);
                  filteredInfantsDiv.innerHTML = tableHtml;

                  // Attach click event listeners to delete buttons
                  attachDeleteButtonListeners();

                  $('#myTable').DataTable();
              })
              .catch(error => {
                  console.error('Error:', error);
            });
        }

        // Function to generate HTML for the table
        function generateTableHtml(data) {
            let tableHtml = `
                <table class="table table-striped" id="myTable">
                    <thead>
                        <tr class="table-danger">
                            <th scope="col">No.</th>
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
            `;

            if (Array.isArray(data.data) && data.data.length > 0) {
                data.data.forEach((infant, index) => {
                    tableHtml += `
                    <tr>
                        <th scope="row">${index + 1}</th>
                        <td class="table-secondary text-uppercase">kane ERRYL GARCIA CASTILLANO</td>
                        <td>${infant.birth_date}</td>
                        <td class="table-secondary">${infant.created_at}</td>
                        <td>12312</td>
                        <td class="table-secondary">Female</td>
                        <td>${infant.tracking_number}</td>
                        <td class="table-secondary">${infant.status}</td>
                        <td>
                            <table>
                                <tr>
                                    <td class="text-center align-middle"><a href="/admin/history/add/${infant.id}"><i class="fa-solid fa-syringe me-2"></i></a>
                                    <td class="text-center align-middle"><a href="/admin/infants/${infant.id}"><i class="fa-solid fa-eye me-2"></i></a></td>
                                    <td class="text-center align-middle">
                                        <a href="/admin/infants/edit/${infant.id}">
                                            <i class='bx bxs-pencil me-2'></i>
                                        </a>
                                    </td>    
                                    <td class="text-center align-middle"><button class="deleteButton" data-infant-id="${infant.id}" style="border:none; background: transparent;"><i class="fa-solid fa-trash"></i></button></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    `;
                });
            } else {
                tableHtml += `
                    <tr>
                        <td colspan="9">No data available.</td>
                    </tr>
                `;
            }

            tableHtml += `
                    </tbody>
                </table>
            `;

            return tableHtml;
        }

        // Function to attach click event listeners to delete buttons
        function attachDeleteButtonListeners() {
            const deleteButtons = document.querySelectorAll('.deleteButton');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const infantId = this.getAttribute('data-infant-id');
                    
                    if (confirm('Are you sure you want to delete this infant record?')) {
                        // Make an AJAX request to delete the infant record
                        fetch(`/admin/infants/delete/${infantId}`, {
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
                                alert('Failed to delete infant record. Please try again.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                    }
                });
            });
        }

        // Event listener for the barangayDropdown change
        barangayDropdown.addEventListener('change', function () {
            const selectedBarangayId = this.value;
            const selectedYear = yearDropdown.value; // Get the selected year

            // Fetch filtered infants based on the selected barangay and year
            fetchFilteredInfants(selectedBarangayId, selectedYear);
        });

        // Event listener for the yearDropdown change
        yearDropdown.addEventListener('change', function () {
            const selectedYear = this.value;
            const selectedBarangayId = barangayDropdown.value; // Get the selected barangay

            // Fetch filtered infants based on the selected barangay and year
            fetchFilteredInfants(selectedBarangayId, selectedYear);
        });

        // Initial load with all data
        fetchFilteredInfants(0, '');
    });
</script>


</body>
</html>
