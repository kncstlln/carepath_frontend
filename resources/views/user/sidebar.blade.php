<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="{{ asset('css/user/sidebar.css') }}" rel="stylesheet"/>
    <script src="{{ asset('css/user/sidebar.js') }}" defer></script>
    <link href="{{ asset('css/user/dashboard.css') }}" rel="stylesheet"/>
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="{{ asset('css/user/dashboard.js') }}"></script>
    <title>Dashboard</title>
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
            <a href="/user/dashboard" class="link flex">
              <i class="bx bx-home-alt homeicon"></i>
              <span>Dashboard</span>
            </a>
          </li>
          <li class="item">
            <a href="/user/infants" class="link flex">
              <i class="bx bx-grid-alt"></i>
              <span>Target Client List</span>
            </a>
          </li>
          <li class="item">
            <a href="/user/history/" class="link flex">
              <i class='bx bx-history'></i>
              <span>Vaccination History</span>
            </a>
          </li>
          <div class="menu_title flex">
            <span class="title">Notifications</span>
            <span class="line"></span>
          </div>
          <li class="item">
            <a href="/user/upcoming-vaccinations" class="link flex">
              <i class="bx bx-flag"></i>
              <span>Upcoming Vaccination</span>
            </a>
          </li>
          <li class="item">
            <a href="/user/missed-vaccinations" class="link flex">
              <i class='bx bx-calendar-exclamation' ></i>
              <span>Missed Vaccination</span>
            </a>
          </li>
        </ul>
      </div>
      <div class="sidebar_profile flex">
      <a href="/account" class="userAccount" style="text-decoration:none;">
          <span class="nav_image">
            <img src="{{ asset('images/profile.jpg') }}" alt="logo_img" />
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
   
            <!-- {{ session('name') }} -->
          </div>
      </a>
          <nav class="navbar flex">
              <i class="bx bx-menu" id="sidebar-open"></i>
          </nav>
      </div>
    </div>
    </nav>