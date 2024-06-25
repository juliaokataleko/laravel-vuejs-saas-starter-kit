<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BusinessRequest;
use App\Models\Business;
use App\Models\Country;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $businesses = Business::query()
        // query
        ->paginate(10);

        return Inertia::render('Admin/Businesses/Index', compact('businesses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $business = new Business();
        $countries = Country::select('id', 'name')->orderBy('name', 'asc')->get();
        return Inertia::render('Admin/Businesses/Form', compact('business', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BusinessRequest $request)
    {
        $data = $request->validated();
        $data['employee_id'] = auth()->id();
        $business = Business::query()->create($data);

        activity()
        ->causedBy(auth()->user())
        ->performedOn($business)
        ->log('Created a business');

        return redirect(route('businesses.index'))->with('success', 'Business created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Business $business)
    {
        $countries = Country::select('id', 'name')->orderBy('name', 'asc')->get();
        return Inertia::render('Admin/Businesses/Form', compact('business', 'countries'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Business $business)
    {
        $countries = Country::select('id', 'name')->orderBy('name', 'asc')->get();
        return Inertia::render('Admin/Businesses/Form', compact('business', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BusinessRequest $request, Business $business)
    {
        $data = $request->validated();
        $business->update($data);

        activity()
        ->causedBy(auth()->user())
        ->performedOn($business)
        ->log('Updated a business');

        return redirect(route('businesses.index'))->with('success', 'Business updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Business $business)
    {
        // @TODO delete relative data

        $business->delete();
        return redirect(route('businesses.index'))->with('success', 'Business deleted');
    }
}
