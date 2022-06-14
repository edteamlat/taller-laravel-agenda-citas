<?php

namespace Database\Seeders;

use App\Models\OpeningHour;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OpeningHoursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OpeningHour::create([
            'day' => 1,
            'open' => '08:00',
            'close' => '17:00',
        ]);
        OpeningHour::create([
            'day' => 2,
            'open' => '08:00',
            'close' => '17:00',
        ]);
        OpeningHour::create([
            'day' => 3,
            'open' => '08:00',
            'close' => '17:00',
        ]);
        OpeningHour::create([
            'day' => 4,
            'open' => '08:00',
            'close' => '17:00',
        ]);
        OpeningHour::create([
            'day' => 5,
            'open' => '08:00',
            'close' => '17:00',
        ]);
        OpeningHour::create([
            'day' => 6,
            'open' => '08:00',
            'close' => '13:00',
        ]);
    }
}
