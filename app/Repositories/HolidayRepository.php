<?php

namespace App\Repositories;

use App\Repositories\Interfaces\HolidayRepositoryInterface;
use Illuminate\Support\Facades\Http;

class HolidayRepository implements HolidayRepositoryInterface
{

    private mixed $base_url;

    public function __construct()
    {
        $this->base_url = env('API_ENDPOINT_BASE');
    }

    public function getCountries(): array
    {
        $response = Http::get("$this->base_url/getSupportedCountries");
        $status = $response->status();

        if ($status !== 200):
            return ['error' => 'bad request'];
        endif;

        return $response->json();

    }

    public function getHolidaysForYear(string $country, string $year): array
    {
        $response = Http::get("$this->base_url/getHolidaysForYear?year=$year&country=$country&holidayType=all");
        $status_code = $response->status();

        if ($status_code !== 200) {
            return ['error' => 'bad request'];
        }
        return $response->json();
    }

}
