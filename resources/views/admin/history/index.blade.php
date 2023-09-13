<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="{{ asset('css/admin/sidebar.css') }}" rel="stylesheet"/>
    <script src="{{ asset('js/sidebar.js') }}" defer></script>
    <link href="{{ asset('css/admin/history.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/admin/brgySelect.css') }}" rel="stylesheet"/>
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/2eead9cc17.js" crossorigin="anonymous"></script>
    <title>Dashboard</title>
</head>
<body>
@include('admin/sidebar')
    <div class="container-sm mt-4" id="targetclientlist">
        <div class="row mb-2">
            <div class="col-sm" id="infantsTxt">History of Vaccinations</div>
        </div>
        <div class="row mb-5">
            <div class="col-3 w-auto">
            <select class="form-select mb-3 " aria-label=".form-select-lg example">
                <option selected value="1">Lourdes NorthWest</option>
                <option value="2">Ninoy Aquino(Marisol)</option>
                <option value="3">Salapungan</option>
            </select>
          </div>
          <div class="col-6 w-auto">
            <select class="form-select mb-3 " aria-label=".form-select-lg example">
              <option selected value="1">2024</option>
              <option value="2">2023</option>
              <option value="3">2022</option>
            </select>
          </div>
        </div>
        <div class="row d-flex justify-content-end" >
            <div class="col-9 d-flex justify-content-end">
              <a class="btn btn-lg mb-4 addButton" href="addHistory" role="button" id="button-add">Create History +</a>
            </div>
        </div>
      </div>
      <div class="container-md">
        <div class="table-responsive-lg text-center">
          <table class="table table-striped">
            <thead>
              <tr class="table-danger">
                <th scope="col">No.</th>
                <th scope="col">Date Created</th>
                <th scope="col">Individual</th>
                <th scope="col">Vaccine</th>
                <th scope="col">Type</th>
                <th scope="col">Encoder</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody class="table-group-divider">
              <tr>
                <th scope="row">1</th>
                <td class="table-secondary">01/13/2023</td>
                <td>Jello P. Mangune</td>
                <td class="table-secondary">DPT-Hib-HepB
                <td>2nd dose</td>
                <td class="table-secondary">administrator</td>
                <td><a href="viewHistory"><i class="fa-solid fa-eye me-2"></i></a><a href="editHistory"><i class='bx bxs-pencil me-2'></i></a><i class="fa-solid fa-trash"></i></td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td class="table-secondary">07/15/2023</td>
                <td>Kane Erryl G. Castillano</td>
                <td class="table-secondary">OPV</td>
                <td>2nd dose</td>
                <td class="table-secondary">administrator</td>
                <td><a href="viewHistory"><i class="fa-solid fa-eye me-2"></i></a><a href="editHistory"><i class='bx bxs-pencil me-2'></i></a><i class="fa-solid fa-trash"></i></td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td class="table-secondary">09/03/2023</td>
                <td>Nathaniel Allapitan</td>
                <td class="table-secondary">PCV</td>
                <td>1st dose</td>
                <td class="table-secondary">User was deleted</td>
                <td><a href="viewHistory"><i class="fa-solid fa-eye me-2"></i></a><a href="editHistory"><i class='bx bxs-pencil me-2'></i></a><i class="fa-solid fa-trash"></i></td>
              </tr>
            </tbody>
          </table>
        </div>
        <nav aria-label="Page navigation">
          <ul class="pagination justify-content-end mt-4">
            <li class="page-item disabled">
              <a class="page-link paginationTxt">Previous</a>
            </li>
            <li class="page-item"><a class="page-link paginationTxt" href="#">1</a></li>
            <li class="page-item"><a class="page-link paginationTxt" href="#">2</a></li>
            <li class="page-item"><a class="page-link paginationTxt" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link paginationTxt" href="#">Next</a>
            </li>
          </ul>
        </nav>
      </div>
  </body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</html>
</body>
</html>