<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Js;
use function Laravel\Prompts\error;

class HolidayController extends Controller
{
    public function getCountries(): JsonResponse
    {
        $response = Http::get('https://kayaposoft.com/enrico/json/v3.0/getSupportedCountries');
        $status = $response->status();

        if ($status !== 200) {
            return response()->json(['error' => 'Failed to retrieve data'], 400);
        }

        $data = $response->json();

        return response()->json($data);
    }

}
