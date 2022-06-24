<?php

namespace App\Business;

use App\Models\User;
use App\Models\Service;

class StaffServiceChecker
{
    protected $staffUser;

    protected $service;

    public function __construct(User $staffUser, Service $service)
    {
        $this->staffUser = $staffUser;
        $this->service = $service;
    }

    public function check()
    {
        return $this->staffUser
            ->services()
            ->where('id', $this->service->id)
            ->exists();
    }
}
