<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;

class DashboardController extends Controller
{
    public function index(ApiService $apiService)
    {
        $usersResponse = $apiService->get('/users', 'hUf1ZaTIqiS1m58gQ11SVDdJL6uH5AZSgCWeEZJg'); // Assuming '/users' is the API endpoint for fetching users
        $barangaysResponse = $apiService->get('/barangays', 'hUf1ZaTIqiS1m58gQ11SVDdJL6uH5AZSgCWeEZJg'); // Assuming '/barangays' is the API endpoint for fetching barangays
        
        if (isset($usersResponse['error'])) {
            // Handle error for users
            // For example, you can flash an error message and redirect
            return redirect()->back()->with('error', $usersResponse['message']);
        }
        
        if (isset($barangaysResponse['error'])) {
            // Handle error for barangays
            // For example, you can flash an error message and redirect
            return redirect()->back()->with('error', $barangaysResponse['message']);
        }

        $users = $usersResponse['data'];
        $barangays = $barangaysResponse['data'];

        return view('dashboard1', compact('users', 'barangays'));
    }
}
