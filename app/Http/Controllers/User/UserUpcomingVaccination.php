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
            $upcomingVaccination = $response['data'];
    
            $infantData = [];
            $infantContactNumbers = [];
    
            foreach ($upcomingVaccination as $vaccineEntry) {
                $infant_tracking_number = $vaccineEntry['infant_tracking_number'];
    
                if (isset($infantData[$infant_tracking_number])) {
                    $infantData[$infant_tracking_number]['vaccine_entries'][] = [
                        'vaccine_name' => $vaccineEntry['vaccine_name'],
                        'dose_number' => $vaccineEntry['dose_number'],
                    ];
                } else {
                    $infantData[$infant_tracking_number] = [
                        'vaccination_date' => $vaccineEntry['vaccination_date'],
                        'infant_name' => $vaccineEntry['infant_name'],
                        'infant_contact_number' => $vaccineEntry['infant_contact_number'],
                        'vaccine_entries' => [
                            [
                                'vaccine_name' => $vaccineEntry['vaccine_name'],
                                'dose_number' => $vaccineEntry['dose_number'],
                            ],
                        ],
                    ];
                }
    
                $infantContactNumbers[$infant_tracking_number] = $vaccineEntry['infant_contact_number'];
            }
    
            foreach ($infantData as $infant_tracking_number => $infantEntry) {
                $vaccination_date = $infantEntry['vaccination_date'];
                $infant_name = $infantEntry['infant_name'];
                $infant_contact_number = $infantEntry['infant_contact_number'];
    
                $vaccineMessages = [];
    
                foreach ($infantEntry['vaccine_entries'] as $vaccine) {
                    $vaccine_name = $vaccine['vaccine_name'];
                    $dose_number = $vaccine['dose_number'];
    
                    $vaccineMessages[] = "$vaccine_name Dose #$dose_number";
                }
    
                $vaccine_names = implode(' and ', $vaccineMessages);
    

                $message = "Please be reminded that $infant_name's $vaccine_names vaccination is scheduled for $vaccination_date. Please visit your nearest health center.\n\nNote: You can view the details of the infant's vaccine using this Patient Number: $infant_tracking_number. Thank you!";
    
                //UNCOMMENT KAPAG GAGAMITIN SMS
                // $ch = curl_init();
                // $parameters = [
                //     'apikey' => '0db11047c1b3d3fee5f69e788e27d8af',
                //     'number' => $infant_contact_number,
                //     'message' => $message,
                //     'sendername' => 'SEMAPHORE',
                // ];
    
                // curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/priority');
                // curl_setopt($ch, CURLOPT_POST, 1);
                // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
                // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
                // $output = curl_exec($ch);
                // curl_close($ch);
            }
        } else {
            $upcomingVaccination = [];
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
