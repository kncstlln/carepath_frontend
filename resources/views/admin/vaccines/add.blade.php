<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="{{ asset('css/admin/sidebar.css') }}" rel="stylesheet"/>
    <script src="js/sidebar.js" defer></script>
    <link href="{{ asset('css/admin/dashboard.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/admin/addVaccine.css') }}" rel="stylesheet"/>
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/2eead9cc17.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <title>Add Infant</title>    
</head>
<body>
    @include('admin/sidebar')
    <div class="container-sm mt-4">
        <div class="row">
            <div class="col-sm mb-5" id="infantsTxt">Create Vaccine Record</div>
        </div>
        <div class="container-sm createRecord">
            <div class="row">
                <div class="col h2 mb-5 mt-3 text-center">Create Vaccine Record</div>
            </div>
            <form>
                <div class="row mb-4">
                    <div class="col-md-3 pt-1 text-center">Name of Vaccine: </div>
                    <div class="col-md-4">
                        <input class="form-control" type="text" placeholder="Vaccine Name" aria-label="default input" required/>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-3 pt-1 text-center">Short Name: </div>
                    <div class="col-md-4">
                        <input class="form-control" type="text" placeholder="Short Name" aria-label="default input" required/>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 col-xl-3 pt-2 text-center text-md-start ps-md-3 ps-lg-5">Vaccination Doses:</div>
                    <div class="col-md-2">
                        <input class="form-control" type="number" id="doseCount" placeholder="Enter Dose Count" aria-label="default input" required/>
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
