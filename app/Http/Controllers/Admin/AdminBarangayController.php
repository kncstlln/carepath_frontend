<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ApiService;

class AdminBarangayController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index()
    {
        // Fetch data from the API endpoint
        $response = $this->apiService->get('/barangays', session('token')); // Assuming 'token' is stored in the session

        if (isset($response['data'])) {
            $barangays = $response['data'];
        } else {
            $barangays = [];
        }

        return view('admin.barangays.index', compact('barangays'));
    }

    public function updateStatus(Request $request, $id)
    {
        $data = $request->validate([
            'status' => 'required|in:0,1',
        ]);

        // You might want to implement some additional logic here, like checking if the barangay exists

        // Update the status
        // Assuming your ApiService has a method like `put` to update a resource
        $response = $this->apiService->put("/barangays/{$id}/update-status", $data, session('token'));

        return redirect()->back()->with('message', 'Status updated successfully');
    }

    public function create()
    {
        return view('admin.barangays.add');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'location' => 'required',
            // ... other validation rules ...
        ]);

        // Assuming your ApiService has a method like `post` to create a resource
        $response = $this->apiService->post("/barangays", $data, session('token'));

        return redirect()->route('admin.barangays.index')->with('message', 'Barangay added successfully');
    }

}
