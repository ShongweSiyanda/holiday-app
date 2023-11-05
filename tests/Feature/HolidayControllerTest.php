<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HolidayControllerTest extends TestCase
{
    public function test_get_countries(): void
    {
        $response = $this->get('/api/countries');

        $response->assertStatus(200);
    }

    public function test_get_holidays_for_year()
    {
        $country = "usa";
        $year = "2022";

        $response = $this->get("/api/holidays?country=$country&year=$year");

        $response->assertStatus(200);
    }
}
