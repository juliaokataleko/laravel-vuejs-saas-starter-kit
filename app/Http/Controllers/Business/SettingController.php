<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\Business\BusinessRequest;
use App\Models\Business;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $business = new Business();
        $countries = Country::select('id', 'name')->orderBy('name', 'asc')->get();
        return Inertia::render('Business/Businesses/Form', compact('business', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BusinessRequest $request)
    {
        $data = $request->validated();
        $business = Business::query()->create($data);
        $user = User::findOrFail(auth()->id());
        $user->business_id = $business->id;
        $user->save();

        activity()
        ->causedBy(auth()->user())
        ->performedOn($business)
        ->log('Created his business');

        return redirect(route('business.dashboard'))->with('success', 'Your company was created');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $business = Business::findOrFail($id);
        $countries = Country::select('id', 'name')->orderBy('name', 'asc')->get();
        return Inertia::render('Business/Businesses/Form', compact('business', 'countries'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $business = Business::findOrFail($id);
        $countries = Country::select('id', 'name')->orderBy('name', 'asc')->get();
        return Inertia::render('Business/Businesses/Form', compact('business', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BusinessRequest $request, int $id)
    {
        $business = Business::findOrFail($id);
        $data = $request->validated();
        $business->update($data);

        activity()
        ->causedBy(auth()->user())
        ->performedOn($business)
        ->log('Updated his business');

        return redirect(route('business.dashboard'))->with('success', 'Your business was updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $business = Business::findOrFail($id);
        //
    }
}
