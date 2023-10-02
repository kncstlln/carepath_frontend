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
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/2eead9cc17.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/index.js') }}"></script>
    <title>Vaccine History</title>
</head>
<body>
@include('admin.sidebar')
<div class="container-sm mt-4" id="vaccineHistory">
    <div class="row mb-2">
        <div class="col-sm" id="vaccineHistoryTxt">Vaccine History</div>
    </div>
    <div class="row mb-5">
        <div class="col-3 w-auto">
            <select class="form-select mb-3" id="barangayDropdown" aria-label=".form-select-lg example">
                <option value="0">All Barangays</option>
                @foreach($allBarangays as $barangayId => $barangayName)
                    <option value="{{ $barangayId }}">{{ $barangayName }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6 w-auto">
            <select class="form-select mb-3" id="yearDropdown" aria-label=".form-select-lg example">
                <option value="">All Years</option>
                @foreach($uniqueImmunizationYears as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="container-md">
    <div class="row justify-content-sm-center justify-content-lg-between">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4 col-xl-3 mb-4">
            <input class="form-control" type="text" placeholder="Search.." aria-label="default input example">
        </div>

    </div>
    <div class="table-responsive-lg text-center align-middle" id="filteredImmunizationRecords">
        <!-- Filtered immunization records will be displayed here -->
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const barangayDropdown = document.querySelector('#barangayDropdown');
        const yearDropdown = document.querySelector('#yearDropdown');
        const filteredImmunizationRecordsDiv = document.querySelector('#filteredImmunizationRecords');

        const barangayNameMapping = {
            @foreach($allBarangays as $barangayId => $barangayName)
                {{ $barangayId }}: "{{ $barangayName }}",
            @endforeach
        };

        // Function to fetch filtered immunization records and update the table
        // Function to fetch filtered immunization records and update the table
        function fetchFilteredImmunizationRecords(barangayId, year) {
            const url = `/admin/history/filtered-records/${barangayId}/${year}`;
            fetch(url)
                .then(response => response.json()) // Parsing JSON response
                .then(data => {
                    console.log('Received data:', data);
                    // Generate HTML for the table
                    const tableHtml = generateTableHtml(data);
                    filteredImmunizationRecordsDiv.innerHTML = tableHtml;

                    attachDeleteButtonListeners(); // Add this line to attach the listeners
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
            `;

            if (Array.isArray(data.data) && data.data.length > 0) {
                data.data.forEach(record => {
                    const barangayName = barangayNameMapping[record.barangay_id] || 'N/A';
                    tableHtml += `
                        <tr>
                            <td>${record.immunization_date}</td>
                            <td class="text-uppercase"><b>${record.infant_name}</b></td>
                            <td>${record.vaccine_name}</td>
                            <td>${record.dose_number}</td>
                            <td>${barangayName}</td>
                            <td>${record.administered_by}</td>
                            <td>${record.remarks || '-'}</td>
                            <td>
                                <table style="margin: 0 auto;">
                                    <tr>
                                    <td class="text-center align-middle"><button class="deleteButton" data-record-id="${record.id}" style="border:none"><i class="fa-solid fa-trash"></i></button></td>   
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    `;
                });
            } else {
                tableHtml += `
                    <tr>
                        <td colspan="5">No data available.</td>
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

            // Fetch filtered immunization records based on the selected barangay and year
            fetchFilteredImmunizationRecords(selectedBarangayId, selectedYear);
        });

        // Event listener for the yearDropdown change
        yearDropdown.addEventListener('change', function () {
            const selectedYear = this.value;
            const selectedBarangayId = barangayDropdown.value; // Get the selected barangay

            // Fetch filtered immunization records based on the selected barangay and year
            fetchFilteredImmunizationRecords(selectedBarangayId, selectedYear);
        });

        // Initial load with all data
        fetchFilteredImmunizationRecords(0, '');

        });

        function attachDeleteButtonListeners() {
            const deleteButtons = document.querySelectorAll('.deleteButton');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const recordId = this.getAttribute('data-record-id');
                    
                    if (confirm('Are you sure you want to delete this history record?')) {
                        // Make an AJAX request to delete the infant record
                        fetch(`/admin/history/delete/${recordId}`, {
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
</script>
</body>
</html>
