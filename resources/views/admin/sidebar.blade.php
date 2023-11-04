<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/admin/sidebar.css') }}" />
    <script src="https://kit.fontawesome.com/2eead9cc17.js" crossorigin="anonymous"></script>
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="{{ asset('js/sidebar.js') }}" defer></script>
  </head>
  <body>
  <nav class="sidebar z-2">
      <div class="logo_items flex">
        <span class="nav_image">
          <img src="{{ asset('images/logo.png') }}" alt="logo_img" />
        </span>
        <span class="logo_name">Carepath</span>
        <!-- <i class="bx bx-lock-alt" id="lock-icon" title="Unlock Sidebar"></i>
        <i class="bx bx-x" id="sidebar-close"></i> -->
      </div>
      <div class="menu_container">
        <div class="menu_items">
          <ul class="menu_item" style="padding-left:0%;">
            <li class="item">
              <a href="/admin/dashboard" class="link flex">
                <i class="bx bx-home-alt homeicon"></i>
                <span>Dashboard</span>
              </a>
            </li>
            <li class="item">
              <a href="/admin/infants" class="link flex">
                <i class="bx bx-grid-alt"></i>
                <span>Target Client List</span>
              </a>
            </li>
            <li class="item">
              <a href="/admin/history" class="link flex">
                <i class='bx bx-history'></i>
                <span>Vaccination History</span>
              </a>
            </li>
            <div class="menu_title flex">
              <span class="title">Maintenance</span>
              <span class="line"></span>
            </div>
            <li class="item">
              <a href="/admin/vaccines" class="link flex">
                <i class='bx bx-injection'></i>
                <span>Vaccine List</span>
              </a>
            </li>
            <li class="item">
              <a href="/admin/barangays" class="link flex">
                <i class='bx bx-building-house'></i>
                <span>Barangay List</span>
              </a>
            </li>
            <li class="item">
              <a href="/admin/users" class="link flex">
                <i class='bx bx-user'></i>
                <span>User List</span>
              </a>
            </li>
            <div class="menu_title flex">
              <span class="title">Notifications</span>
              <span class="line"></span>
            </div>
            <li class="item">
              <a href="/admin/upcoming-vaccinations" class="link flex">
                <i class="bx bx-flag"></i>
                <span>Upcoming Vaccination</span>
              </a>
            </li>
            <li class="item">
              <a href="/admin/missed-vaccinations" class="link flex">
                <i class='bx bx-calendar-exclamation' ></i>
                <span>Missed Vaccination</span>
              </a>
            </li>
          </ul>
        </div>
        <div class="sidebar_profile flex">
          <a href="/admin/account" class="userAccount" style="text-decoration:none; color: black">
            <span class="nav_image">
            <i class="fa-solid fa-user fa-2xl"></i>
            </span>
            <div class="data_text">
              <div class="row">
                <div class="col-12 name">
                {{ session('name') }}
                </div>
              </div>
              <div class="row" style=" width:300px">
            
                <div class="col-auto">
                  <a href="{{ route('logout') }}">Logout</a> 
                </div>
    
              </div>
            </div>
          </a>
        </div>
      </div>
  </nav>

              <nav class="navbar flex">
                  <i class="bx bx-menu" id="sidebar-open"></i>
              </nav>
 
      
  </body>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</html>