<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="{{ asset('css/admin//sidebar.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/admin/index.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/admin/addVaccine.css') }}" rel="stylesheet"/>
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/2eead9cc17.js" crossorigin="anonymous"></script>
    <title>Add Barangay</title>    
</head>
<body>
    @include('admin.sidebar')
    <div class="container-sm mt-4">
        <div class="row">
            <div class="col-sm mb-5" id="infantsTxt">Add Barangay</div>
        </div>
        <div class="container-sm createRecord">
            <div class="row">
                <div class="col h2 mb-5 mt-3 text-center">Add Barangay</div>
            </div>
            <form action="{{ route('admin.barangays.store') }}" method="POST">
                @csrf
                <div class="row mb-4">
                    <div class="col-md-4 col-lg-3 pt-1 text-center">Name of Barangay: </div>
                    <div class="col-md-4 col-lg-3">
                        <input class="form-control" type="text" name="name" placeholder="Barangay Name" aria-label="default input" required/>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 col-lg-3 pt-2 text-center">Location:</div>
                    <div class="col-md-4 col-lg-3">
                        <input class="form-control" type="text" name="location" placeholder="Location" aria-label="default input" required/>
                    </div>
                </div>
                <!-- Add more input fields here if needed -->

                <div class="row mb-4 mt-5 justify-content-center text-center">
                    <div class="col-md-3 col-lg-2 mt-1">
                        <a href="{{ route('admin.barangays.index') }}">
                            <button type="button" class="btn btn-secondary cancelButton">Cancel</button>
                        </a>
                    </div>
                    <div class="col-md-3 col-lg-2 mt-1">
                        <button type="submit" class="btn submitButton">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"> </script>
</body>
</html>
