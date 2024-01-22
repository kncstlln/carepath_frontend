@include('admin/head')
<title>View Infant</title>    
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
                const selectStatus = document.getElementById('status');

                selectStatus.addEventListener('change', function () {
                    const newStatus = selectStatus.value;
                    const infantId = {!! json_encode($infant['id']) !!};

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
                            return response.json();
                        } else {
                            // Handle the failure case
                            throw new Error('Failed to update infant status');
                        }
                    })
                    .then(data => {
                        console.log('Infant status updated successfully:', data);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                });


                attachDeleteButtonListeners();
            });

            function attachDeleteButtonListeners() {
                const deleteButtons = document.querySelectorAll('.deleteButton');
                deleteButtons.forEach(button => {
                    button.addEventListener('click', function () {
                        const recordId = this.getAttribute('data-record-id');

                        if (confirm('Are you sure you want to delete this immunization record?')) {
                            fetch(`/admin/history/delete/${recordId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                },
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
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