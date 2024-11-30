<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Holiday;
use Carbon\Carbon;

class HolidaySeeder extends Seeder
{
    public function run()
    {
        // Define sample holidays
        $holidays = [
            [
                'name' => 'New Year\'s Day',
                'date' => Carbon::create(date('Y'), 1, 1),
                'description' => 'Celebration of the first day of the new year.',
            ],
            [
                'name' => 'Independence Day',
                'date' => Carbon::create(date('Y'), 7, 4),
                'description' => 'Celebrates the independence of the country.',
            ],
            [
                'name' => 'Christmas Day',
                'date' => Carbon::create(date('Y'), 12, 25),
                'description' => 'Celebration of Christmas.',
            ],
            [
                'name' => 'Labor Day',
                'date' => Carbon::create(date('Y'), 5, 1),
                'description' => 'Celebration of workers and labor movement.',
            ],
            [
                'name' => 'Thanksgiving Day',
                'date' => Carbon::create(date('Y'), 11, 23),
                'description' => 'A day of giving thanks for the harvest and blessings.',
            ],
        ];

        // Seed the holidays table
        foreach ($holidays as $holiday) {
            Holiday::create($holiday);
        }
    }
}
