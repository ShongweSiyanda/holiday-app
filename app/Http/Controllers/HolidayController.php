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

        $countries = $response->json();

        return response()->json($countries);
    }


    public function getHolidaysForYear(Request $request):JsonResponse
    {

        $country = $request->input('country');
        $year = $request->input('year');

        $response = Http::get("https://kayaposoft.com/enrico/json/v3.0/getHolidaysForYear?year=$year&country=$country&holidayType=all");
        $status_code = $response->status();

        if($status_code !== 200){
            return response()->json(['error'=>'bad request'],400);
        }

        $holidays = $response->json();

        return response()->json($holidays);
    }


}
