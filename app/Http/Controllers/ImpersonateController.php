<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ImpersonateController extends Controller
{
    public function in(User $user)
    {
        $originalId = auth()->id();
        session()->put('impersonate', $originalId);

        auth()->loginUsingId($user->id);

        return redirect(route('dashboard'));
    }

    public function out()
    {
        $originalId = session('impersonate');

        auth()->loginUsingId($originalId);

        session()->forget('impersonate');

        return redirect(route('users.index'));
    }
}
