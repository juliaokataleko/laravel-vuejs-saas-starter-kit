<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PlanRequest;
use App\Models\Plan;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = Plan::orderBy('id', 'desc')->paginate(10);

        return Inertia::render("Admin/Plans/Index", compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $plan = new Plan();

        $plan->features = Plan::features;

        return Inertia::render("Admin/Plans/Form", compact('plan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlanRequest $request)
    {
        $data = $request->validated();
        $plan = Plan::query()->create($data);

        activity()
        ->causedBy(auth()->user())
        ->performedOn($plan)
        ->log('Created a plan');

        return redirect(route('plans.index'))->with('success', 'Plan created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        return Inertia::render("Admin/Plans/Form", compact('plan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
        return Inertia::render("Admin/Plans/Form", compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlanRequest $request, Plan $plan)
    {
        $data = $request->validated();

        $plan->update($data);

        activity()
        ->causedBy(auth()->user())
        ->performedOn($plan)
        ->log('Updated a plan');

        return redirect(route('plans.index'))->with('success', 'Plan updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        $plan->delete();

        activity()
        ->causedBy(auth()->user())
        ->performedOn($plan)
        ->log('Deleted a plan');

        return redirect(route('plans.index'))->with('success', 'Plan deleted');
    }
}
