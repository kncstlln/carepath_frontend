<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">A
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
          <div class="col-sm-2 mt-2 d-none d-lg-block"><img src="{{ asset('images/aclogo.png') }}" width="139px" height="139px"/></div>
        </div>
          <div class="row g-4 mb-5 text-center">
            <div class="col-6 col-md-3">
              <div class="p-2" id="listbox1">
                <span style="font-size:2rem;">{{ $dashboard['vaccine_count'] }}</span>  Vaccine Listed
              </div>
            </div>
            <div class="col-6 col-md-3">
              <div class="p-2" id="listbox2">
              <span style="font-size:2rem;">{{ $dashboard['barangay_count'] }}</span> Barangay List</div>
            </div>
            <div class="col-6 col-md-3">
              <div class="p-2" id="listbox3">
              <span style="font-size:2rem;">{{ $dashboard['partially_vaccinated_count'] }}</span> Partially Vaccinated</div>
            </div>
            <div class="col-6 col-md-3">
              <div class="p-2" id="listbox4">
              <span style="font-size:2rem;">{{ $dashboard['fully_vaccinated_count'] }}</span> Fully Vaccinated</div>
            </div>
          </div>
          <div class="row">
              <div class="col-12 p-3" id="lineChartCanvas">
                  <canvas id="lineChart"></canvas>
            </div>
          </div>
          <br><br>
          <div class="row">
              <div class="col-md-6">
                  <canvas id="upcomingPieChart"></canvas>
              </div>
              <div class="col-md-6">
                  <canvas id="missedPieChart"></canvas>
              </div>
          </div>
      </div>

<script>
console.log('Chart Script Executed');

const dashboardData = @json($dashboard);

const months = Object.keys(dashboardData.records_by_month);
const counts = Object.values(dashboardData.records_by_month);

const currentYear = new Date().getFullYear();

const ctx = document.getElementById('lineChart').getContext('2d');
const lineChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: months.map(month => `${month} ${currentYear}`),
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

console.log('Pie Chart Script Executed');

    const upcomingData = @json($upcomingVaccinations);
    const missedData = @json($missedVaccinations);

    function countVaccineOccurrences(data) {
        const vaccineCounts = {};
        
        if (data && data.length > 0) {
            data.forEach(item => {
                const vaccineName = item.vaccine_name;
                vaccineCounts[vaccineName] = (vaccineCounts[vaccineName] || 0) + 1;
            });
        }

        return vaccineCounts;
    }


    const upcomingVaccineCounts = countVaccineOccurrences(Array.isArray(upcomingData) ? upcomingData : []);
    const missedVaccineCounts = countVaccineOccurrences(Array.isArray(missedData) ? missedData : []);


    const upcomingLabels = Object.keys(upcomingVaccineCounts);
    const upcomingDataValues = Object.values(upcomingVaccineCounts);


    const missedLabels = Object.keys(missedVaccineCounts);
    const missedDataValues = Object.values(missedVaccineCounts);


    const upcomingPieCtx = document.getElementById('upcomingPieChart').getContext('2d');
    const missedPieCtx = document.getElementById('missedPieChart').getContext('2d');

    const pieChartOptions = {
        plugins: {
            title: {
                display: true,
                text: 'Upcoming Vaccinations',
                fontSize: 16,
                fontStyle: 'bold',
            },
            legend: {
                position: 'bottom',
                labels: {
                    boxWidth: 20,
                },
            },
        },
        elements: {
            arc: {
                borderWidth: 1,
            },
        },
    };

    const upcomingPieChart = new Chart(upcomingPieCtx, {
        type: 'pie',
        data: {
            labels: upcomingLabels,
            datasets: [{
                data: upcomingDataValues,
                backgroundColor: ['#003f5c', '#444e86', '#955196', '#dd5182', '#ff6e54', '#ffa600'],
            }]
        },
        options: pieChartOptions,
    });

    upcomingPieCtx.canvas.addEventListener('click', function(event) {
        const activeSlice = upcomingPieChart.getElementsAtEventForMode(event, 'nearest', { intersect: true }, false, false);
        if (activeSlice.length > 0) {
            const selectedLabel = upcomingLabels[activeSlice[0].index];
            const selectedData = upcomingData.find(item => item.vaccine_name === selectedLabel);

            if (selectedData) {
                const filterParam = encodeURIComponent(selectedData.vaccine_name);
                window.location.href = `{{ route('admin.upcoming') }}?upcoming-vaccine-filter=${filterParam}`;
            }
        }
    });

    const missedPieChart = new Chart(missedPieCtx, {
        type: 'pie',
        data: {
            labels: missedLabels,
            datasets: [{
                data: missedDataValues,
                backgroundColor: ['#003f5c', '#444e86', '#955196', '#dd5182', '#ff6e54', '#ffa600'],
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Missed Vaccinations',
                    fontSize: 16,
                    fontStyle: 'bold',
                },
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 20,
                    },
                },
            },
            elements: {
                arc: {
                    borderWidth: 1,
                },
            },
        },
    });

    missedPieCtx.canvas.addEventListener('click', function(event) {
        const activeSlice = missedPieChart.getElementsAtEventForMode(event, 'nearest', { intersect: true }, false, false);
        if (activeSlice.length > 0) {
            const selectedLabel = missedLabels[activeSlice[0].index];
            const selectedData = missedData.find(item => item.vaccine_name === selectedLabel);

            if (selectedData) {
                const filterParam = encodeURIComponent(selectedData.vaccine_name);
                window.location.href = `{{ route('admin.missed') }}?missed-vaccine-filter=${filterParam}`;
            }
        }
    });

    upcomingPieCtx.canvas.addEventListener('mousemove', function(event) {
        const activeSlice = upcomingPieChart.getElementsAtEventForMode(event, 'nearest', { intersect: true }, false, false);
        upcomingPieCtx.canvas.style.cursor = activeSlice.length > 0 ? 'pointer' : 'default';
    });

    missedPieCtx.canvas.addEventListener('mousemove', function(event) {
        const activeSlice = missedPieChart.getElementsAtEventForMode(event, 'nearest', { intersect: true }, false, false);
        missedPieCtx.canvas.style.cursor = activeSlice.length > 0 ? 'pointer' : 'default';
    });
</script>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</html>