<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="../css/sidebar.css" rel="stylesheet"/>
    <script src="../js/sidebar.js" defer></script>
    <link href="../css/dashboard.css" rel="stylesheet"/>
    <link href="../css/vaccine.css" rel="stylesheet"/>
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/2eead9cc17.js" crossorigin="anonymous"></script>
    <script src="../js/dashboard.js"></script>
    <title>Vaccine List</title>
</head>
<body>
@include('sidebar')
    <div class="container-sm mt-4" id="targetclientlist">
        <div class="row mb-2">
            <div class="col-sm" id="infantsTxt">List of User</div>
        </div>
        <div class="row">
            <div class="col-sm">
              <a class="btn btn-primary btn-lg float-end mb-4" href="{{ url('/addUser') }}" role="button" id="button-add">Add New +</a>
            </div>
        </div>
      </div>
      <div class="container-md">
        <div class="table-responsive-lg text-center">
          <table class="table table-striped">
            <thead>
              <tr class="table-danger">
                <th scope="col">No.</th>
                <th scope="col">Name</th>
                <th scope="col">Location</th>
                <th scope="col">Position</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody class="table-group-divider">
              <tr>
                <th scope="row">1</th>
                <td class="table-secondary align-middle">Kane Castillano</td>
                <td class="align-middle">Salapungan Health Center</td>
                <td class="table-secondary">Staff</td>
                <td class="align-middle"><a href="editUser.html"><i class='bx bxs-pencil me-2'></i></a><i class="fa-solid fa-trash"></i></td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td class="table-secondary align-middle">Jello P. Mangune</td>
                <td class="align-middle">Brgy. Ninoy Aquino Health Center</td>
                <td class="table-secondary">Midwife</td>
                <td class="align-middle"><a href="editUser.html"><i class='bx bxs-pencil me-2'></i></a><i class="fa-solid fa-trash"></i></td>            
            </tr>
            <tr>
                <th scope="row">3</th>
                <td class="table-secondary align-middle">Nathaniel T. Allapitan</td>
                <td class="align-middle">Brgy. Ninoy Aquino Health Center</td>
                <td class="table-secondary">Midwife</td>
                <td class="align-middle"><a href="editUser.html"><i class='bx bxs-pencil me-2'></i></a><i class="fa-solid fa-trash"></i></td>            
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