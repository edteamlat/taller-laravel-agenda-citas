<?php

namespace App\Business;

use App\Models\OpeningHour;
use Carbon\Carbon;

class OpeningHourChecker
{
    protected $from;

    protected $to;

    public function __construct(Carbon $from, Carbon $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function check()
    {
        return OpeningHour::where('day', $this->from->dayOfWeek)
            ->where('open', '<=', $this->from->format('H:i'))
            ->where('close', '>=', $this->to->format('H:i'))
            ->exists();
    }
}
