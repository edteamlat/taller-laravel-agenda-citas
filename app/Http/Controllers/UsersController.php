<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::with('services')
            ->role('staff')
            ->get();

        return view('users.index')->with([
            'users' => $users,
        ]);
    }
}
