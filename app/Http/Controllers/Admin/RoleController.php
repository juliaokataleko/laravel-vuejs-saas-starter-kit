<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('permissions')->paginate(10);

        activity()
        ->causedBy(auth()->user())
        // ->performedOn($someContentModel)
        ->log('accessed roles page');

        return Inertia::render('Admin/Roles/Index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::orderBy("id")->get();
        $role = new Role();
        return Inertia::render('Admin/Roles/Form', compact('role', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $data = $request->validated();

        $permisisons = [];

        try {
            $permisisons = request("permissions");
            unset($data["permissions"]);
        } catch (\Throwable $th) {
            //throw $th;
        }
        
        $role = Role::query()->create($data);
        
        $permissionsArray = [];
        foreach ($permisisons as $key => $perItem) {
            $permissionsArray[] = $perItem['id'];
        }

        $role->syncPermissions($permissionsArray);

        activity()
        ->causedBy(auth()->user())
        ->performedOn($role)
        ->log('Created a role');

        return redirect(route('roles.index'))->with('success', 'Role created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $permissions = Permission::orderBy("id")->get();
        $role = Role::findOrFail($id);

        $employee_permissions = [];
        foreach ($role->permissions as $key => $permission) { $employee_permissions[] = $permission->id; }
        $role->permissions = $employee_permissions;

        return Inertia::render('Admin/Roles/Form', compact('role', 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permissions = Permission::orderBy("id")->get();
        $role = Role::findOrFail($id);

        $employee_permissions = [];
        foreach ($role->permissions as $key => $permission) { $employee_permissions[] = $permission->id; }
        $role->permissions = $employee_permissions;

        return Inertia::render('Admin/Roles/Form', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, string $id)
    {
        $role = Role::findOrFail($id);
        $data = $request->validated();

        try {
            $permisisons = request("permissions");
            unset($data["permissions"]);
        } catch (\Throwable $th) {
            //throw $th;
        }
        
        $role->update($data);
        
        $permissionsArray = [];
        foreach ($permisisons as $key => $perItem) {
            $permissionsArray[] = $perItem['id'];
        }

        $role->syncPermissions($permissionsArray);

        activity()
        ->causedBy(auth()->user())
        ->performedOn($role)
        ->log('Updated a role');

        return redirect(route('roles.index'))->with('success', 'Role updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);

        activity()
        ->causedBy(auth()->user())
        ->performedOn($role)
        ->log('Deleted a role');

        $role->delete();

        return redirect(route('roles.index'))->with('success', 'Role deleted');
    }
}
