<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminQRScannerController extends Controller
{
    public function getCamera(){
        return view('admin.qr');
    }
}
