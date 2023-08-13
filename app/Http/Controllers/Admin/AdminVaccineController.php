<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ApiService;

class AdminVaccineController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index()
    {
        $response = $this->apiService->get('/vaccines', session('token'));

        if (isset($response['data'])) {
            $vaccines = $response['data'];
        } else {
            $vaccines = [];
        }

        return view('admin.vaccines.index', compact('vaccines'));
    }
    public function updateStatus($id, Request $request)
    {
        $data = [
            'status' => $request->input('status')
        ];

        $response = $this->apiService->put("/vaccines/{$id}/update-status", $data, session('token'));

        if (isset($response['data'])) {
            // Status updated successfully, you might want to redirect or return a response
        } else {
            // Handle error, show an error message, etc.
        }
    }

    public function add()
    {
        return view('admin.vaccines.add');
    }

}
