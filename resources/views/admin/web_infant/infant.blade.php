<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="css/admin/sidebar.css" rel="stylesheet"/>
    <script src="js/sidebar.js" defer></script>
    <link href="css/admin/index.css" rel="stylesheet"/>
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/2eead9cc17.js" crossorigin="anonymous"></script>
    <script src="js/index.js"></script>
    <title>Dashboard</title>
</head>
  <body>
    @include('admin.sidebar')
      <div class="container-sm mt-4" id="targetclientlist">
        <div class="row mb-2">
            <div class="col-sm" id="infantsTxt">List of Infants</div>
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
            <div class="col-7 d-flex justify-content-end">
              <a class="btn btn-lg mb-4 addButton" href="addInfant" role="button" id="button-add">Add Infant +</a>
            </div>
        </div>
      </div>
      <div class="container-md">
        <div class="table-responsive-lg text-center  align-middle">
          <table class="table table-striped">
            <thead>
              <tr class="table-danger">
                <th scope="col">No.</th>
                <th scope="col">Family Serial Number</th>
                <th scope="col">Birth Date</th>
                <th scope="col">Date of Registration</th>
                <th scope="col">Name of Child</th>
                <th scope="col">Sex</th>
                <th scope="col">Tracking Number</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td class="table-secondary">312</td>
                <td>06/15/2002</td>
                <td class="table-secondary">06/15/2023</td>
                <td>Kane Erryl G. Castillano</td>
                <td class="table-secondary">M</td>
                <td>123131289</td>
                <td class="table-secondary">Fully Vaccinated</td>
                <td>
                  <table>
                    <tr>
                      <td class="text-center  align-middle"><a href="viewInfant"><i class="fa-solid fa-eye me-2"></i></a></td>
                      <td class="text-center  align-middle"><a href="editInfant"><i class='bx bxs-pencil me-2'></i></a></td>
                      <td class="text-center  align-middle"><i class="fa-solid fa-trash"></i></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td class="table-secondary">908</td>
                <td>06/15/2021</td>
                <td class="table-secondary">09/12/2023</td>
                <td>Jello P. Mangune</td>
                <td class="table-secondary">Dog</td>
                <td>123678093</td>
                <td class="table-secondary">Rabies Vaccinated</td>
                <td>
                  <table>
                    <tr>
                      <td class="text-center align-middle"><a href="viewInfant"><i class="fa-solid fa-eye me-2"></i></a></td>
                      <td class="text-center align-middle"><a href="editInfant"><i class='bx bxs-pencil me-2'></i></a></td>
                      <td class="text-center align-middle"><i class="fa-solid fa-trash"></i></td>
                    </tr>
                  </table>
                </td>              
              </tr>
              <tr>
                <th scope="row">3</th>
                <td class="table-secondary">912</td>
                <td>07/23/2022</td>
                <td class="table-secondary">10/31/2023</td>
                <td>Nathaniel T. Allapitan</td>
                <td class="table-secondary">M</td>
                <td>456978312</td>
                <td class="table-secondary">Not Vaccinated</td>
                <td>
                  <table>
                    <tr>
                      <td class="text-center align-middle"><a href="viewInfant"><i class="fa-solid fa-eye me-2"></i></a></td>
                      <td class="text-center align-middle"><a href="editInfant"><i class='bx bxs-pencil me-2'></i></a></td>
                      <td class="text-center align-middle"><i class="fa-solid fa-trash"></i></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <nav aria-label="Page navigation">
          <ul class="pagination justify-content-center justify-content-md-end mt-4">
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