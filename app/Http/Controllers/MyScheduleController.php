<?php

namespace App\Http\Controllers;

use App\Business\ClientAvailabilityChecker;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Service;
use App\Models\Scheduler;
use Illuminate\Http\Request;
use App\Http\Requests\MyScheduleRequest;
use App\Business\StaffAvailabilityChecker;
use App\Business\StaffServiceChecker;
use App\Notifications\SchedulerCreated;

class MyScheduleController extends Controller
{
    public function index()
    {
        $date = Carbon::parse(request()->input('date'));

        $dayScheduler = Scheduler::where('client_user_id', auth()->id())
            ->whereDate('from', $date->format('Y-m-d'))
            ->orderBy('from', 'ASC')
            ->get();

        return view('my-schedule.index')
            ->with([
                'date' => $date,
                'dayScheduler' => $dayScheduler,
            ]);
    }

    public function create()
    {
        $services = Service::all();
        $staffUsers = User::role('staff')->get();

        return view('my-schedule.create')->with([
            'services' => $services,
            'staffUsers' => $staffUsers,
        ]);
    }

    public function store(MyScheduleRequest $request)
    {
        $service = Service::find(request('service_id'));
        $from = Carbon::parse(request('from.date') . ' ' . request('from.time'));
        $to = Carbon::parse($from)->addMinutes($service->duration);
        $staffUser = User::find($request->input('staff_user_id'));

        $request->checkReservationRules($staffUser, auth()->user(), $from, $to, $service);

        $scheduler = Scheduler::create([
            'from' => $from,
            'to' => $to,
            'status' => 'pending',
            'staff_user_id' => request('staff_user_id'),
            'client_user_id' => auth()->id(),
            'service_id' => $service->id,
        ]);

        $staffUser->notify(new SchedulerCreated($scheduler));

        return redirect(route('my-schedule', ['date' => $from->format('Y-m-d')]));
    }

    public function edit(Scheduler $scheduler)
    {
        if (auth()->user()->cannot('update', $scheduler)) {
            abort(403, 'Acción no autorizada.');
        }

        $services = Service::all();
        $staffUsers = User::role('staff')->get();

        return view('my-schedule.edit')->with([
            'scheduler' => $scheduler,
            'services' => $services,
            'staffUsers' => $staffUsers,
        ]);
    }

    public function update(Scheduler $scheduler, MyScheduleRequest $request)
    {
        if (auth()->user()->cannot('update', $scheduler)) {
            abort(403, 'Acción no autorizada.');
        }

        $service = Service::find(request('service_id'));
        $from = Carbon::parse(request('from.date') . ' ' . request('from.time'));
        $to = Carbon::parse($from)->addMinutes($service->duration);
        $staffUser = User::find($request->input('staff_user_id'));

        $request->checkRescheduleRules($scheduler, $staffUser, auth()->user(), $from, $to, $service);

        $scheduler->update([
            'from' => $from,
            'to' => $to,
            'staff_user_id' => request('staff_user_id'),
            'service_id' => $service->id,
        ]);

        return redirect(route('my-schedule', ['date' => $from->format('Y-m-d')]));
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
