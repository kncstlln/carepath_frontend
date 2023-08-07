<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="css/sidebar.css" rel="stylesheet"/>
    <script src="js/sidebar.js" defer></script>
    <link href="css/dashboard.css" rel="stylesheet"/>
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="js/dashboard.js"></script>
    <title>Dashboard</title>
</head>
<body>
  <nav class="sidebar locked z-2">
    <div class="logo_items flex">
      <span class="nav_image">
        <img src="images/logo.png" alt="logo_img" />
      </span>
      <span class="logo_name">Carepath</span>
      <i class="bx bx-lock-alt" id="lock-icon" title="Unlock Sidebar"></i>
      <i class="bx bx-x" id="sidebar-close"></i>
    </div>
    <div class="menu_container">
      <div class="menu_items">
        <ul class="menu_item" style="padding-left:0%;">
          <li class="item">
            <a href="dashboard.html" class="link flex">
              <i class="bx bx-home-alt homeicon"></i>
              <span>Dashboard</span>
            </a>
          </li>
          <li class="item">
            <a href="web_infant/infant.html" class="link flex">
              <i class="bx bx-grid-alt"></i>
              <span>Target Client List</span>
            </a>
          </li>
          <li class="item">
            <a href="web_history/history.html" class="link flex">
              <i class='bx bx-history'></i>
              <span>Vaccination History</span>
            </a>
          </li>
          <div class="menu_title flex">
            <span class="title">Maintenance</span>
            <span class="line"></span>
          </div>
          <li class="item">
            <a href="web_vaccine/vaccine.html" class="link flex">
              <i class='bx bx-injection'></i>
              <span>Vaccine List</span>
            </a>
          </li>
          <li class="item">
            <a href="web_barangay/barangay.html" class="link flex">
              <i class='bx bx-building-house'></i>
              <span>Barangay List</span>
            </a>
          </li>
          <li class="item">
            <a href="web_user/user.html" class="link flex">
              <i class='bx bx-user'></i>
              <span>User List</span>
            </a>
          </li>
          <div class="menu_title flex">
            <span class="title">Notifications</span>
            <span class="line"></span>
          </div>
          <li class="item">
            <a href="upcoming.html" class="link flex">
              <i class="bx bx-flag"></i>
              <span>Upcoming Vaccination</span>
            </a>
          </li>
          <li class="item">
            <a href="missed.html" class="link flex">
              <i class='bx bx-calendar-exclamation' ></i>
              <span>Missed Vaccination</span>
            </a>
          </li>
        </ul>
      </div>
      <!-- Navbar -->
            <nav class="navbar flex">
                <i class="bx bx-menu" id="sidebar-open"></i>
            </nav>
        </div>
    </nav>
      <div class="container"> 
        <div class="row mt-3 mb-5" id="rectangle">
          <div class="col-sm-10" id="user">Hello Varona,
            <div class="row">
              <div class="col-sm" id="subtitle">
                Have a nice day and do not forget to take care of your health!
              </div>
            </div>
          </div>
          <div class="col-sm-2 mt-2 d-none d-lg-block"><img src="images/AC_LOGO.png" width="139px" height="139px"/></div>
        </div>
          <div class="row g-4 mb-5 text-center">
            <div class="col-6 col-md-3">
              <div class="p-1 pt-4" id="listbox1"><i class='bx bx-injection'></i>  Vaccine Listed</div>
            </div>
            <div class="col-6 col-md-3">
              <div class="p-1 pt-4" id="listbox2">Barangay List</div>
            </div>
            <div class="col-6 col-md-3">
              <div class="p-1 pt-4" id="listbox3">Partially Vaccinated</div>
            </div>
            <div class="col-6 col-md-3">
              <div class="p-1 pt-4" id="listbox4">Fully Vaccinated</div>
            </div>
          </div>
          <div class="row g-2" style="border:1px solid red;">
            <div class="col-sm-9 p-3" style="border:1px solid blue;">Column</div>
            <div class="col-sm-3 p-3" style="border:1px solid blue;">Column</div>
          </div>
      </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</html>