<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Repositories\HolidayRepository;

class HolidayRepositoryTest extends TestCase
{
    public function test_get_countries()
    {

        $holidayRepository = new HolidayRepository();

        $countries = $holidayRepository->getCountries();

        $this->assertIsArray($countries);
    }

    public function test_get_holidays_for_year()
    {
        $country = "ago";
        $year = "2023";

        $holidayRepository = new HolidayRepository();

        $holidays = $holidayRepository->getHolidaysForYear($country, $year);

        $this->assertIsArray($holidays);
    }
}
