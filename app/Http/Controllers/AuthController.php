<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;

class AuthController extends Controller
{
    public function showLoginForm(Request $request)
    {
        // Check if the user is already logged in with a specific user_type
        $userType = $request->session()->get('user_type');
        if ($userType === 0) {
            return redirect()->route('admin.dashboard');
        } elseif ($userType === 1) {
            return redirect()->route('user.dashboard');
        }
        
        $errorMessage = $request->session()->get('error');
        return view('login', compact('errorMessage'));
    }

    public function login(Request $request, ApiService $apiService)
    {
        // Validate user input

        // Make API request for authentication
        $response = $apiService->post('/login', [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ]);

        // Check if 'user_type' key exists in the response
        if (isset($response['user_type'])) {
            $userType = $response['user_type'];
            $name = $response['name'];
            $username = $response['username'];
            $email = $response['email'];
            $token = $response['token'];
            $barangay_id = $response['barangay_id'];
            $barangay_name = $response['barangay_name'];

            // Set session values
            $request->session()->put('user_type', $userType);
            $request->session()->put('name', $name);
            $request->session()->put('username', $username);
            $request->session()->put('email', $email);
            $request->session()->put('token', $token); // Store the token in the session
            $request->session()->put('barangay_id', $barangay_id);
            $request->session()->put('barangay_name', $barangay_name);

            if ($userType === 0) {
                return redirect()->route('admin.dashboard');
            } elseif ($userType === 1) {
                return redirect()->route('user.dashboard');
            }
        } else {
            
            // Redirect back in case of login failure
            return redirect()->route('login')->with('error', "Wrong username or password!");
        }
    }

    public function logout(Request $request, ApiService $apiService)
    {
        // Make API request to logout
        $response = $apiService->post('/logout', [],
        session('token') // Assuming 'token' is stored in the session
        );

        if (isset($response['message']) && $response['message'] === 'Logged out') {
            // Clear session values
            $request->session()->forget('user_type');
            $request->session()->forget('name');
            $request->session()->forget('username');
            $request->session()->forget('token');

            return redirect()->route('login')->with('success', 'Logged out successfully.');
        } else {
            // Handle logout error
            return redirect()->route('admin.dashboard')->with('error', 'Error occurred while logging out.');
        }
    }

    
}


