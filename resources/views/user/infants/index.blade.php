@include('admin/head')
<title>Target Client List</title>
<body>
  @include('user.sidebar')
  <div class="container-sm mt-4 content" id="targetclientlist">

      <div class="row mb-2">
          <div class="col-sm" id="infantsTxt">List of Infants</div>
      </div>


      <div class="row d-flex justify-content-center justify-content-md-between mt-5">
            <div class="col-12 col-sm-8 col-md-5 col-lg-3 col-xl-2 mb-3 me-2">
                <a class="btn addButton w-100" role="button" id="button-export" style="border:solid">Export To Excel</a>
            </div>
          <div class="col-12 col-sm-8 col-md-5 col-lg-3 col-xl-2 mb-3 me-2">
              <a class="btn addButton w-100" href="{{ route('user.infants.add') }}" role="button" id="button-add">Add Infant +</a>
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


      <div class="table-responsive-xl">
      <table class="table table-striped" id="myTable">
          <thead>
              <tr class="table-danger">
                  <th scope="col">Birth Date</th>
                  <th scope="col">Name</th>
                  <!--<th scope="col">Date of Registration</th>-->
                  <th scope="col">Sex</th>
                  <th scope="col">Patient Number</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
              </tr>
          </thead>
          <tbody>
              @foreach($infants as $index => $infant)
              <tr>
                  <td>{{ $infant['birth_date'] }}</td>
                  <td class="table-secondary text-uppercase"><b>{{ $infant['name'] }}</b></td>
                  <!--<td class="table-secondary">{{ $infant['created_at'] }}</td>-->
                  <td>{{ $infant['sex'] }}</td>
                  <td  class="table-secondary">{{ $infant['tracking_number'] }}</td>
                  <td >{{ $infant['status'] }}</td>
                  <td  class="table-secondary">
                      <table>
                          <tr>
                              <td class="text-center align-middle"><a href="/user/history/add/{{ $infant['id'] }}" style="color: black;"><i class="fa-solid fa-syringe me-2"></i></a></td>
                              <td class="text-center align-middle"><a href="/user/infants/{{ $infant['id'] }}" style="color: black;"><i class="fa-solid fa-eye me-2"></i></a></td>
                              <td class="text-center align-middle">
                                  <a href="{{ route('user.infants.edit', ['id' => $infant['id']]) }}" style="color: black;">
                                      <i class='bx bxs-pencil me-2'></i>
                                  </a>
                              </td>    
                              <td>
                                  <form method="POST" action="{{ route('user.infants.delete', ['id' => $infant['id']]) }}">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="delete-infant bg-transparent" style="border: none" onclick="return confirm('Are you sure you want to delete the data of this infant?');">
                                          <i class="fa-solid fa-trash"></i>
                                      </button>
                                  </form>
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
              @endforeach 
          </tbody>
          
      </table>
          
  

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/r-2.5.0/datatables.min.js"></script>

  <script>
    $(document).ready(function () {
        let searchInputsContainer = $('<div class="search-inputs row mb-3"></div>');
        searchInputsContainer.insertBefore('#myTable');

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
                    
                        if (title.toLowerCase() === 'name') {
                            searchInputColumn = $('<div class="col-4"></div>');
                        }

                        if (title.toLowerCase() === 'patient number') {
                            searchInputColumn = $('<div class="col-2"></div>');
                        }
                        

                        if (title.toLowerCase() === 'birth date') {
                            searchInputColumn = $('<div class="col-2"></div>');
                        }

                        if (title.toLowerCase() === 'status') {
                            searchInputColumn = $('<div class="col-2"></div>');
                        }

                        
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
                        } else if (title.toLowerCase() === 'birth date') {
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
        fetch(`/user/get-excel-data/${year}`)
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
        'Tracking Number',
        'Sex',
        'Birth Date',
        'Family Serial Number',
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
            infant.family_serial_number,
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

</scrip>

</body>
</html>