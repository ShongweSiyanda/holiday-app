<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Repositories\HolidayRepository;

class HolidayController extends Controller
{

    private HolidayRepository $holidayRepository;

    public function __construct(HolidayRepository $holidayRepository)
    {
        $this->holidayRepository = $holidayRepository;
    }

    public function getCountries(): JsonResponse
    {
        $countries = $this->holidayRepository->getCountries();
        return response()->json($countries);
    }

    public function getHolidaysForYear(Request $request): JsonResponse
    {
        $country = $request->input('country');
        $year = $request->input('year');

        $holidays = $this->holidayRepository->getHolidaysForYear($country, $year);
        return response()->json($holidays);
    }
}
