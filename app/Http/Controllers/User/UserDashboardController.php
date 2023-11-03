<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ApiService;

class UserDashboardController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index()
    {
        $response = $this->apiService->get('/dashboard', session('token'));

        if (isset($response['data'])) {
            $dashboard = $response['data'];
        } else {
            $dashboard = [];
        }

        return view('user.dashboard', compact('dashboard'));
    }
}
