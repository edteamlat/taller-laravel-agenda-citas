<?php

namespace App\Business;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Scheduler;

class ClientAvailabilityChecker
{
    protected $ignoreScheduler = false;

    protected $scheduler = null;

    protected $clientUser;

    protected $from;

    protected $to;

    public function __construct(User $clientUser, Carbon $from, Carbon $to)
    {
        $this->clientUser = $clientUser;
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
        return !Scheduler::where('client_user_id', $this->clientUser->id)
            ->when($this->ignoreScheduler, function ($query) {
                $query->where('id', '<>', $this->scheduler->id);
            })
            ->where('from', '<', $this->to)
            ->where('to', '>', $this->from)
            ->exists();
    }
}
