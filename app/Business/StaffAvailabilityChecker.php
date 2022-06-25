<?php

namespace App\Business;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Scheduler;

class StaffAvailabilityChecker
{
    protected $ignoreScheduler = false;

    protected $scheduler = null;

    protected $staffUser;

    protected $from;

    protected $to;

    public function __construct(User $staffUser, Carbon $from, Carbon $to)
    {
        $this->staffUser = $staffUser;
        $this->from = $from;
        $this->to = $to;
    }

    public function ignore($scheduler)
    {
        $this->ignoreScheduler = true;
        $this->scheduler = $scheduler;
        return $this;
    }

    public function check()
    {
        return ! Scheduler::where('staff_user_id', $this->staffUser->id)
            ->when($this->ignoreScheduler, function ($query) {
                $query->where('id', '<>', $this->scheduler->id);
            })
            ->where('from', '<', $this->to)
            ->where('to', '>', $this->from)
            ->exists();
    }
}
