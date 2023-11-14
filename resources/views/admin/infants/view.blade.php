<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="{{ asset('css/admin/sidebar.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/admin/index.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/admin/viewInfant.css') }}" rel="stylesheet"/>
    <script src="{{ asset('js/sidebar.js') }}" defer></script>
    <script src="{{ asset('js/index.js') }}"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('/images/logo.png') }}">
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/2eead9cc17.js" crossorigin="anonymous"></script>
    <title>View Infant</title>    
</head>
  <body>
              @include('admin.sidebar')
        <div class="container-sm content mt-4">
            <div class="row">
                <div class="col-sm mb-5" id="infantsTxt">View Infant Record</div>
            </div>
            <div class="container-sm ps-4 createRecord">
                <div class="row">
                    <div class="col-1 col-md-1 mt-3"><a href="{{ route('admin.infants.index') }}"><i class="fa-solid fa-angle-up fa-rotate-270 fa-2xl"></i></a></div>
                    <div class="col-9 col-md-10 h2 mb-5 mt-3 text-center">View Infant Record</div>
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
                    <form>
                        <div class="row mb-4">
                            <div class="col-2 col-md-1 pt-1"><strong> Name: </strong></div>
                            <div class="col-12 col-md-4 col-lg-3 pt-1">{{ $infant['name'] }}</div>
                            <div class="col-md-1 pt-1"><strong>Sex: </strong></div>
                            <div class="col-md pt-1 ">{{ $infant['sex'] }}</div>
                            <div class="col-md-2 pt-1 "><strong> Barangay: </strong> </div>
                            <div class="col-md-3 pt-1">
                            @foreach ($barangays as $barangay)
                                @if ($barangay['id'] == $infant['barangay_id'])
                                    {{ $barangay['name'] }}
                                @endif
                            @endforeach
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-1 pe-1 pt-2"><strong>Birth date:</strong> </div>
                            <div class="col-md-2 pt-2 ">{{ $infant['birth_date'] }}</div>
                            <div class="col-md-2 pt-2"><strong> Family Serial Number:</strong></div>
                            <div class="col-md-2 pt-2 "> {{ $infant['family_serial_number'] }} </div>
                            <div class="col-md-2 pt-2"><strong> Tracking Number:  </strong></div>
                            <div class="col-md-3 pt-2 "> {{ $infant['tracking_number'] }} </div>
                        </div>
                        <div class="row mb-5">
                          <div class="col-md-2 pt-2"><strong>Weight (kg): </strong></div>
                          <div class="col-md-1 ps-md-0 pt-2"> {{ $infant['weight'] }} </div>
                          <div class="col-md-2 pt-2"><strong>Length (cm): </strong></div>
                          <div class="col-md-1 ps-md-0 pt-2"> {{ $infant['length'] }} </div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-md-5 h4"><strong>Parents Information </strong></div>
                        </div>
                        <div class="row mb-2">
                          <div class="col-md-3 col-lg-2 pt-2"><strong>Father's Name:</strong> </div>
                          <div class="col-md-3 pt-2">{{ $infant['father_name'] }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3 col-lg-2 pt-2"><strong>Mother's Name: </strong></div>
                            <div class="col-md-3 pt-2">{{ $infant['mother_name'] }}</div>
                        </div>
                        <div class="row mb-2">
                          <div class="col-md-2 ms-lg-2 ps-lg-0 pt-2"><strong>Contact Number</strong></div>
                          <div class="col-md-2 pt-2">{{ $infant['contact_number'] }}</div>
                        </div>
                        <div class="row mb-4">
                          <div class="col-md-4 pt-2"><strong>Complete Address: </strong> </div>
                          <div class="col-md-10 pt-2">{{ $infant['complete_address'] }}</div>
                        </div>
                        <div class="row d-flex justify-content-end">
                            <div class="col-4 d-flex">
                                <select class="form-select btn btn-lg mb-4 addButton" id="status" role="button" id="button-add">
                                    <option value="0" {{ $infant['status'] === 0 ? 'selected' : '' }}>Not Vaccinated</option>
                                    <option value="1" {{ $infant['status'] === 1 ? 'selected' : '' }}>Partially Vaccinated</option>
                                    <option value="2" {{ $infant['status'] === 2 ? 'selected' : '' }}>Fully Vaccinated</option>
                                </select>
                            </div>
                            <div class="col-7 d-flex justify-content-end">
                                <a class="btn btn-lg mb-4 addButton" href="{{ route('admin.history.add', ['id' => $infant['id']]) }}" role="button" id="button-add">Vaccinate Infant</a>
                            </div>
                        </div>
                        <div class="table-responsive-lg text-center">
                        <table class="table table-striped">
                          <thead>
                              <tr>
                                  <th>Immunization Date</th>
                                  <th>Vaccine Name</th>
                                  <th>Vaccine Dose</th>
                                  <th>Administered in</th>
                                  <th>Administered By</th>
                                  <th>Remarks</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                              @if (isset($immunizations['Immunization history']))
                                  @foreach ($immunizations['Immunization history'] as $immunization)
                                      <tr>
                                          <td>{{ $immunization['Immunization Date'] }}</td>
                                          <td>{{ $immunization['Vaccine Name'] }}</td>
                                          <td>{{ $immunization['Vaccine Dose'] }}</td>
                                          <td>
                                            @foreach ($barangays as $barangay)
                                                @if ($barangay['id'] == $immunization['Vaccination Location'])
                                                    {{ $barangay['name'] }}
                                                @endif
                                            @endforeach
                                          </td>
                                          <td>{{ $immunization['Administered By'] }}</td>
                                          <td>{{ $immunization['Remarks'] }}</td>
                                          <td class="text-center align-middle">
                                            <button class="deleteButton" data-record-id="{{ $immunization['Id'] }}" style="border:none">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                          </td>
                                      </tr>
                                  @endforeach
                              @else
                                  <tr>
                                      <td colspan="5">No immunization records available.</td>
                                  </tr>
                              @endif
                          </tbody>
                        </table>
                      </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const selectStatus = document.getElementById('status'); // Assuming this is the select element for the infant status

                selectStatus.addEventListener('change', function () {
                    const newStatus = selectStatus.value;
                    const infantId = {!! json_encode($infant['id']) !!}; // Get the infant ID from PHP

                    // Fetch to update infant status
                    fetch(`/admin/infants/update-status/${infantId}`, {
                        method: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            status: newStatus
                        })
                    })
                    .then(response => {
                        if (response.ok) {
                            // Optionally, you can handle success (if needed)
                            return response.json();
                        } else {
                            // Handle the failure case
                            throw new Error('Failed to update infant status');
                        }
                    })
                    .then(data => {
                        // Handle response data if necessary
                        console.log('Infant status updated successfully:', data);
                        // You might want to refresh the page or update the UI after the successful update
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Handle error in updating infant status
                    });
                });


                attachDeleteButtonListeners();
            });

            // Function to attach click event listeners to delete buttons
            function attachDeleteButtonListeners() {
                const deleteButtons = document.querySelectorAll('.deleteButton');
                deleteButtons.forEach(button => {
                    button.addEventListener('click', function () {
                        const recordId = this.getAttribute('data-record-id');

                        if (confirm('Are you sure you want to delete this immunization record?')) {
                            // Make an AJAX request to delete the immunization record
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
                                    const row = this.parentElement.parentElement;
                                    row.remove();
                                } else {
                                    alert('Failed to delete immunization record. Please try again.');
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