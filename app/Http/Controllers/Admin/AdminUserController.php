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
            return redirect()->route('admin.users.index')->with('error', 'User not found');
        }

        // Extract barangay data from the response
        $barangays = isset($barangayResponse['data']) ? $barangayResponse['data'] : [];

        return view('admin.users.edit', compact('user', 'barangays'));
    }

    public function update(Request $request, $id)
    {
        // Prepare the user data to be sent in the PUT request
        $userData = [
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'barangay_id' => $request->input('barangay_id'),
            'user_type' => $request->input('user_type'),
        ];

        // Include password fields only if they are not empty
        if (!empty($request->input('password'))) {
            $userData['password'] = $request->input('password');
            $userData['password_confirmation'] = $request->input('password_confirmation');
        }

        $response = $this->apiService->put("/users/{$id}", $userData, session('token'));

        if (isset($response['data'])) {
            // Redirect to the user list page or any other appropriate page
            return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
        } else {
            // Handle the error, you can redirect back to the edit page with an error message
            return redirect()->route('admin.users.edit', ['id' => $id])->with('error', 'User update failed. Please try again.');
        }
    }

    public function delete($id)
    {
        // Make an API request to delete the user with the given ID
        $response = $this->apiService->delete("/users/{$id}", session('token'));

        if (isset($response['data'])) {
            // Redirect to the user list page with a success message
            return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
        } else {
            // Handle the error, you can redirect back to the user list with an error message
            return redirect()->route('admin.users.index')->with('error', 'User deletion failed. Please try again.');
        }
    }


}
