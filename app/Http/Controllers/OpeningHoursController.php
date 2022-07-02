<?php

namespace App\Http\Controllers;

use App\Models\OpeningHour;
use Illuminate\Http\Request;
use App\Http\Requests\OpeningHourRequest;

class OpeningHoursController extends Controller
{
    public function edit()
    {
        $openingHours = OpeningHour::all();

        return view('opening-hours.edit')->with([
            'openingHours' => $openingHours,
        ]);
    }

    public function update(OpeningHourRequest $request)
    {
        // dd(request()->all());
    }
}
