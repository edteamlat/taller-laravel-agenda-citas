<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersRequest;
use App\Models\User;
use App\Models\Service;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::with('services', 'roles')
            ->role('staff')
            ->get();

        return view('users.index')->with([
            'users' => $users,
        ]);
    }

    public function create()
    {
        $roles = Role::all();

        return view('users.create')->with([
            'roles' => $roles,
        ]);
    }

    public function store(UsersRequest $request)
    {

    }

    public function edit(User $user)
    {
        $user->load('roles');

        $roles = Role::get();

        return view('users.edit')->with([
            'roles' => $roles,
            'user' => $user,
        ]);
    }

    public function update(UsersRequest $request, User $user)
    {

    }
}
