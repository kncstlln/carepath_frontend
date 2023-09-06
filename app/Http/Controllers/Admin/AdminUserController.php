<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ApiService;

class AdminUserController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index()
    {
        $response = $this->apiService->get('/users', session('token'));

        if (isset($response['data'])) {
            $users = $response['data'];
        } else {
            $users = [];
        }

        return view('admin.users.index', compact('users'));
    }

    public function add()
    {
        $response = $this->apiService->get('/barangays', session('token'));

        if (isset($response['data'])) {
            $barangays = $response['data'];
        } else {
            $barangays = [];
        }
        
        return view('admin.users.add', compact('barangays'));
    }

    public function register(Request $request)
    {

        // Prepare the user data to be sent in the POST request
        $userData = [
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'), // Add the email field
            'password' => $request->input('password'),
            'password_confirmation' => $request->input('password_confirmation'),
            'barangay_id' => $request->input('barangay_id'),
            'user_type' => $request->input('user_type'),
        ];

        $response = $this->apiService->post('/register', $userData, session('token'));

        if (isset($response['data'])) {
            // Redirect to the user list page or any other appropriate page
            return redirect()->route('admin.users.index')->with('success', 'User registered successfully');
        } else {
            // Handle the error, you can redirect back to the registration page with an error message
            return redirect()->route('admin.users.add')->with('error', 'User registration failed. Please try again.');
        }
    }

    public function edit($id)
    {
        // Fetch the user data for editing using the ApiService
        $userResponse = $this->apiService->get("/users/{$id}", session('token'));
        $barangayResponse = $this->apiService->get('/barangays', session('token'));

        if (isset($userResponse['data'])) {
            $user = $userResponse['data'];
        } else {
            //return redirect()->route('admin.users.index')->with('error', 'User not found');
        }

        // Extract barangay data from the response
        $barangays = isset($barangayResponse['data']) ? $barangayResponse['data'] : [];

        return view('admin.users.edit', compact('user', 'barangays'));
    }


}
