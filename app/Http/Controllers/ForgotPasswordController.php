<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;

class ForgotPasswordController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index(Request $request)
    {
        $token = $request->query('token');

        if ($token) {
            return view('change-password', compact('token'))->with('token', $token);
        } else {
            return redirect()->route('forgot-password');
        }
    }

    public function forgotPassword(Request $request)
    {
        // Call your API Service to send the forgot password request
        $response = $this->apiService->post('/forgot-password', [
            'email' => $request->email,
        ]);

        // Check the response and set messages for success or error
        if (isset($response['data'])) {
            return redirect()->route('forgot-password')->with('success', 'Password reset link sent to your email!');
        } else {
            return redirect()->route('forgot-password')->with('error', 'Failed to send password reset link.');
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_reset_token' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $response = $this->apiService->post('/update-password', [
            'password_reset_token' => $request->password_reset_token,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
        ]);

        if (isset($response['message']) && $response['message'] === 'Password updated successfully') {
            return redirect()->route('login')->with('success', 'Password reset successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to reset password.');
        }
    }

}
