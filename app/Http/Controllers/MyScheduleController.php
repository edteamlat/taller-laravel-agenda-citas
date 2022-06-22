<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Scheduler;
use Illuminate\Http\Request;

class MyScheduleController extends Controller
{
    public function index()
    {
        $date = Carbon::parse(request()->input('date'));

        $dayScheduler = Scheduler::where('client_user_id', auth()->id())
            ->whereDate('from', $date->format('Y-m-d'))
            ->get();

        return view('my-schedule.index')
            ->with([
                'date' => $date,
                'dayScheduler' => $dayScheduler,
            ]);
    }
}
