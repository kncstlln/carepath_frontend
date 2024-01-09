@include('admin/head')
<title>Add Barangay</title>   
<body>
    @include('admin.sidebar')
    <div class="container-sm content mt-4">
        <div class="row">
            <div class="col-sm mb-5" id="infantsTxt">Add Barangay</div>
        </div>
        <div class="container-sm createRecord">
            <div class="row">
                <div class="col h2 mb-5 mt-3 text-center">Add Barangay</div>
            </div>
            <form action="{{ route('admin.barangays.store') }}" method="POST">
                @csrf
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
                <div class="row mb-4">
                    <div class="col-md-4 col-lg-3 pt-1 text-center">Name of Barangay:<span style="color:red;"> *</span></div>
                    <div class="col-md-4 col-lg-3">
                        <input class="form-control" type="text" name="name" placeholder="Barangay Name" aria-label="default input" required/>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 col-lg-3 pt-2 text-center">Location:<span style="color:red;"> *</span></div>
                    <div class="col-md-4 col-lg-3">
                        <input class="form-control" type="text" name="location" placeholder="Location" aria-label="default input" required/>
                    </div>
                </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
