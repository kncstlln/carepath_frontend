@include('admin/head')
<title>Vaccine History</title>
<body>
@include('admin.sidebar')
<div class="container-sm content my-4" id="vaccineHistory">
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

    <div class="row justify-content-center justify-content-md-between">
        <div class="col-12 col-sm-8 col-md-5 col-lg-3 col-xl-2 mb-3 me-2">
            <a class="btn addButton w-100" role="button" id="button-export" style="border:solid">Export To Excel</a>
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

    <div class="table-responsive-lg mt-3" id="filteredImmunizationRecords">

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
                });
            },
            "dom": "lrtip"
        });
    });

</script>


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

        function fetchFilteredImmunizationRecords(barangayId, year) {
            const url = `/admin/history/filtered-records/${barangayId}/${year}`;
            fetch(url)
                .then(response => response.json()) 
                .then(data => {
                    console.log('Received data:', data);
                    $('.search-inputs').empty();
           
                    const tableHtml = generateTableHtml(data);
                    filteredImmunizationRecordsDiv.innerHTML = tableHtml;

                    attachDeleteButtonListeners();

                    let searchInputsContainer = $('<div class="search-inputs row"></div>');
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
                            });
                        },
                        "dom": "lrtip"
                    });
                    
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        
        function generateTableHtml(data) {
            let tableHtml = `
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
                            <!--<td>
                                <table style="margin: 0 auto;">
                                    <tr>
                                    <td class="text-center align-middle"><button class="deleteButton" data-record-id="${record.id}" style="border:none; background:transparent "><i class="fa-solid fa-trash"></i></button></td>   
                                    </tr>
                                </table>
                            </td>-->
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

        
        barangayDropdown.addEventListener('change', function () {
            const selectedBarangayId = this.value;
            const selectedYear = yearDropdown.value; 

      
            fetchFilteredImmunizationRecords(selectedBarangayId, selectedYear);
        });


        yearDropdown.addEventListener('change', function () {
            const selectedYear = this.value;
            const selectedBarangayId = barangayDropdown.value; 


            fetchFilteredImmunizationRecords(selectedBarangayId, selectedYear);
        });


        fetchFilteredImmunizationRecords(0, '');
        

        });

        function attachDeleteButtonListeners() {
            const deleteButtons = document.querySelectorAll('.deleteButton');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const recordId = this.getAttribute('data-record-id');
                    
                    if (confirm('Are you sure you want to delete this history record?')) {
                  
                        fetch(`/admin/history/delete/${recordId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                           
                                const grandparentRow = this.closest('tr').closest('table').closest('tr');
                                grandparentRow.remove();

                               
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
                                        });
                                    },
                                    "dom": "lrtip"
                            });
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
        function convertJSONToCSV(data) {
            const table = document.getElementById('myHistory');
            const headers = Array.from(table.querySelectorAll('thead th')).map(th => th.textContent.trim());

            const rows = Array.from(table.querySelectorAll('tbody tr'));
            const csvRows = rows.map(row => {
                const cells = Array.from(row.children);
                const csvValues = cells.map(cell => {
                    let value = cell.textContent.trim();
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
            const table = $('#myHistory').DataTable();
            const data = table.data().toArray();

            if (data.length > 0) {
                const csvContent = convertJSONToCSV(data);
                downloadCSV(csvContent, 'MyHistory.csv');
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
