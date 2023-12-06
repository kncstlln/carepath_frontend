<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="{{ asset('css/user/sidebar.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/user/dashboard.css') }}" rel="stylesheet"/>
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="{{ asset('js/sidebar.js') }}" defer></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('/images/logo.png') }}">
    <title>Dashboard</title>
</head>
<body>
    @include('user.sidebar')
    <div class="container content"> 
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
        <div class="row mt-3 mb-5" id="rectangle">
            <div class="col-sm-10" id="user">
                Hello {{ session('name') }},
                <div class="row">
                    <div class="col-sm" id="subtitle">
                        Have a nice day and do not forget to take care of your health!
                    </div>
                </div>
            </div>
            <div class="col-sm-2 mt-2 d-none d-lg-block">
                <img src="{{ asset('images/aclogo.png') }}" width="139px" height="139px"/>
            </div>
        </div>
        <div class="row g-4 mb-5 text-center">
            <div class="col-6 col-md-3">
                <div class="p-3 pt-4" id="listbox2">
                    <span style="font-size:1rem">Barangay {{session('barangay_name')}}</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-2" id="listbox1">
                    <span style="font-size:2rem;">{{ $dashboard['vaccine_count'] }}</span> Vaccine Listed
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-2" id="listbox3">
                    <span style="font-size:2rem;">{{ $dashboard['partially_vaccinated_count'] }}</span> Partially Vaccinated
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-2" id="listbox4">
                    <span style="font-size:2rem;">{{ $dashboard['fully_vaccinated_count'] }}</span> Fully Vaccinated
                </div>
            </div>
        </div>
        <div class="row g-4 mb-5 text-center">
            <div class="col-6 col-md-3">
                <div class="p-2" id="listbox1">
                    <span style="font-size:2rem; color:red;">{{ $numUpcomingVaccinations }}</span> Upcoming Vaccinations
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-2" id="listbox3">
                    <span style="font-size:2rem;color:red;">{{ $numMissedVaccinations }}</span> Missed Vaccinations
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

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

    // Check if the script executes
    console.log('Pie Chart Script Executed');

    // Get the data from the PHP variable $upcomingVaccinations and $missedVaccinations and convert them to JavaScript objects
    const upcomingData = @json($upcomingVaccinations);
    const missedData = @json($missedVaccinations);

    // Function to count occurrences of vaccine names in the data
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

    // Count vaccine occurrences in upcoming and missed vaccinations
    const upcomingVaccineCounts = countVaccineOccurrences(Array.isArray(upcomingData) ? upcomingData : []);
    const missedVaccineCounts = countVaccineOccurrences(Array.isArray(missedData) ? missedData : []);

    // Extract data for the upcoming pie chart
    const upcomingLabels = Object.keys(upcomingVaccineCounts);
    const upcomingDataValues = Object.values(upcomingVaccineCounts);

    // Extract data for the missed pie chart
    const missedLabels = Object.keys(missedVaccineCounts);
    const missedDataValues = Object.values(missedVaccineCounts);

    // Create the Chart.js pie charts
    const upcomingPieCtx = document.getElementById('upcomingPieChart').getContext('2d');
    const missedPieCtx = document.getElementById('missedPieChart').getContext('2d');

    const pieChartOptions = {
        plugins: {
            title: {
                display: true,
                text: 'Upcoming Vaccinations', // Change this to your desired title
                fontSize: 16,
                fontStyle: 'bold',
            },
            legend: {
                position: 'bottom',
                labels: {
                    boxWidth: 20, // Adjust the box width as needed
                },
            },
        },
        elements: {
            arc: {
                borderWidth: 1, // Border width
            },
        },
    };

    const upcomingPieChart = new Chart(upcomingPieCtx, {
        type: 'pie',
        data: {
            labels: upcomingLabels,
            datasets: [{
                data: upcomingDataValues,
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50', '#9C27B0', '#FF9800'],
            }]
        },
        options: pieChartOptions,
    });

    const missedPieChart = new Chart(missedPieCtx, {
        type: 'pie',
        data: {
            labels: missedLabels,
            datasets: [{
                data: missedDataValues,
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50', '#9C27B0', '#FF9800'],
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Missed Vaccinations', // Change this to your desired title
                    fontSize: 16,
                    fontStyle: 'bold',
                },
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 20, // Adjust the box width as needed
                    },
                },
            },
            elements: {
                arc: {
                    borderWidth: 1, // Border width
                },
            },
        },
    });
</script>
</body>
</html>
