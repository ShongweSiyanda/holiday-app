<?php
namespace App\Repositories\Interfaces;

Interface HolidayRepositoryInterface{
    public function getCountries():array;
    public function getHolidaysForYear(string $country,string $year):array;
}


