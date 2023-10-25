<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ApiService;
use Illuminate\Http\Request;

class AdminUpcomingVaccination extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index(){
        $response = $this->apiService->get('/upcoming-vaccinations', session('token'));

        if (isset($response['data'])) {
            $upcomingVaccination= $response['data'];
        } else {
            $upcomingVaccination= [];
        }

        return view('admin.upcoming', compact('upcomingVaccination'));
    }

    public function missedVaccinations(){
        $response = $this->apiService->get('/missed-vaccinations', session('token'));

        if (isset($response['data'])) {
            $missedVaccination= $response['data'];
        } else {
            $missedVaccination= [];
        }

        return view('admin.missed', compact('missedVaccination'));
    }
}
