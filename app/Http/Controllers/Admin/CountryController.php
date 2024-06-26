<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Country::paginate(10);
        return Inertia::render('Admin/Countries/Index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $country = new Country();
        return Inertia::render('Admin/Countries/Form', compact('country'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryRequest $request)
    {
        $data = $request->validated();
        $country = Country::query()->create($data);

        activity()
        ->causedBy(auth()->user())
        ->performedOn($country)
        ->log('Country created');

        return redirect(route('countries.index'))->with('success', 'Country created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        return Inertia::render('Admin/Countries/Form', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        return Inertia::render('Admin/Countries/Form', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountryRequest $request, Country $country)
    {
        $data = $request->validated();
        $country->update($data);

        activity()
        ->causedBy(auth()->user())
        ->performedOn($country)
        ->log('Country updated');

        return redirect(route('countries.index'))->with('success', 'Country updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        $country->delete();

        activity()
        ->causedBy(auth()->user())
        ->performedOn($country)
        ->log('Country deleted');

        return redirect(route('countries.index'))->with('success', 'Country deleted');
    }
}
