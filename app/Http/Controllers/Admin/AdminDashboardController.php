<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ApiService;

class AdminDashboardController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index()
    {
        $dashboardResponse = $this->apiService->get('/dashboard', session('token'));
        $dashboard = isset($dashboardResponse['data']) ? $dashboardResponse['data'] : [];

        // Fetch data from '/upcoming-vaccinations' endpoint
        $upcomingResponse = $this->apiService->get('/upcoming-vaccinations', session('token'));
        $upcomingVaccinations = isset($upcomingResponse['data']) ? $upcomingResponse['data'] : [];
        $numUpcomingVaccinations = count($upcomingVaccinations);

        // Fetch data from '/missed-vaccinations' endpoint
        $missedResponse = $this->apiService->get('/missed-vaccinations', session('token'));
        $missedVaccinations = isset($missedResponse['data']) ? $missedResponse['data'] : [];
        $numMissedVaccinations = count($missedVaccinations);

        return view('admin.dashboard', compact('dashboard', 'upcomingVaccinations', 'numUpcomingVaccinations', 'missedVaccinations', 'numMissedVaccinations'));
    }
}
