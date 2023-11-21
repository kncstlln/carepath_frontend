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
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/index.js') }}"></script>

    <title>Infants</title>
</head>
<body>
@include('admin.sidebar')
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


    <div class="row justify-content-center justify-content-md-between">
        <div class="col-12 col-sm-8 col-md-5 col-lg-3 col-xl-2 mb-3 me-2">
            <a class="btn addButton w-100" role="button" id="button-export" style="border:solid">Export To Excel</a>
        </div>
        <div class="col-12 col-sm-8 col-md-5 col-lg-3 col-xl-2 mb-3 me-2">
            <a class="btn addButton w-100" href="{{ route('admin.infants.add') }}" role="button" id="button-add">Add Infant +</a>
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


    <div class="table-responsive-xl" id="filteredInfants">

    </div>

        
 

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/r-2.5.0/datatables.min.js"></script>




<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
    });
</script>

<script>

document.getElementById('button-export').addEventListener('click', function () {
    const year = prompt('Please enter the year for data export:', '');
    if (year !== null) {
        fetch(`/admin/get-excel-data/${year}`)
            .then(response => response.json())
            .then(data => {
                if (data && data.length > 0) {
                    // Here, convert the response data to CSV format
                    const csvContent = convertJSONToCSV(data);
                    downloadCSV(csvContent, `Infants_${year}.csv`);
                } else {
                    alert('No data available for the selected year.');
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }
});

function getImmunizationHeaders(immunizationRecords) {
    const headers = new Set();

    // Construct headers based on vaccine names and doses
    immunizationRecords.forEach(record => {
        const header = `${record.vaccine_name} Dose ${record.vaccine_dose}`;
        headers.add(header);
    });

    return Array.from(headers);
}

function convertJSONToCSV(data) {
    const csvRows = [];

    // Set the headers for the CSV
    const headers = [
        'Name',
        'Patient Number',
        'Sex',
        'Birth Date',
        'Barangay',
        'Weight',
        'Length',
        'Father Name',
        'Mother Name',
        'Contact Number',
        'Complete Address',
        ...getImmunizationHeaders(data[0].immunization_records),
    ];
    csvRows.push(headers.join(','));

    // Convert data to CSV rows
    data.forEach(item => {
        const infant = item.infant;
        const barangay = item.infant.barangay;
        const immunizationRecords = item.immunization_records;

        const row = [
            infant.name,
            infant.tracking_number,
            infant.sex,
            infant.birth_date,
            barangay.name,
            infant.weight,
            infant.length,
            infant.father_name,
            infant.mother_name,
            infant.contact_number,
            // Enclose 'Complete Address' within double quotes to prevent splitting at commas
            `"${infant.complete_address}"`,
        ];

        const immunizationColumns = {};

        // Prepare the columns for immunization records
        immunizationRecords.forEach(record => {
            immunizationColumns[record.vaccine_name + ' Dose ' + record.vaccine_dose] = record.immunization_date;
        });

        // Add the values for immunization columns in the row
        headers.slice(12).forEach(header => {
            row.push(immunizationColumns[header]);
        });

        csvRows.push(row.join(','));
    });

    return csvRows.join('\n');
}

function downloadCSV(content, fileName) {
    const encodedUri = encodeURI(`data:text/csv;charset=utf-8,${content}`);
    const link = document.createElement('a');
    link.setAttribute('href', encodedUri);
    link.setAttribute('download', fileName);
    document.body.appendChild(link);
    link.click();
}


    document.addEventListener('DOMContentLoaded', function () {
        const barangayDropdown = document.querySelector('#barangayDropdown');
        const yearDropdown = document.querySelector('#yearDropdown');
        const filteredInfantsDiv = document.querySelector('#filteredInfants');
        const barangayNameMapping = {
            @foreach($barangays as $barangay)
                {{ $barangay['id'] }}: "{{ $barangay['name'] }}",
            @endforeach
        };

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

                    $('#myTable').DataTable({
                        "order": [
                            [0, "asc"],
                            [1, "desc"]
                        ]
                    });

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
                            <th scope="col">Barangay</th>
                            <th scope="col">Birth Date</th>
                            <th scope="col">Name</th>
                            <th scope="col">Sex</th>
                            <th scope="col">Patient Number</th>
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
                        <td scope="row">${barangayNameMapping[infant.barangay_id]}</td>
                        <td class="table-secondary">${infant.birth_date}</td>
                        <td class="text-uppercase"><b>${infant.name}</b></td>
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
                        <td>No data available.</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
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
                            console.log('Response from server:', data);
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
