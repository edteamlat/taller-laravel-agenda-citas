<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyScheduleController extends Controller
{
    public function index()
    {
        $date = request()->input('date');
        return view('my-schedule.index')
            ->with([
                'date' => $date,
            ]);
    }
}
