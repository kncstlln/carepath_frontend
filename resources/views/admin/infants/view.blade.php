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
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/2eead9cc17.js" crossorigin="anonymous"></script>
    <title>View Infant</title>    
</head>
  <body>
              @include('admin.sidebar')
        <div class="container-sm mt-4">
            <div class="row">
                <div class="col-sm mb-5" id="infantsTxt">View Infant Record</div>
            </div>
            <div class="container-sm ps-4 createRecord">
                <div class="row">
                    <div class="col-1 col-md-1 mt-3"><a href="{{ route('admin.infants.index') }}"><i class="fa-solid fa-angle-up fa-rotate-270 fa-2xl"></i></a></div>
                    <div class="col-9 col-md-10 h2 mb-5 mt-3 text-center">View Infant Record</div>
                </div>
                <div>
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
  </body>
</html>