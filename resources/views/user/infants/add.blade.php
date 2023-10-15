<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="{{ asset('css/user/sidebar.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/user/index.css') }}" rel="stylesheet"/>
    <script src="{{ asset('js/sidebar.js') }}" defer></script>
    <script src="{{ asset('js/index.js') }}"></script>
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/2eead9cc17.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('/images/logo.png') }}">
    <title>Add Infant</title>    
</head>

<body>
@include('user.sidebar')

<div class="container content mt-4 mb-5">
    <div class="row">
        <div class="col-sm mb-5" id="infantsTxt">Create New Infant Record</div>
    </div>
    <div class="container-sm createRecord" >
        <div class="row">
            <div class="col h2 mb-5 mt-3 text-center">Create Infant Record</div>
        </div>
        <form method="POST" action="{{ route('admin.infants.store') }}">
          @csrf


            <div class="row g-3">

                <div class="col-md-6 ">
                    <label for="name" class="form-label">Name: <span style="color:red">*</span></label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Juan Dela Cruz">
                </div>

                <div class="col-md-6 col-xl-4"> 
                    <label for="barangay" class="form-label">Barangay:<span style="color:red;"> *</span></label>
                    <select class="form-select" id="barangay" name="barangay_id" required>
                        <option value="" disabled selected>Select Barangay</option>
                        @foreach($barangays as $barangay)
                            <option value="{{ $barangay['id'] }}">{{ $barangay['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3"> 
                    <label for="weight" class="form-label">Weight (kg):</label>
                    <input class="form-control" id="weight" name="weight" type="number" placeholder="kg" aria-label="default input" min="1" max="50"/>
                </div>

                <div class="col-md-3">
                    <label for="height" class="form-label">Length (cm):</label>
                    <input class="form-control" id="length" name="length" type="number" placeholder="cm" aria-label="default input" min="1" max="50"/>
                </div>

                <div class="col-md-6">
                        <div>Sex:<span style="color:red"> *</span></div>
                        <div class="form-check form-check-inline mt-2" id="sex">
                            <input class="form-check-input" type="radio" name="sex" id="male" value="Male" required>
                            <label class="form-check-label" for="male">Male</label>
                        </div>
        
                        <div class="form-check form-check-inline mt-2">
                            <input class="form-check-input" type="radio" name="sex" id="female" value="Female" required>
                            <label class="form-check-label" for="female">Female</label>
                        </div>                 
                </div>

                <div class="col-md-6 col-xl-3">
                    <div>Birth date:<span style="color:red;"> *</span></div>
                    <div class="input-group date" id="datepicker">
                        <input type="date" name="birth_date" class="form-control" required/>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3 mt-1">
                    <label for="family-serial" class="col-form-label">Family Serial Number: </label>
                    <input class="form-control" id="family-serial" type="number" name="family_serial_number" placeholder="Number" aria-label="default input"/>
                </div>
 

            </div>
        
       
            <div class="row g-3 mt-3">

                <div class="col-12 h3 text-center text-md-start">
                    Parents Information
                </div>
         
                <div class="col-md-6">
                    <label for="father" class="form-label">Father's Name:<span style="color:red;"> *</span></label>
                    <input class="form-control" id="father" name="father_name" type="text" placeholder="Full Name" aria-label="default input" required/>
                </div>
        

                <div class="col-md-6">
                    <label for="mother" class="form-label">Mother's Name:<span style="color:red;"> *</span></label>
                    <input class="form-control" name="mother_name" type="text" placeholder="Full Name" aria-label="default input" required/>
                </div>

                <div class="col-md-6 col-lg-4">
                    <label for="contact" class="form-label">Contact Number:<span style="color:red;"> *</span></label>
                    <input class="form-control" name="contact_number" type="tel" placeholder="Contact Number" id="telephone" placeholder="Contact Number" aria-label="default input" required/>
                </div>

            </div>

            <div class="row mb-4 mt-3">

                <div class="col-md-5 h4 text-center text-md-start ps-md-4">Complete Address:<span style="color:red;"> *</span></div>
                <div class="mb-3">
                    <textarea class="form-control" name="complete_address" rows="2"></textarea>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>


</body>
</html>
