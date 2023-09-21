<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="{{ asset('css/admin/sidebar.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/admin/index.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/admin/addInfant.css') }}" rel="stylesheet"/>
    <script src="{{ asset('js/sidebar.js') }}" defer></script>
    <script src="{{ asset('js/index.js') }}"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('/images/logo.png') }}">
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/2eead9cc17.js" crossorigin="anonymous"></script>
    <title>Edit Infant</title>
</head>
<body>
  @include('admin.sidebar')

  <div class="container-sm mt-4">
    <div class="row">
        <div class="col-sm mb-5" id="infantsTxt">Edit Infant Record</div>
    </div>
    <div class="container-sm createRecord">
        <div class="row">
            <div class="col h2 mb-5 mt-3 text-center">Edit Infant Record</div>
        </div>
        <form method="POST" action="{{ route('admin.infants.update', $infant['id']) }}">
            @csrf
            @method('PUT') <!-- Use the PUT method for updating -->
            <div class="row mb-2 mb-md-4">
                <div class="col-md-2 col-lg-1 pt-1 text-center"> Name:</div>
                <div class="col-md-5 col-lg-4">
                    <input class="form-control" name="name" type="text" placeholder="Full Name" aria-label="default input" required value="{{ $infant['name'] }}"/>
                </div>
                <div class="col-md-4 col-lg-6 col-xl-3 p-2 text-center"> Barangay:</div>
                <div class="col-md-3 col-lg-2">
                    <select class="form-select" name="barangay_id" required>
                        <option value="" disabled>Select Barangay</option>
                        @foreach($barangays as $barangay)
                            <option value="{{ $barangay['id'] }}" {{ $infant['barangay_id'] == $barangay['id'] ? 'selected' : '' }}>{{ $barangay['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div> 

            <div class="row mb-4">
                <div class="col-md-2 col-lg-1 mt-2 text-center">Sex:</div>
                <div class="col-md-1 ms-md-1 me-md-3 mt-2 d-flex justify-content-center">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sex" id="male" value="Male" {{ $infant['sex'] == 'Male' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="male">
                            Male
                        </label>
                    </div>
                </div>

                <div class="col-md-1 me-md-3 mt-2 ms-2 ps-3 d-flex justify-content-center">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sex" id="female" value="Female" {{ $infant['sex'] == 'Female' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="female">
                            Female
                        </label>
                    </div>
                </div>

                <div class="col-md-2 col-lg-2 ms-md-auto ms-lg-0 pt-2 text-center">Birth date:</div>
                <div class="col-md-4 col-lg-2">
                    <div class="input-group date" id="datepicker">
                        <input type="date" name="birth_date" class="form-control" required value="{{ $infant['birth_date'] }}"/>
                    </div>
                </div>
                <div class="col-md-4 col-lg-2 mt-md-2 mt-lg-0 pt-2 text-center "> Family Serial Number: </div>
                <div class="col-md-3 col-lg-2 mt-md-2 mt-lg-0">
                    <input class="form-control" type="number" name="family_serial_number" placeholder="Number" aria-label="default input" value="{{ $infant['family_serial_number'] }}"/>
                </div>
            </div>

            <div class="row d-flex justify-content-center justify-content-md-start mb-5">
                <div class="col-sm-3 col-lg-2 pt-2 text-center">Weight (kg): </div>
                <div class="col-sm-2 col-lg-2 col-xl-1">
                    <input class="form-control" name="weight" type="number" placeholder="kg" aria-label="default input" min="1" max="50" value="{{ $infant['weight'] }}"/>
                </div>
                <div class="col-sm-3 col-lg-2 pt-2 text-center">Length (cm):</div>
                <div class="col-sm-2 col-lg-2 col-xl-1">
                    <input class="form-control" name="length" type="number" placeholder="cm" aria-label="default input" min="1" max="50" value="{{ $infant['length'] }}"/>
                </div>
                <div class="col-sm-3 col-lg-2 pt-2 text-center"> Tracking Number:</div>
                <div class="col-sm-3 col-lg-2 pt-2 text-left"> {{ $infant['tracking_number'] }}</div>
            </div>

            <div class="row mb-4">
                <div class="col-md-5 ps-md-4 h4 text-center text-md-start">Parents Information</div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3 col-lg-2 pt-2 text-center">Father's Name:</div>
                <div class="col-md-5">
                    <input class="form-control" name="father_name" type="text" placeholder="Full Name" aria-label="default input" required value="{{ $infant['father_name'] }}"/>
                </div>
            </div>

            <div class="row mb-2 ">
                <div class="col-md-3 col-lg-2 pt-2 text-center">Mother's Name:</div>
                <div class="col-md-5">
                    <input class="form-control" name="mother_name" type="text" placeholder="Full Name" aria-label="default input" required value="{{ $infant['mother_name'] }}"/>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-md-3 col-lg-2 ps-lg-2 pe-lg-0 pt-2 text-center text-md-start text-lg-center">
                    Contact Number:
                </div>
                <div class="col-md-3">
                    <input class="form-control" name="contact_number" type="tel" placeholder="Contact Number" id="telephone" placeholder="Contact Number" aria-label="default input" required value="{{ $infant['contact_number'] }}"/>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-5 h4 text-center text-md-start ps-md-4">Complete Address:</div>
                <div class="mb-3">
                    <textarea class="form-control" name="complete_address" rows="2">{{ $infant['complete_address'] }}</textarea>
                </div>
            </div>

            <div class="row mb-4 justify-content-center text-center">
                <div class="col-md-3 col-lg-2 mt-1">
                    <a href="{{ route('admin.infants.index') }}"><button type="button" class="btn btn-secondary cancelButton">Cancel</button></a>
                </div>
                <div class="col-md-3 col-lg-2 mt-1">
                    <button type="submit" class="btn submitButton">Submit</button>
                </div>
            </div>
        </form>
    </div>
  </div>
  <!-- Your existing scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
