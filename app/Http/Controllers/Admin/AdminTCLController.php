<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ApiService;

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




}
