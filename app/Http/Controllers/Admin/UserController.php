<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\Business;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::query()
        //filters
        ->orderBy('id', 'desc')
        ->paginate(10);

        activity()
        ->causedBy(auth()->user())
        // ->performedOn($someContentModel)
        ->log('accessed users page');

        return Inertia::render('Admin/Users/Index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = new User();
        $roles = Role::orderBy('name', 'asc')->get();
        $businesses = Business::select('id', 'name')->orderBy('name', 'asc')->get();
        return Inertia::render('Admin/Users/Form', compact('user', 'roles', 'businesses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();

        $data['password'] = bcrypt(uniqid());

        $user = User::query()->create($data);

        $expiresAt = now()->addDay();
        $user->sendWelcomeNotification($expiresAt);

        if(request('role')) {
            $role = Role::findOrFail(request('role'));
            $user->assignRole($role);
        }

        activity()
        ->causedBy(auth()->user())
        ->performedOn($user)
        ->log('Created a user');

        return redirect(route('users.index'))->with('success', 'User created');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $roles = Role::orderBy('name', 'asc')->get();
        $businesses = Business::select('id', 'name')->orderBy('name', 'asc')->get();

        $user->role = null;
        if (count($user->roles) > 0) {
            $user->role = $user->roles[0]->id;
        }

        return Inertia::render('Admin/Users/Form', compact('user', 'roles', 'businesses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::orderBy('name', 'asc')->get();
        $businesses = Business::select('id', 'name')->orderBy('name', 'asc')->get();

        $user->role = null;
        if (count($user->roles) > 0) {
            $user->role = $user->roles[0]->id;
        }

        return Inertia::render('Admin/Users/Form', compact('user', 'roles', 'businesses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();
        $user->update($data);

        $user->syncRoles([]);

        if(request('role')) {
            $role = Role::findOrFail(request('role'));
            $user->assignRole($role);
        }

        activity()
        ->causedBy(auth()->user())
        ->performedOn($user)
        ->log('Updated a user');

        return redirect(route('users.index'))->with('success', 'User updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        activity()
        ->causedBy(auth()->user())
        ->performedOn($user)
        ->log('Deleted a user');

        return redirect(route('users.index'))->with('success', 'User deleted');
    }
}
