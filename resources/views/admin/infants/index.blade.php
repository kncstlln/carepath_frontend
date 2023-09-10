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
    <script src="https://kit.fontawesome.com/2eead9cc17.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/index.js') }}"></script>
    <title>Dashboard</title>
</head>
<body>
@include('admin.sidebar')
<div class="container-sm mt-4" id="targetclientlist">
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
    <div class="row d-flex justify-content-end">
        <div class="col-7 d-flex justify-content-end">
            <a class="btn btn-lg mb-4 addButton" href="addInfant" role="button" id="button-add">Add Infant +</a>
        </div>
    </div>
</div>
<div class="container-md">
    <div class="table-responsive-lg text-center align-middle" id="filteredInfants">
        <!-- Filtered infants will be displayed here -->
    </div>
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center justify-content-md-end mt-4">
            <li class="page-item disabled">
                <a class="page-link paginationTxt">Previous</a>
            </li>
            <li class="page-item"><a class="page-link paginationTxt" href="#">1</a></li>
            <li class="page-item"><a class="page-link paginationTxt" href="#">2</a></li>
            <li class="page-item"><a class="page-link paginationTxt" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link paginationTxt" href="#">Next</a>
            </li>
        </ul>
    </nav>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
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
              })
              .catch(error => {
                  console.error('Error:', error);
            });
        }

        // Function to generate HTML for the table
        function generateTableHtml(data) {
            let tableHtml = `
                <table class="table table-striped">
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

            if (Array.isArray(data.data) && data.data.length > 0) { // Access data.data here
                data.data.forEach((infant, index) => {
                    tableHtml += `
                        <tr>
                            <th scope="row">${index + 1}</th>
                            <td class="table-secondary">${infant.name}</td>
                            <td>${infant.birth_date}</td>
                            <td class="table-secondary">${infant.created_at}</td>
                            <td>${infant.family_serial_number}</td>
                            <td class="table-secondary">${infant.sex}</td>
                            <td>${infant.tracking_number}</td>
                            <td class="table-secondary">${infant.status}</td>
                            <td>
                                <table>
                                    <tr>
                                        <td class="text-center align-middle"><a href="viewInfant"><i class="fa-solid fa-eye me-2"></i></a></td>
                                        <td class="text-center align-middle"><a href="editInfant"><i class='bx bxs-pencil me-2'></i></a></td>
                                        <td class="text-center align-middle"><i class="fa-solid fa-trash"></i></td>
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
