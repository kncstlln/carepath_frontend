<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ApiService;

class UserUpcomingVaccination extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index(){
        $response = $this->apiService->get('/filtered-upcoming-vaccinations', session('token'));

        if (isset($response['data'])) {
            $upcomingVaccination= $response['data'];
        } else {
            $upcomingVaccination= [];
        }

        return view('user.upcoming', compact('upcomingVaccination'));
    }

    public function missedVaccinations(){
        $response = $this->apiService->get('/filtered-missed-vaccinations', session('token'));

        if (isset($response['data'])) {
            $missedVaccination= $response['data'];
        } else {
            $missedVaccination= [];
        }

        return view('user.missed', compact('missedVaccination'));
    }

}
