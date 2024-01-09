@include('admin/head')
<title>Edit Vaccine</title>    
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
                  @method('PUT')
                  <div class="row mb-4">
                      <div class="col-md-3 pt-1 text-center">Name of Vaccine: </div>
                      <div class="col-md-4">
                          <input class="form-control" type="text" name="name" value="{{ $vaccine['name'] }}" aria-label="default input" maxlength="50" required />
                      </div>
                  </div>
                  <div class="row mb-4">
                      <div class="col-md-3 pt-1 text-center">Short Name: </div>
                      <div class="col-md-4">
                          <input class="form-control" type="text" name="short_name" value="{{ $vaccine['short_name'] }}" aria-label="default input" required/>
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