<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="{{ asset('css/admin/sidebar.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/admin/index.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/admin/addHistory.css') }}" rel="stylesheet"/>
    <script src="{{ asset('js/sidebar.js') }}" defer></script>
    <script src="{{ asset('js/index.js') }}"></script>
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/2eead9cc17.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('/images/logo.png') }}">
    <title>Vaccinate Infant</title>    
</head>
<body>
@include('admin/sidebar')
<div class="container-sm content mt-4">
    <div class="row">
        <div class="col-sm mb-5" id="infantsTxt">Vaccinate Infant</div>
    </div>
    <div class="container-sm createRecord">
        <div class="row">
            <div class="col h2 mb-5 mt-3 text-center">Vaccinate Infant</div>
        </div>
        <form action="{{ route('admin.history.store') }}" method="post">
          @csrf
          
            <div class="row mb-4 align-items-center">

                <div class="col-md-6 col-xl-4">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ $infantData['name'] }}" disabled>
                </div>

                <div class="col-md-6 col-xl-4">
                    <label for="tracking" class="form-label">Tracking Number:</label>
                    <input type="text" name="tracking" class="form-control" id="tracking" value="{{ $infantData['tracking_number'] }}" disabled>
                </div>


                <div class="col-md-3 col-xl-1 mt-2">
                    <label for="sex" class="form-label">Sex:</label>
                    <input type="text" name="sex" class="form-control" id="sex" value="{{ $infantData['sex'] }}" disabled>
                </div>

                <div class="col-md-3 col-xl-2 mt-2">
                    <label for="birthdate" class="form-label">Birth date:</label>
                    <input type="text" name="birthdate" class="form-control" id="birthdate" value="{{ $infantData['birth_date'] }}" disabled>
                </div>

                <div class="col-md-6 col-xl-4 mt-2">
                    <label for="barangay" class="form-label">Barangay:</label>
                    <input type="text" name="barangay" class="form-control" id="barangay" value="{{ $barangayName }}" disabled>
                </div>

                <div class="col-md-3 col-xl-1 order-xl-3 mt-2">
                    <label for="weight" class="form-label">Weight:</label>
                    <input type="text" name="weight" class="form-control" id="weight" value="{{ $infantData['weight'] }}" disabled>
                </div>

                <div class="col-md-3 col-xl-1 order-xl-4 mt-2">
                    <label for="length" class="form-label">Length:</label>
                    <input type="text" name="length" class="form-control" id="length" value="{{ $infantData['length'] }}" disabled>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-2 pt-2 text-center">Vaccine Used:</div>
                <div class="col-md-5">
                <select class="form-select" aria-label="Default select example" name="vaccine_id" id="vaccineSelect">
                    <option selected></option>
                    @foreach ($vaccineDoses as $vaccineDose)
                        <option value="{{ $vaccineDose['vaccine_id'] }}" data-dose-number="{{ $vaccineDose['dose_number'] }}">
                            {{ $vaccineDose['vaccine_name'] }} - (Dose {{ $vaccineDose['dose_number'] }})
                        </option>
                    @endforeach
                </select>
                </div>
            </div>
            
            <input type="hidden" name="infant_id" id="infant_id" value="{{ $infantData['id'] }}">
            <input type="hidden" name="vaccine_id" id="vaccine_id" value="">
            <input type="hidden" name="dose_number" id="dose_number" value="">
            <div class="row mb-2">
                <div class="col-md-2 pt-2 text-center">Administered By:</div>
                <div class="col-md-5">
                    <input class="form-control" name="administered_by" type="text" value="{{ session('name') }}" readonly/>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-2 pt-2 text-center">Vaccination Location:</div>
                <div class="col-md-5">
                    <select class="form-select" name="barangay_id" aria-label="Default select example">
                        <option selected></option>
                        @foreach ($barangays as $barangay)
                            <option value="{{ $barangay['id'] }}">{{ $barangay['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-2 text-center">Immunization Date: </div>
                <div class="col-md-4 mb-3">
                  <input type="date" name="immunization_date" class="form-control" required/>
                </div>
            </div>   
            <div class="row mb-4">
                <div class="col-md-2 text-center">Remarks: </div>
                <div class="col-md-4 mb-3">
                    <textarea class="form-control" name="remarks" rows="2"></textarea>
                </div>
            </div>
            
            <div class="row mb-4 justify-content-center text-center">
                <div class="col-md-3 col-lg-2 mt-1">
                    <a href="javascript:history.go(-1)"><button type="button" class="btn btn-secondary cancelButton">Cancel</button></a>
                </div>
                <div class="col-md-3 col-lg-2 mt-1">
                    <button type="submit" class="btn submitButton">Submit</button>
                </div>
            </div>

            <div class="row mb-4 justify-content-center text-center" id="previewSection" style="display: none;">
            <div class="col">
                <h3>Preview</h3>
                <p><strong>Name:</strong> <span id="previewName"></span></p>
                <p><strong>Tracking Number:</strong> <span id="previewTrackingNumber"></span></p>
                <p><strong>Vaccine Used:</strong> <span id="previewVaccineUsed"></span></p>
                <p><strong>Administered By:</strong> <span id="previewAdministeredBy"></span></p>
                <p><strong>Vaccination Location:</strong> <span id="previewVaccinationLocation"></span></p>
                <p><strong>Remarks:</strong> <span id="previewRemarks"></span></p>
                <!-- Add other preview fields here -->
                <p><strong>Infant ID (Hidden):</strong> <span id="previewInfantId"></span></p>
                <p><strong>Vaccine ID (Hidden):</strong> <span id="previewvaccine_id"></span></p>
                <p><strong>Dose Number (Hidden):</strong> <span id="previewdose_number"></span></p>
            </div>
        </div>

        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#vaccineSelect').change(function () {
            var selectedOption = $(this).find(":selected");
            var vaccine_id = selectedOption.val();
            var dose_number = selectedOption.data('dose-number');
            
            // Update the hidden input fields
            $('#vaccine_id').val(vaccine_id);
            $('#dose_number').val(dose_number);
        });
    });
</script>



</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</html>
