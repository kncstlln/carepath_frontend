<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ApiService;
use App\Events\RegisterNotifications;

class AdminTCLController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index()
    {

        // Fetch the list of infants
        $responseInfants = $this->apiService->get('/infants', session('token'));

        // Fetch the list of barangays
        $responseBarangays = $this->apiService->get('/barangays', session('token'));

        // Extract unique birth years from the infants' birth dates
        $uniqueBirthYears = [];

        if (isset($responseInfants['data'])) {
            foreach ($responseInfants['data'] as $infant) {
                $birthYear = date('Y', strtotime($infant['birth_date']));
                if (!in_array($birthYear, $uniqueBirthYears)) {
                    $uniqueBirthYears[] = $birthYear;
                }
            }
        }

        $infants = [];
        $barangays = [];

        if (isset($responseInfants['data'])) {
            foreach ($responseInfants['data'] as $infant) {
                // Convert date format to "Month day, year" format
                $birthDate = new \DateTime($infant['birth_date']);
                $infant['birth_date'] = $birthDate->format('F d, Y');

                $createdAt = new \DateTime($infant['created_at']);
                $infant['created_at'] = $createdAt->format('F d, Y');

                if ($infant['sex'] === 'Male') {
                    $infant['sex'] = 'M';
                } elseif ($infant['sex'] === 'Female') {
                    $infant['sex'] = 'F';
                }

                $statusText = [
                    '0' => 'Not Vaccinated',
                    '1' => 'Partially Vaccinated',
                    '2' => 'Fully Vaccinated',
                ];
                $infant['status'] = $statusText[$infant['status']] ?? '';

                $infants[] = $infant;
            }
        }

        if (isset($responseBarangays['data'])) {
            // Assuming the API response for barangays has 'name' as the display name
            // and 'id' as the value for the dropdown options
            $barangays = $responseBarangays['data'];
        }

        return view('admin.infants.index', compact('infants', 'barangays', 'uniqueBirthYears'));
    }

    public function getFilteredInfants($barangay_id, $year = null)
    {
        try {
            $endpoint = "/getFilteredInfants/{$barangay_id}/{$year}";

            $filteredInfants = $this->apiService->get($endpoint, session('token'));
            $infantsData = isset($filteredInfants['data']) ? (array) $filteredInfants['data'] : [];

            if (!empty($infantsData)) {
                // Format dates, abbreviate sex, and map status values
                $formattedInfants = array_map(function ($infant) {
                    // Format date to "Month day, year"
                    $birthDate = date('F d, Y', strtotime($infant['birth_date']));
                    $createdDate = date('F d, Y', strtotime($infant['created_at']));

                    // Abbreviate sex
                    $infant['sex'] = ($infant['sex'] === 'Male') ? 'M' : 'F';

                    // Map status values
                    $statusText = [
                        '0' => 'Not Vaccinated',
                        '1' => 'Partially Vaccinated',
                        '2' => 'Fully Vaccinated',
                    ];
                    $infant['status'] = $statusText[$infant['status']] ?? '';

                    // Assign the formatted values
                    $infant['birth_date'] = $birthDate;
                    $infant['created_at'] = $createdDate;

                    return $infant;
                }, $infantsData);

                return response()->json(['data' => $formattedInfants], 200);
            } else {
                return response()->json(['error' => 'No valid data received'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }

    public function add()
    {
        $response = $this->apiService->get('/barangays', session('token'));

        if (isset($response['data'])) {
            $barangays = $response['data'];
        } else {
            $barangays = [];
        }
        
        return view('admin.infants.add', compact('barangays'));
    }


    public function store(Request $request)
    {
        try {
            // Validate the incoming request data
            $request->validate([
                'name' => 'required',
                'sex' => 'required',
                'birth_date' => 'required',
                'family_serial_number' => 'nullable',
                'barangay_id' => 'required',
                'weight' => 'nullable',
                'length' => 'nullable',
                'father_name' => 'nullable',
                'mother_name' => 'nullable',
                'contact_number' => 'nullable',
                'complete_address' => 'nullable',
            ]);

            // Prepare the data to be sent to the API
            $data = $request->all();

            // Format the birth_date field as "Y-m-d" (e.g., "2023-09-01")
            $data['birth_date'] = date('Y-m-d', strtotime($data['birth_date']));

            // Make a POST request to create the infant record
            $response = $this->apiService->post('/infants', $data, session('token'));

            // Check if the request was successful
            if (isset($response['data'])) {
                return redirect()->route('admin.infants.index')->with('success', 'You have added an infant successfully!');;
            } else {
                return redirect()->back()->with('error', 'Failed to create infant record. Please try again.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the infant record. Please try again.');
        }
    }

    public function delete($id)
    {
        try {
            // Make an API request to delete the infant record with the given ID
            $response = $this->apiService->delete("/infants/{$id}", session('token'));

            if (isset($response['data'])) {
                return response()->json(['success' => true], 200);
                return redirect()->route('admin.infants.index')->with('success', 'Vaccine deleted successfully.');
            } else {
                return response()->json(['success' => false, 'message' => 'Failed to delete immunization record.'], 500);
                return redirect()->route('admin.infants.index')->with('error', 'An error occurred while deleting the vaccine.');
            }
        } catch (\Exception $e) {
            // Handle exceptions, you can return an error response here as well
            return response()->json(['success' => false, 'message' => 'An error occurred while deleting the infant record.'], 500);
        }
    }

    public function edit($id)
    {
    
        $userResponse = $this->apiService->get("/infants/{$id}", session('token'));
        $barangayResponse = $this->apiService->get('/barangays', session('token'));
    
        if (isset($userResponse['data'])) {
            $infant = $userResponse['data'];
        } else {
            return redirect()->route('admin.infant.index')->with('error', 'Infant not found');
        }
    
        $barangays = isset($barangayResponse['data']) ? $barangayResponse['data'] : [];
    
        return view('admin.infants.edit', compact('infant', 'barangays'));
    }
    

    public function update(Request $request, $id)
    {
        
        // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required',
            'barangay_id' => 'required',
            'sex' => 'required',
            'birth_date' => 'required',
            'family_serial_number' => 'nullable',
            'weight' => 'nullable',
            'length' => 'nullable',
            'father_name' => 'nullable',
            'mother_name' => 'nullable',
            'contact_number' => 'nullable',
            'complete_address' => 'nullable',
        ]);

        // Use the ApiService to update the infant data
        $response = $this->apiService->put("/infants/{$id}", $validatedData, session('token'));

        if (isset($response['data'])) {
            return redirect()->route('admin.infants.index')->with('success', 'Infant record updated successfully');
        } else {
            return redirect()->route('admin.infant.edit')->with('error', 'Failed to update infant record');
        }
    }

    public function updateStatus(Request $request, $id)
    {
        // Validate the incoming data
        $data = [
            'status' => $request->input('status')
        ];

        // Use the ApiService to update the infant data
        $response = $this->apiService->put("/infants/{$id}", $data, session('token'));

        if (isset($response['data'])) {
            return redirect()->route('admin.infants.index')->with('success', 'Infant record updated successfully');
        } else {
            // Log the error response for debugging
            \Log::error('API Update Error: ' . json_encode($response));
            return redirect()->route('admin.infant.edit')->with('error', 'Failed to update infant record');
        }
    }

    public function view($id)
    {
        try {
            // Fetch the infant data for the provided ID
            $responseInfant = $this->apiService->get("/infants/{$id}", session('token'));

            // Fetch the infant's immunization records
            $responseImmunizations = $this->apiService->get("/infants/{$id}/immunization-history", session('token'));

            $infant = [];
            $immunizations = [];
            $barangays = []; // Define the $barangays variable

            // Fetch the list of barangays (assuming you need it for the view)
            $responseBarangays = $this->apiService->get('/barangays', session('token'));

            if (isset($responseInfant['data'])) {
                $infant = $responseInfant['data'];

                // Format the birth_date field as "Month day, year" (e.g., "September 5, 2023")
                $birthDate = date('F j, Y', strtotime($infant['birth_date']));
                $infant['birth_date'] = $birthDate;
            }

            if (isset($responseImmunizations['data'])) {
                $immunizations = $responseImmunizations['data'];
            }

            if (isset($responseBarangays['data'])) {
                $barangays = $responseBarangays['data']; // Assign the list of barangays
            }

            // Pass the infant, immunization, and barangays data to the Blade view
            return view('admin.infants.view', compact('infant', 'immunizations', 'barangays'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while fetching data.');
        }
    }

    public function exportToExcel($year)
    {
        $response = $this->apiService->get("/infants-spreadsheet/{$year}", session('token')); // Assuming 'token' is stored in the session

        if (isset($response['data'])) {
            $infants = $response['data'];

            return response()->json($infants);
        } else {
            return response()->json(['message' => 'No data available for the selected year'], 404);
        }
    }

}
