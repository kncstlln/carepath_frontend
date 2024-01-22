<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request)
    {
        // $request->session()->forget('user_type');
        // $request->session()->forget('name');
        // $request->session()->forget('username');
        // $request->session()->forget('token');
        return view('main');
    }
}
