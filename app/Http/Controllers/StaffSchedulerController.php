<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Scheduler;
use Illuminate\Http\Request;

class StaffSchedulerController extends Controller
{
    public function index()
    {
        $date = Carbon::parse(request()->input('date'));

        $dayScheduler = Scheduler::where('staff_user_id', auth()->id())
            ->whereDate('from', $date->format('Y-m-d'))
            ->orderBy('from', 'ASC')
            ->get();

        return view('staff-scheduler.index')
            ->with([
                'date' => $date,
                'dayScheduler' => $dayScheduler,
            ]);
    }

    public function destroy(Scheduler $scheduler)
    {
        if (auth()->user()->cannot('delete', $scheduler)) {
            return back()->withErrors('No es posible cancelar esta cita');
        }

        $scheduler->delete();

        return back();
    }
}
