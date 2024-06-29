<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FeatureRequest;
use App\Models\SaasFeature;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $features = SaasFeature::query()
        // query
        ->paginate(10);

        return Inertia::render("Admin/Features/Index", compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $feature = new SaasFeature();
        return Inertia::render("Admin/Features/Form", compact('feature'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FeatureRequest $request)
    {
        $data = $request->validated();
        $feature = SaasFeature::query()->create($data);

        activity()
        ->causedBy(auth()->user())
        ->performedOn($feature)
        ->log('Created a feature');

        return redirect(route('features.index'))->with('success', 'Feature created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $feature = SaasFeature::findOrFail($id);
        return Inertia::render("Admin/Features/Form", compact('feature'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $feature = SaasFeature::findOrFail($id);
        return Inertia::render("Admin/Features/Form", compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FeatureRequest $request, string $id)
    {
        $feature = SaasFeature::findOrFail($id);
        $data = $request->validated();
        $feature->update($data);

        activity()
        ->causedBy(auth()->user())
        ->performedOn($feature)
        ->log('Updated a feature');

        return redirect(route('features.index'))->with('success', 'Feature Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $feature = SaasFeature::findOrFail($id);

        activity()
        ->causedBy(auth()->user())
        ->performedOn($feature)
        ->log('Deleted a feature');

        $feature->delete();        

        return redirect(route('features.index'))->with('success', 'Feature Deleted');
    }
}
