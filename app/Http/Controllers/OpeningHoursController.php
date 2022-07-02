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
        $closeHours = $request->input('close');
        foreach ($request->input('open') as $day => $hour) {
            OpeningHour::where('day', $day)
                ->update([
                    'open' => $hour,
                    'close' => $closeHours[$day]
                ]);
        }

        $request->session()->flash('success', 'Los horarios se actualizaron.');

        return back();
    }
}
