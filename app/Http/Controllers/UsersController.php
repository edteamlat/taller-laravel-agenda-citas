<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\UsersRequest;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::with('services', 'roles')
            ->paginate(10);

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
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt(Str::random(20)),
        ]);

        $user->roles()->sync($request->input('roles_ids'));

        $user->sendWelcomeEmail();

        return redirect(route('users.index'));
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
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        $user->roles()->sync($request->input('roles_ids'));

        return redirect(route('users.index'));
    }
}
