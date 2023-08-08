<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class ApiService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = Config::get('app.api_base_url');
    }

    public function get($endpoint, $accessToken = null)
    {
        $response = Http::withHeaders([
            'Authorization' => $accessToken ? 'Bearer ' . $accessToken : null,
        ])->get($this->baseUrl . $endpoint);

        return $this->handleResponse($response);
    }

    public function post($endpoint, $data, $accessToken = null)
    {
        $response = Http::withHeaders([
            'Authorization' => $accessToken ? 'Bearer ' . $accessToken : null,
        ])->post($this->baseUrl . $endpoint, $data);

        return $this->handleResponse($response);
    }

    public function put($endpoint, $data, $accessToken = null)
    {
        $response = Http::withHeaders([
            'Authorization' => $accessToken ? 'Bearer ' . $accessToken : null,
        ])->put($this->baseUrl . $endpoint, $data);

        return $this->handleResponse($response);
    }

    public function delete($endpoint, $accessToken = null)
    {
        $response = Http::withHeaders([
            'Authorization' => $accessToken ? 'Bearer ' . $accessToken : null,
        ])->delete($this->baseUrl . $endpoint);

        return $this->handleResponse($response);
    }

    protected function handleResponse($response)
    {
        if ($response->successful()) {
            return $response->json();
        } else {
            // Handle error responses, e.g., unauthorized, validation errors, etc.
            return [
                'error' => true,
                'message' => $response->json()['message'] ?? 'An error occurred.',
            ];
        }
    }
}
