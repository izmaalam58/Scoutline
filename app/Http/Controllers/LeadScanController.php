<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LeadScanController extends Controller
{
    public function scan(Request $request)
{
    $request->validate([
        'category' => 'required|string',
        'location' => 'required|string',
    ]);

    $pythonUrl = env('PYTHON_SERVICE_URL', 'http://127.0.0.1:8001');

    $response = Http::post("{$pythonUrl}/api/scan", [
        'category' => $request->category,
        'location' => $request->location,
        'api_key' => env('GEOAPIFY_API_KEY', 'b9cad8c8ee4c4355b24076b99b336800'), 
    ]);

    if ($response->successful()) {
        $responseData = $response->json();
        
        // Pass BOTH the message and the actual data results back!
        return back()->with([
            'success' => $responseData['message'] ?? 'Scan complete!',
            'results' => $responseData['results'] ?? []
        ]);
    }

    return back()->with('error', 'Could not connect to Python service.');
}
}