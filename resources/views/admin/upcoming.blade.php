@include('admin/head')
<title>Upcoming Vaccination</title>
<body>
@include('admin/sidebar')
    <div class="container-sm mt-4 content" id="targetclientlist">
        <div class="row mb-2">
            <div class="col-sm" id="infantsTxt">Vaccinations for the Upcoming Week</div>
        </div>

        <div class="row d-flex justify-content-center justify-content-md-between">
            <div class="col-12 col-sm-8 col-md-5 col-lg-3 col-xl-2 mb-3 me-2">
                <a class="btn addButton w-100" href="{{ route('admin.send-sms-upcoming') }}" role="button" id="button-add" style="background-color:green">Send SMS</a>
            </div>

            <div class="col-12 col-sm-8 col-md-5 col-lg-3 col-xl-2 mb-3 me-2">
                <a class="btn addButton w-100" role="button" id="button-export" style="border:solid">Export To Excel</a>
            </div>
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
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/r-2.5.0/datatables.min.js"></script>

    <script>
            $(document).ready(function () {
            function getUrlParameter(name) {
                name = name.replace(/[[]/, '\\[').replace(/[\]]/, '\\]');
                const regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
                const results = regex.exec(location.search);
                return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
            }

            const vaccineFilter = getUrlParameter('upcoming-vaccine-filter');
            let searchInputsContainer = $('<div class="search-inputs row mb-3"></div>');
            searchInputsContainer.insertBefore('#upcomingTable');

            $('#upcomingTable').DataTable({
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

                            if (title.toLowerCase() === 'vaccine/s' && vaccineFilter) {
                                input.value = vaccineFilter;
                                column.search(vaccineFilter).draw();
                            }

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
            const table = document.getElementById('upcomingTable');
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
            const table = $('#upcomingTable').DataTable();
            const data = table.data().toArray();

            if (data.length > 0) {
                const csvContent = convertJSONToCSV(data);
                downloadCSV(csvContent, 'upcomingTable.csv');
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