@include('admin/head')
<title>Add Vaccine</title>    
<body>
    @include('admin/sidebar')
    <div class="container-sm content mt-4">
        <div class="row">
            <div class="col-sm mb-5" id="infantsTxt">Create Vaccine Record</div>
        </div>
        <div class="container-sm createRecord">
            <div class="row">
                <div class="col h2 mb-5 mt-3 text-center">Create Vaccine Record</div>
            </div>
            <form action="{{ route('admin.vaccines.store') }}" method="post">
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
                    <div class="col-md-3 pt-1 text-center">Name of Vaccine:<span style="color:red;"> *</span></div>
                    <div class="col-md-4">
                        <input class="form-control" type="text" name="name" placeholder="Vaccine Name" aria-label="default input" maxlength="50" required/>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-3 pt-1 text-center">Short Name:<span style="color:red;"> *</span></div>
                    <div class="col-md-4">
                        <input class="form-control" type="text" name="short_name" placeholder="Short Name" aria-label="default input" required/>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 col-xl-3 pt-2 text-center text-md-start ps-md-3 ps-lg-5">Vaccination Doses:<span style="color:red;"> *</span></div>
                    <div class="col-md-2">
                        <input class="form-control" type="number" id="doseCount" name="dose_count" placeholder="Enter Dose Count" min="1" max="5" aria-label="default input" required/>
                    </div>
                </div>

                <div id="doseFieldsContainer">
                    <!-- Dynamic fields will be generated here -->
                </div>

                <div class="row mb-4 justify-content-center text-center text-lg-center">
                    <div class="col-md-3 col-lg-2 mt-1">
                        <a href="{{ url('/admin/vaccines') }}"><button type="button" class="btn btn-secondary cancelButton">Cancel</button></a>
                    </div>
                    <div class="col-md-3 col-lg-2 mt-1">
                        <button type="submit" class="btn submitButton">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const doseCountInput = document.getElementById('doseCount');
            const doseFieldsContainer = document.getElementById('doseFieldsContainer');

            doseCountInput.addEventListener('change', function () {
                const doseCount = parseInt(doseCountInput.value);
                doseFieldsContainer.innerHTML = '';

                for (let i = 1; i <= doseCount; i++) {
                    const div = document.createElement('div');
                    div.classList.add('row', 'mb-2');
                    div.innerHTML = `
                        <div class="col-md-2 pt-2 text-center">Dose ${i}:</div>
                        <div class="col-md-1">
                            <input class="form-control" type="text" name="dose_${i}" placeholder="Dose ${i}" aria-label="default input" required/>
                        </div>
                        <div class="col-md-3 pt-2 text-center">months from birth</div>
                    `;
                    doseFieldsContainer.appendChild(div);
                }
            });
        });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
