<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ApiService;

class UserAccountController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index()
    {
        return view('user.account');
    }

    public function changePassword()
    {
        return view('user.password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $userData = $request->only(['password', 'password_confirmation']);

        $response = $this->apiService->put("/users", $userData, session('token'));

        if (isset($response['data'])) {
            return redirect()->route('user.account')->with('success', 'Password updated successfully!');
        } else {
            return redirect()->route('user.change-password')->with('error', 'Failed to update password.');
        }
    }
}
