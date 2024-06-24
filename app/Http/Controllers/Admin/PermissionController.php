<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PermissionRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::paginate(10);

        activity()
        ->causedBy(auth()->user())
        // ->performedOn($permission)
        ->log('Listed permissions');

        return Inertia::render('Admin/Permissions/Index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permission = new Permission();
        return Inertia::render('Admin/Permissions/Form', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionRequest $request)
    {
        $data = $request->validated();
        $permission = Permission::query()->create($data);

        activity()
        ->causedBy(auth()->user())
        ->performedOn($permission)
        ->log('Created a permission');

        return redirect(route('permissions.index'))->with('success', 'Permission created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $permission = Permission::findOrFail($id);
        return Inertia::render('Admin/Permissions/Form', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permission = Permission::findOrFail($id);
        return Inertia::render('Admin/Permissions/Form', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionRequest $request, string $id)
    {
        $permission = Permission::findOrFail($id);
        $data = $request->validated();
        $permission->update($data);

        activity()
        ->causedBy(auth()->user())
        ->performedOn($permission)
        ->log('Updated a permission');

        return redirect(route('permissions.index'))->with('success', 'Permission updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::findOrFail($id);

        activity()
        ->causedBy(auth()->user())
        ->performedOn($permission)
        ->log('Deleted a permission');

        $permission->delete();

        return redirect(route('permissions.index'))->with('success', 'Permission deleted');
    }
}
