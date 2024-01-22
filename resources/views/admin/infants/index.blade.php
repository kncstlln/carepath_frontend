@include('admin/head')
<title>Infants</title>
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


        <div class="table-responsive-xl mt-3" id="filteredInfants">

        </div>


    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/r-2.5.0/datatables.min.js"></script>




<script>
    $(document).ready(function () {


        let searchInputsContainer = $('<div class="search-inputs row mb-3"></div>');
        searchInputsContainer.insertBefore('#filteredInfants');

        $('#myTable').DataTable({
            "order": [
                [0, "asc"],
                [1, "desc"]
            ],
            "initComplete": function () {
                this.api().columns().every(function (index) {
                    let column = this;
                    let title = column.header().textContent;

            
                    if (title.toLowerCase() !== 'action') {
                    
                        let searchInputColumn = $('<div class="col"></div>');

                        
                        if (title.toLowerCase() === 'sex') {
                            searchInputColumn = $('<div class="col-1"></div>');
                        }

                        searchInputsContainer.append(searchInputColumn);

                    
                        let input;

                    
                        if (title.toLowerCase() === 'status') {
                            input = document.createElement('select');
                            input.className = 'form-control'; 

                            
                            const defaultOption = document.createElement('option');
                            defaultOption.value = '';
                            defaultOption.text = 'Select Status';
                            input.add(defaultOption);

                            
                            const options = ['Fully Vaccinated', 'Partially Vaccinated', 'Not Vaccinated'];
                            options.forEach(option => {
                                const optionElement = document.createElement('option');
                                optionElement.value = option;
                                optionElement.text = option;
                                input.add(optionElement);
                            });
                        }
                    
                        else if (title.toLowerCase() === 'sex') {
                            input = document.createElement('select');
                            input.className = 'form-control'; 

                        
                            const defaultOption = document.createElement('option');
                            defaultOption.value = '';
                            defaultOption.text = 'Sex';
                            input.add(defaultOption);

                            
                            const sexOptions = ['M', 'F'];
                            sexOptions.forEach(option => {
                                const optionElement = document.createElement('option');
                                optionElement.value = option;
                                optionElement.text = option;
                                input.add(optionElement);
                            });
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

            
                        if (title.toLowerCase() === 'status' || title.toLowerCase() === 'sex') {
                            input.addEventListener('change', () => {
                                column.search(input.value).draw();
                            });
                        }
                    }
                });
            },
            "dom": "lrtip"
        });
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
        immunizationRecords.forEach(record => {
            const header = `${record.vaccine_name} Dose ${record.vaccine_dose}`;
            headers.add(header);
        });

        return Array.from(headers);
    }

    function convertJSONToCSV(data) {
        const csvRows = [];
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
                `"${infant.complete_address}"`,
            ];

            const immunizationColumns = {};

            immunizationRecords.forEach(record => {
                immunizationColumns[record.vaccine_name + ' Dose ' + record.vaccine_dose] = record.immunization_date;
            });

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

        function fetchFilteredInfants(barangayId, year) {
            const url = `/admin/getFilteredInfants/${barangayId}/${year}`;
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    console.log('Received data:', data);
                    $('.search-inputs').empty();
                    

                    const tableHtml = generateTableHtml(data);
                    filteredInfantsDiv.innerHTML = tableHtml;
                    attachDeleteButtonListeners();

             
                    let searchInputsContainer = $('<div class="search-inputs row"></div>');
                    searchInputsContainer.insertBefore('#filteredInfants');

                    $('#myTable').DataTable({
                        "order": [
                            [0, "asc"],
                            [1, "desc"]
                        ],
                        "initComplete": function () {
                            this.api().columns().every(function (index) {
                                let column = this;
                                let title = column.header().textContent;

                                
                                if (title.toLowerCase() !== 'action') {
                                    let searchInputColumn = $('<div class="col"></div>');

                                    
                                    if (title.toLowerCase() === 'sex') {
                                        searchInputColumn = $('<div class="col-1"></div>');
                                    }

                                    searchInputsContainer.append(searchInputColumn);

                                    
                                    let input;

                                    
                                    if (title.toLowerCase() === 'status') {
                                        input = document.createElement('select');
                                        input.className = 'form-control';

                                        
                                        const defaultOption = document.createElement('option');
                                        defaultOption.value = '';
                                        defaultOption.text = 'Select Status';
                                        input.add(defaultOption);

                                        
                                        const options = ['Fully Vaccinated', 'Partially Vaccinated', 'Not Vaccinated'];
                                        options.forEach(option => {
                                            const optionElement = document.createElement('option');
                                            optionElement.value = option;
                                            optionElement.text = option;
                                            input.add(optionElement);
                                        });
                                    }
                                   
                                    else if (title.toLowerCase() === 'sex') {
                                        input = document.createElement('select');
                                        input.className = 'form-control'; 

                                        
                                        const defaultOption = document.createElement('option');
                                        defaultOption.value = '';
                                        defaultOption.text = 'Sex';
                                        input.add(defaultOption);

                                        
                                        const sexOptions = ['M', 'F'];
                                        sexOptions.forEach(option => {
                                            const optionElement = document.createElement('option');
                                            optionElement.value = option;
                                            optionElement.text = option;
                                            input.add(optionElement);
                                        });
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

                                    
                                    if (title.toLowerCase() === 'status' || title.toLowerCase() === 'sex') {
                                        input.addEventListener('change', () => {
                                            column.search(input.value).draw();
                                        });
                                    }
                                }
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
                                <td class="text-center align-middle"><a href="/admin/infants/${infant.id}"><i class="fa-solid fa-eye me-2"></i></a></td>
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


        function attachDeleteButtonListeners() {
            const deleteButtons = document.querySelectorAll('.deleteButton');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const infantId = this.getAttribute('data-infant-id');
                    
                    if (confirm('Are you sure you want to delete this infant record?')) {
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

        barangayDropdown.addEventListener('change', function () {
            const selectedBarangayId = this.value;
            const selectedYear = yearDropdown.value;
            fetchFilteredInfants(selectedBarangayId, selectedYear);
        });

        yearDropdown.addEventListener('change', function () {
            const selectedYear = this.value;
            const selectedBarangayId = barangayDropdown.value; 
            fetchFilteredInfants(selectedBarangayId, selectedYear);
        });

        fetchFilteredInfants(0, '');
    });
</script>




</body>
</html>
