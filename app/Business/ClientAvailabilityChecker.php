<?php

namespace App\Business;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Scheduler;

class ClientAvailabilityChecker
{
    protected $clientUser;

    protected $from;

    protected $to;

    public function __construct(User $clientUser, Carbon $from, Carbon $to)
    {
        $this->clientUser = $clientUser;
        $this->from = $from;
        $this->to = $to;
    }

    public function check()
    {
        return !Scheduler::where('client_user_id', $this->clientUser->id)
            ->where('from', '<', $this->to)
            ->where('to', '>', $this->from)
            ->exists();
    }
}
