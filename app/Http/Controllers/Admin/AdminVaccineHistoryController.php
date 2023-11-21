<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ApiService;

class AdminVaccineHistoryController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index()
    {
        $responseRecords = $this->apiService->get('/immunization-records', session('token'));

        // Fetch the list of barangays
        $responseBarangays = $this->apiService->get('/barangays', session('token'));

        // Extract unique immunization years from the records' immunization dates
        $uniqueImmunizationYears = [];

        if (isset($responseRecords['data'])) {
            foreach ($responseRecords['data'] as $record) {
                $year = date('Y', strtotime($record['immunization_date']));
                if (!in_array($year, $uniqueImmunizationYears)) {
                    $uniqueImmunizationYears[] = $year;
                }
            }
        }

        $allBarangays = [];

        if (isset($responseBarangays['data'])) {
            foreach ($responseBarangays['data'] as $barangay) {
                $allBarangays[$barangay['id']] = $barangay['name'];
            }
        }

        return view('admin.history.index', compact('allBarangays', 'uniqueImmunizationYears'));
    }

    public function getFilteredImmunizationRecords($barangay_id, $year = null)
    {
        try {
            $filteredRecords = $this->apiService->get("/filtered-immunization-records/{$barangay_id}/{$year}", session('token'));

            if (isset($filteredRecords['data'])) {
                return response()->json(['data' => $filteredRecords['data']], 200);
            } else {
                return response()->json(['error' => 'No valid data received'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function add($id)
    {
        try {
            // Fetch the infant data from your API using the provided id
            $infantDataResponse = $this->apiService->get("/infants/{$id}", session('token'));

            if (isset($infantDataResponse['data'])) {
                $infantData = $infantDataResponse['data'];

                // Fetch the barangays from the API
                $barangaysResponse = $this->apiService->get('/barangays', session('token'));

                if (isset($barangaysResponse['data'])) {
                    $barangays = $barangaysResponse['data'];

                    // Find the corresponding barangay name
                    $barangayId = $infantData['barangay_id'];
                    $barangayName = '';

                    foreach ($barangays as $barangay) {
                        if ($barangay['id'] == $barangayId) {
                            $barangayName = $barangay['name'];
                            break;
                        }
                    }

                    // Fetch vaccine doses from your API
                    $vaccineDosesResponse = $this->apiService->get("/filtered-vaccine-doses/{$id}", session('token'));
                    $vaccineDoses = isset($vaccineDosesResponse['data']) ? $vaccineDosesResponse['data'] : [];

                    // Fetch vaccines from your API
                    $vaccinesResponse = $this->apiService->get('/vaccines', session('token'));
                    $vaccines = isset($vaccinesResponse['data']) ? $vaccinesResponse['data'] : [];

                    return view('admin.history.add', compact('infantData', 'barangayName', 'barangays', 'vaccineDoses', 'vaccines'));
                }
            }

            // Handle the case where fetching data fails
            return back()->with('error', 'Failed to fetch data.');
        } catch (\Exception $e) {
            // Handle exceptions if they occur during the API request
            return back()->with('error', 'An error occurred while fetching data.');
        }
    }

    public function store(Request $request)
    {
        try {
            $immunizationDate = date('Y-m-d', strtotime($request->input('immunization_date')));
            // Prepare the data to be sent to the API
            $data = [
                'infant_id' => $request->input('infant_id'),
                'vaccine_id' => $request->input('vaccine_id'),
                'dose_number' => $request->input('dose_number'),
                'administered_by' => $request->input('administered_by'),
                'barangay_id' => $request->input('barangay_id'),
                'remarks' => $request->input('remarks'),
                'immunization_date' => $immunizationDate, // Use the formatted date
            ];

            $response = $this->apiService->post('/immunization-records', $data, session('token'));

            if (isset($response['error'])) {
                // Handle the error response from the API
                return back()->with('error', $response['error']);
            } else if (isset($response['data'])) {
                // Successfully stored the data, extract the infant_id from the response
                $infantId = $response['data']['infant_id'];

                // Redirect to the admin/infants/{infant_id} route
                return redirect()->route('admin.infants.view', ['id' => $infantId])->with('success', 'Immunization record added successfully');
            } else {
                return back()->with('error', 'Failed to store immunization record.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while storing the immunization record.');
        }
    }

    public function delete($id)
    {
        try {
            // Send a request to your API to delete the immunization record with the provided ID
            $response = $this->apiService->delete("/immunization-records/{$id}", session('token'));

            if (isset($response['data'])) {
                // Return a JSON response indicating success
                return response()->json(['success' => true], 200);
            } else {
                // Handle the error, you can return an error response as needed
                return response()->json(['success' => false, 'message' => 'Failed to delete immunization record.'], 500);
            }
        } catch (\Exception $e) {
            // Handle exceptions if they occur during the API request
            return response()->json(['success' => false, 'message' => 'An error occurred while deleting the infant record.'], 500);
        }
    }


}
