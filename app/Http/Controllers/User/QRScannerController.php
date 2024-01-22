<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class QRScannerController extends Controller
{

    public function getCamera(){
        return view('user.qr');
    }
    
    // public function handleQrCodeData(Request $request)
    // {
    //     $qrData = $request->input('qr_data');

    // // Split the QR data by '&' to get individual key-value pairs
    // $dataPairs = explode('&', $qrData);

    // $result = [];
    // foreach ($dataPairs as $pair) {
    //     // Further split the pair by '=' to get the key and value
    //     list($key, $value) = explode('=', $pair);

    //     // Assign values to corresponding variables based on the key
    //     switch ($key) {
    //         case '1':
    //             $result['name'] = ($value !== '') ? urldecode($value) : null;
    //             break;
    //         case '2':
    //             $result['birth_date'] = ($value !== '') ? $value : null;
    //             break;
    //         case '3':
    //             $result['gender'] = ($value !== '') ? $value : null;
    //             break;
    //         case '4':
    //             $result['weight'] = ($value !== '') ? $value : null;
    //             break;
    //         case '5':
    //             $result['length'] = ($value !== '') ? $value : null;
    //             break;
    //         case '6':
    //             $result['father_name'] = ($value !== '') ? urldecode($value) : null;
    //             break;
    //         case '7':
    //             $result['mother_name'] = ($value !== '') ? urldecode($value) : null;
    //             break;
    //         case '8':
    //             $result['contact_number'] = ($value !== '') ? $value : null;
    //             break;
    //         // Add more cases if there are more possible keys
    //     }
    // }

    // // Redirect to the specified route with the extracted variables as parameters in the URL
    // return redirect()->route('user.infants.add', $result);
    // }
}
