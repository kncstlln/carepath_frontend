<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/sidebar.css" />
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="{{ asset('js/sidebar.js') }}" defer></script>
  </head>
  <body>
  <nav class="sidebar locked z-2">
      <div class="logo_items flex">
        <span class="nav_image">
          <img src="{{ asset('images/logo.png') }}" alt="logo_img" />
        </span>
        <span class="logo_name">Carepath</span>
        <i class="bx bx-lock-alt" id="lock-icon" title="Unlock Sidebar"></i>
        <i class="bx bx-x" id="sidebar-close"></i>
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
              <a href="/infant" class="link flex">
                <i class="bx bx-grid-alt"></i>
                <span>Target Client List</span>
              </a>
            </li>
            <li class="item">
              <a href="/history" class="link flex">
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
              <a href="/userlist" class="link flex">
                <i class='bx bx-user'></i>
                <span>User List</span>
              </a>
            </li>
            <div class="menu_title flex">
              <span class="title">Notifications</span>
              <span class="line"></span>
            </div>
            <li class="item">
              <a href="/upcoming" class="link flex">
                <i class="bx bx-flag"></i>
                <span>Upcoming Vaccination</span>
              </a>
            </li>
            <li class="item">
              <a href="/missed" class="link flex">
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
      
  </body>
</html>