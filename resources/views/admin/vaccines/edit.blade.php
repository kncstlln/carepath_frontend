<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="{{ asset('css/admin/sidebar.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/admin/index.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/admin/addVaccine.css') }}" rel="stylesheet"/>
    <script src="{{ asset('js/sidebar.js') }}" defer></script>
    <script src="{{ asset('js/index.js') }}"></script>
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/2eead9cc17.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('/images/logo.png') }}">
    <title>Edit Vaccine</title>    
</head>
  <body>
  @include('admin/sidebar')
        <div class="container-sm content mt-4">
            <div class="row">
                <div class="col-sm mb-5" id="infantsTxt">Edit Vaccine Record</div>
            </div>
            <div class="container-sm createRecord">
                <div class="row">
                    <div class="col h2 mb-5 mt-3 text-center">Edit Vaccine Record</div>
                </div>
                <form action="{{ route('admin.vaccines.update', ['id' => $vaccine['id']]) }}" method="post">
                  @csrf
                  @method('PUT')
                  <div class="row mb-4">
                      <div class="col-md-3 pt-1 text-center">Name of Vaccine: </div>
                      <div class="col-md-4">
                          <input class="form-control" type="text" name="name" value="{{ $vaccine['name'] }}" aria-label="default input" required />
                      </div>
                  </div>
                  <div class="row mb-4">
                      <div class="col-md-3 pt-1 text-center">Short Name: </div>
                      <div class="col-md-4">
                          <input class="form-control" type="text" name="short_name" value="{{ $vaccine['short_name'] }}" aria-label="default input" required />
                      </div>
                  </div>
                  <div class="row mb-2">
                      <div class="col-md-4 col-xl-3 pt-2 text-center text-md-start ps-md-3 ps-lg-5">Vaccination Doses:</div>
                      <div class="col-md-2">
                          <input class="form-control" type="number" id="doseCount" name="dose_count" value="{{ count($vaccineDoses) }}" aria-label="default input" required />
                      </div>
                  </div>
                  <div id="doseFieldsContainer">
                      <!-- Dynamic fields will be generated here for editing doses -->
                     <!-- Update the foreach loop for displaying existing doses -->
                     @foreach($vaccineDoses as $dose)
                        <div class="row mb-2">
                            <div class="col-md-2 pt-2 text-center">Dose {{ $dose['dose_number'] }}:</div>
                            <div class="col-md-1">
                                <!-- Setting the "value" attribute to retrieve "months_to_take" as dose_number -->
                                <input class="form-control" type="text" name="doses[{{ $dose['id'] }}][months_to_take]" value="{{ $dose['months_to_take'] }}" aria-label="default input" required />
                            </div>
                            <div class="col-md-3 pt-2 text-center">months from birth</div>
                            <div class="col-md-2">
                                <input type="hidden" name="doses[{{ $dose['id'] }}][dose_number]" value="{{ $dose['dose_number'] }}" />
                            </div>
                        </div>
                        <!-- Include a hidden field for dose ID to identify existing doses -->
                        <input type="hidden" name="doses[{{ $dose['id'] }}][id]" value="{{ $dose['id'] }}" />
                    @endforeach


                  </div>
                  <div class="row mb-4 justify-content-center text-center text-lg-center">
                      <div class="col-md-3 col-lg-2 mt-1">
                          <a href="{{ route('admin.vaccines.index') }}"><button type="button" class="btn btn-secondary cancelButton">Cancel</button></a>
                      </div>
                      <div class="col-md-3 col-lg-2 mt-1">
                          <button type="submit" class="btn submitButton">Update</button>
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
    </body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"> </script>
</html>