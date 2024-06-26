<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CityRequest;
use App\Models\City;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::query()->with(['country', 'state'])
        // filter
        ->paginate(10);

        return Inertia::render('Admin/Cities/Index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $city = new City();
        return Inertia::render('Admin/Cities/Form', compact('city'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request)
    {
        $data = $request->validated();
        $city = City::query()->create($data);

        activity()
        ->causedBy(auth()->user())
        ->performedOn($city)
        ->log('City created');

        return redirect(route('cities.index'))->with('success', 'City created');
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        return Inertia::render('Admin/Cities/Form', compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        return Inertia::render('Admin/Cities/Form', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityRequest $request, City $city)
    {
        $data = $request->validated();
        $city->update($data);

        activity()
        ->causedBy(auth()->user())
        ->performedOn($city)
        ->log('City updated');

        return redirect(route('cities.index'))->with('success', 'City updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        $city->delete();

        activity()
        ->causedBy(auth()->user())
        ->performedOn($city)
        ->log('City deleted');

        return redirect(route('cities.index'))->with('success', 'City deleted');
    }
}
