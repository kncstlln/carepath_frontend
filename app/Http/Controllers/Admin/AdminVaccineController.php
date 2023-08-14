<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ApiService;

class AdminVaccineController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index()
    {
        $response = $this->apiService->get('/vaccines', session('token'));

        if (isset($response['data'])) {
            $vaccines = $response['data'];
        } else {
            $vaccines = [];
        }

        return view('admin.vaccines.index', compact('vaccines'));
    }

    public function updateStatus($id, Request $request)
    {
        $data = [
            'status' => $request->input('status')
        ];

        $response = $this->apiService->put("/vaccines/{$id}/update-status", $data, session('token'));

        if (isset($response['data'])) {
            // Status updated successfully, you might want to redirect or return a response
        } else {
            // Handle error, show an error message, etc.
        }
    }

    public function add()
    {
        return view('admin.vaccines.add');
    }

    public function store(Request $request)
    {
        $vaccineData = [
            'name' => $request->input('name'),
            'short_name' => $request->input('short_name'),
        ];

        // Send the vaccine data to the API
        $response = $this->apiService->post('/vaccines', $vaccineData, session('token'));

        if (isset($response['data'])) {
            $vaccineId = $response['data']['id'];
            $doseCount = (int) $request->input('dose_count');
            
            // Loop through each dose and send the data to the API
            for ($i = 1; $i <= $doseCount; $i++) {
                $doseData = [
                    'vaccine_id' => $vaccineId,
                    'dose_number' => $i,
                    'months_to_take' => (float) $request->input("dose_{$i}"),
                ];
                $this->apiService->post('/vaccine-doses', $doseData, session('token'));

                // Log the dose data for debugging
                \Log::debug("Dose {$i} Data:", $doseData);
            }

            // Redirect to the vaccines index page with a success message
            return redirect()->route('admin.vaccines.index')->with('success', 'Vaccine and doses added successfully.');
        }

        // Handle error cases
        return redirect()->route('admin.vaccines.add')->with('error', 'An error occurred while adding the vaccine and doses.');
    }

    public function delete($id)
    {
        // Set status to 2 (Deleted)
        $data = [
            'status' => 2
        ];

        $response = $this->apiService->put("/vaccines/{$id}/update-status", $data, session('token'));

        if (isset($response['data'])) {
   
            // Redirect or return a response as needed
            return redirect()->route('admin.vaccines.index')->with('success', 'Vaccine deleted successfully.');
        } else {
            // Handle error, show an error message, etc.
            return redirect()->route('admin.vaccines.index')->with('error', 'An error occurred while deleting the vaccine.');
        }
    }


}
