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

  <div class="container-sm content mt-4">
    <div class="row">
        <div class="col-sm mb-5" id="infantsTxt">Edit Infant Record</div>
    </div>
    <div class="container-sm createRecord">
        <div class="row">
            <div class="col h2 mb-5 mt-3 text-center">Edit Infant Record</div>
        </div>
        <form method="POST" action="{{ route('admin.infants.update', $infant['id']) }}">
            @csrf
            @method('PUT')

            @if(session('error'))
            <div class="alert alert-danger" id="error-message">
                {{ session('error') }}
            </div>

            <script>
                setTimeout(function() {
                    document.getElementById('error-message').style.display = 'none';
                }, 3000);
            </script>
            @endif

            
            <div class="row g-3">

                <div class="col-md-6 ">
                    <label for="name" class="form-label">Name: <span style="color:red">*</span></label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $infant['name'] }}" maxlength="40">
                </div>

                <div class="col-md-6 col-xl-4"> 
                    <label for="barangay" class="form-label">Barangay:<span style="color:red;"> *</span></label>
                    <select class="form-select" name="barangay_id" required>
                        <option value="" disabled>Select Barangay</option>
                        @foreach($barangays as $barangay)
                            <option value="{{ $barangay['id'] }}" {{ $infant['barangay_id'] == $barangay['id'] ? 'selected' : '' }}>{{ $barangay['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3"> 
                    <label for="weight" class="form-label">Weight (kg): <span style="color:red">*</span></label>
                    <input class="form-control" required name="weight" type="number" step=".01" placeholder="kg" pattern="\d+(\.\d{1,2})?" aria-label="default input" min="1" max="99" value="{{ $infant['weight'] }}"/>
                </div>

                <div class="col-md-3">
                    <label for="height" class="form-label">Length (cm):</label>
                    <input class="form-control" name="length" type="number" placeholder="cm" pattern="\d+(\.\d{1,2})?" aria-label="default input" min="1" max="99" value="{{ $infant['length'] }}"/>
                </div>

                <div class="col-md-6">
                        <div>Sex:<span style="color:red"> *</span></div>
                        <div class="form-check form-check-inline mt-2" id="sex">
                            <input class="form-check-input" type="radio" name="sex" id="male" value="Male" {{ $infant['sex'] == 'Male' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="male">Male</label>
                        </div>
        
                        <div class="form-check form-check-inline mt-2">
                            <input class="form-check-input" type="radio" name="sex" id="female" value="Female" {{ $infant['sex'] == 'Female' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="female">Female</label>
                        </div>                 
                </div>

                <div class="col-md-6 col-xl-3">
                    <div>Birth date:<span style="color:red;"> *</span></div>
                    <div class="input-group date" id="datepicker">
                        <input type="date" name="birth_date" id="birthDate" class="form-control" required value="{{ $infant['birth_date'] }}"/>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3 mt-1">
                    <label for="family-serial" class="col-form-label">Family Serial Number: </label>
                    <input class="form-control" type="number" name="family_serial_number" placeholder="Number" aria-label="default input" value="{{ $infant['family_serial_number'] }}"/>
                </div>

                <div class="col-md-6 col-xl-4 mt-1">
                    <label for="family-serial" class="col-form-label">Patient Number: </label>
                    <input class="form-control" type="text" name="tracking_number" aria-label="default input" value="{{ $infant['tracking_number'] }}"/>
                </div>
 

            </div>
        
       
            <div class="row g-3 mt-3">

                <div class="col-12 h3 text-center text-md-start">
                    Parents Information
                </div>
         
                <div class="col-md-6">
                    <label for="father" class="form-label">Father's Name:</label>
                    <input class="form-control" id="father" name="father_name" type="text" aria-label="default input" value="{{ $infant['father_name'] }}" maxlength="40"/>
                </div>
        

                <div class="col-md-6">
                    <label for="mother" class="form-label">Mother's Name:</label>
                    <input class="form-control" name="mother_name" type="text" placeholder="Full Name" aria-label="default input" value="{{ $infant['mother_name'] }}" maxlength="40"/>
                </div>

                <div class="col-md-6 col-lg-4">
                    <label for="contact" class="form-label">Contact Number:</label>
                    <input class="form-control" name="contact_number" type="tel" placeholder="Contact Number" id="telephone" placeholder="Contact Number" aria-label="default input" value="{{ $infant['contact_number'] }}"/>
                </div>

            </div>

            <div class="row mb-4 mt-3">

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
            
            <script>
    function validateDecimal(input) {
        // Remove any non-numeric characters and restrict to two decimal places
        input.value = input.value.replace(/[^0-9.]/g, '');
        const parts = input.value.split('.');
        if (parts[1] && parts[1].length > 2) {
            parts[1] = parts[1].slice(0, 2);
        }
        input.value = parts.join('.');
    }
</script>
            
            <script>
    // Get the current date
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1;
    var yyyy = today.getFullYear();

    if (dd < 10) {
        dd = '0' + dd;
    }
    if (mm < 10) {
        mm = '0' + mm;
    }

    today = yyyy + '-' + mm + '-' + dd;

    // Set the min attribute of the date input to today's date
    document.getElementById('birthDate').setAttribute('max', today);
</script>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
