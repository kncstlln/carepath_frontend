<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="{{ asset('css/admin/sidebar.css') }}" rel="stylesheet"/>
    <script src="{{ asset('js/sidebar.js') }}" defer></script>
    <link href="{{ asset('css/admin/dashboard.css') }}" rel="stylesheet"/>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('/images/logo.png') }}">
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <title>Dashboard</title>
</head>
<body id="dashboard">
  @include('admin.sidebar')
      <div class="container content"> 
        <div class="row mt-3 mb-5" id="rectangle">
          <div class="col-sm-10" id="user">Hello {{ session('name') }},
            <div class="row">
              <div class="col-sm" id="subtitle">
                Have a nice day and do not forget to take care of your health!
              </div>
            </div>
          </div>
          <div class="col-sm-2 mt-2 d-none d-lg-block"><img src="{{ asset('images/AC_LOGO.png') }}" width="139px" height="139px"/></div>
        </div>
          <div class="row g-4 mb-5 text-center">
            <div class="col-6 col-md-3">
              <div class="p-3" id="listbox1">
                <span style="font-size:1.5rem">{{ $dashboard['vaccine_count'] }}</span>  Vaccine Listed
              </div>
            </div>
            <div class="col-6 col-md-3">
              <div class="p-3" id="listbox2">
              <span style="font-size:1.5rem">{{ $dashboard['barangay_count'] }}</span> Barangay List</div>
            </div>
            <div class="col-6 col-md-3">
              <div class="p-3" id="listbox3">
              <span style="font-size:1.5rem">{{ $dashboard['partially_vaccinated_count'] }}</span> Partially Vaccinated</div>
            </div>
            <div class="col-6 col-md-3">
              <div class="p-3" id="listbox4">
              <span style="font-size:1.5rem">{{ $dashboard['fully_vaccinated_count'] }}</span> Fully Vaccinated</div>
            </div>
          </div>
          <div class="row">
              <div class="col-12 p-3" id="lineChartCanvas">
                  <canvas id="lineChart"></canvas>
            </div>
          </div>
      </div>

<script>
// Check if the script executes
console.log('Chart Script Executed');

// Get the data from the PHP variable $dashboard and convert it to JavaScript object
const dashboardData = @json($dashboard);

// Extract month names and counts from the received data
const months = Object.keys(dashboardData.records_by_month);
const counts = Object.values(dashboardData.records_by_month);

// Get the current year
const currentYear = new Date().getFullYear();

// Create the Chart.js line chart
const ctx = document.getElementById('lineChart').getContext('2d');
const lineChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: months.map(month => `${month} in ${currentYear}`),
        datasets: [{
            label: 'Vaccination Count',
            data: counts,
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</html>