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
    <link rel="icon" type="image/x-icon" href="{{ asset('/images/logo.png') }}">
    <script src="https://kit.fontawesome.com/2eead9cc17.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/index.js') }}"></script>
    <title>Infants</title>
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
        <div class="row justify-content-sm-center justify-content-lg-between">
            <div class="col-12 col-sm-8 col-md-6 col-lg-4 col-xl-3 mb-4">
                <input class="form-control" type="text" placeholder="Search.." aria-label="default input example">
            </div>

            <div class="col-12 col-sm-8 col-md-5 col-lg-3 col-xl-2 mb-2 me-2" cstyle="border:1px solid red;">
                <a class="btn addButton w-100" href="{{ route('admin.infants.add') }}" role="button" id="button-add">Add Infant +</a>
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

                  // Attach click event listeners to delete buttons
                  attachDeleteButtonListeners();
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

            if (Array.isArray(data.data) && data.data.length > 0) {
                data.data.forEach((infant, index) => {
                    tableHtml += `
                        <tr>
                            <th scope="row">${index + 1}</th>
                            <td class="table-secondary text-uppercase">${infant.name}</td>
                            <td>${infant.birth_date}</td>
                            <td class="table-secondary">${infant.created_at}</td>
                            <td>${infant.family_serial_number}</td>
                            <td class="table-secondary">${infant.sex}</td>
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
                                        <td class="text-center align-middle"><button data-infant-id="${infant.id}" style="border: none; background-color: transparent;"><i class="fa-solid fa-trash"></i></button></td>
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
