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
            return redirect()->route('admin.vaccines.index')->with('success', 'Status updated successfully.');
        } else {
            // Handle error, show an error message, and redirect to the index page with an error
            return redirect()->route('admin.vaccines.index')->withErrors(['error' => 'An error occurred while updating the status.']);
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
            return redirect()->route('admin.vaccines.index')->with('success', 'Vaccine added successfully.');
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

    public function view($id)
    {
        // Retrieve vaccine data
        $vaccineResponse = $this->apiService->get("/vaccines/{$id}", session('token'));

        // Retrieve vaccine doses data
        $dosesResponse = $this->apiService->get("/vaccine-doses/{$id}", session('token'));

        if (isset($vaccineResponse['data']) && isset($dosesResponse['data'])) {
            $vaccine = $vaccineResponse['data'];
            $vaccineDose = $dosesResponse['data']; // Rename the variable for dose information
        } else {
            // Handle the case where the vaccine with the specified ID is not found or doses are not available.
            // You can redirect or show an error message.
            if (!isset($vaccineResponse['data'])) {
                // Log an error or redirect with an error message
                return redirect()->route('vaccine.index')->with('error', 'Vaccine not found.');
            }
            if (!isset($dosesResponse['data'])) {
                // Log an error or redirect with an error message
                return redirect()->route('vaccine.index')->with('error', 'Doses not available for this vaccine.');
            }
        }

        return view('admin.vaccines.view', compact('vaccine', 'vaccineDose')); // Pass both variables to the view
    }

    public function edit($id)
    {
        // Retrieve vaccine data
        $vaccineResponse = $this->apiService->get("/vaccines/{$id}", session('token'));

        // Retrieve vaccine doses data
        $dosesResponse = $this->apiService->get("/vaccine-doses/{$id}", session('token'));

        if (isset($vaccineResponse['data']) && isset($dosesResponse['data'])) {
            $vaccine = $vaccineResponse['data'];
            $vaccineDoses = $dosesResponse['data'];
        } else {
            // Handle the case where the vaccine with the specified ID is not found or doses are not available.
            // You can redirect or show an error message.
            if (!isset($vaccineResponse['data'])) {
                // Log an error or redirect with an error message
                return redirect()->route('vaccine.index')->with('error', 'Vaccine not found.');
            }
            if (!isset($dosesResponse['data'])) {
                // Log an error or redirect with an error message
                return redirect()->route('vaccine.index')->with('error', 'Doses not available for this vaccine.');
            }
        }

        return view('admin.vaccines.edit', compact('vaccine', 'vaccineDoses'));
    }

    public function update(Request $request, $id)
    {
        // Validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'short_name' => 'required|string|max:255',
        ];

        // Validate the request data
        $validatedData = $request->validate($rules);

        // Prepare vaccine data
        $vaccineData = [
            'name' => $validatedData['name'],
            'short_name' => $validatedData['short_name'],
        ];

        // Update the vaccine data
        $vaccineResponse = $this->apiService->put("/vaccines/{$id}", $vaccineData, session('token'));

        if (isset($vaccineResponse['data'])) {
            $vaccineId = $vaccineResponse['data']['id'];
            $doseCount = (int) $request->input('dose_count');

            // Loop through each dose and send the data to the API
            // Loop through each dose and send the data to the API
            foreach ($request->input('doses') as $doseId => $doseData) {
                $doseData = [
                    'vaccine_id' => $vaccineId,
                    'dose_number' => (int) $doseData['dose_number'],
                    'months_to_take' => (float) $doseData['months_to_take'],
                ];
                $this->apiService->put("/vaccine-doses/{$doseId}", $doseData, session('token'));

                // Log the dose data for debugging
                \Log::debug("Dose {$doseData['dose_number']} Data:", $doseData);
            }


            // Redirect to the vaccine view page with a success message
            return redirect()->route('admin.vaccines.view', ['id' => $vaccineId])->with('success', 'Vaccine and doses updated successfully.');
        } else {
            // Handle error cases
            return redirect()->route('admin.vaccines.edit', ['id' => $id])->with('error', 'An error occurred while updating the vaccine and doses.');
        }
    }





}
