<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ApiService;
use Illuminate\Http\Request;

class AdminUpcomingVaccination extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }


    public function index(){
        $response = $this->apiService->get('/upcoming-vaccinations', session('token'));
    
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
    
        return view('admin.upcoming', compact('upcomingVaccination'));
    }
    

    public function missedVaccinations(){
        $response = $this->apiService->get('/missed-vaccinations', session('token'));

        if (isset($response['data'])) {
            $missedVaccination= $response['data'];
        } else {
            $missedVaccination= [];
        }

        return view('admin.missed', compact('missedVaccination'));
    }


    public function sendSMS(){
        $response = $this->apiService->get('/upcoming-vaccinations', "Do3Xje0oDPkHOb1cFyjglr3xJiKYjnnwIuOzB8Wo080a184a");
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
    

                $message = "Pakitandaan na ang pagbabakuna sa $vaccine_names ni $infant_name ay naka-iskedyul sa $vaccination_date. Mangyaring bisitahin ang iyong pinakamalapit na health center.\n\nTandaan: Maaaring tingnan ang mga detalye ng bakuna ng sanggol gamit ang Patient Number na ito:            $infant_tracking_number. Salamat!";
    
                //UNCOMMENT KAPAG GAGAMITIN SMS
                $ch = curl_init();
                $parameters = [
                    'apikey' => '0db11047c1b3d3fee5f69e788e27d8af',
                    'number' => $infant_contact_number,
                    'message' => $message,
                    'sendername' => 'CAREPATH',
                ];
    
                curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/priority');
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
                $output = curl_exec($ch);
                curl_close($ch);
            }
        } else {
            $upcomingVaccination = [];
        }
    
    }

    public function sendSMSButton(){
        $response = $this->apiService->get('/upcoming-vaccinations', session('token'));

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
    

                $message = "Pakitandaan na ang pagbabakuna sa $vaccine_names ni $infant_name ay naka-iskedyul sa $vaccination_date. Mangyaring bisitahin ang iyong pinakamalapit na health center.\n\nTandaan: Maaaring tingnan ang mga detalye ng bakuna ng sanggol gamit ang Patient Number na ito: $infant_tracking_number. Salamat!";
    
                $ch = curl_init();
                $parameters = [
                    'apikey' => '0db11047c1b3d3fee5f69e788e27d8af',
                    'number' => $infant_contact_number,
                    'message' => $message,
                    'sendername' => 'CAREPATH',
                ];
    
                curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/priority');
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
                $output = curl_exec($ch);
                curl_close($ch);
            }
        } else {
            $upcomingVaccination = [];
        }
        return view('admin.upcoming', compact('upcomingVaccination'))->with('success', 'SMS messages successfully sent!');
    }

}
