<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StateRequest;
use App\Models\State;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $states = State::query()->with('country')
        // filter
        ->paginate(10);

        return Inertia::render('Admin/States/Index', compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $state = new State();
        return Inertia::render('Admin/States/Form', compact('state'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StateRequest $request)
    {
        $data = $request->validated();
        $state = State::query()->create($data);

        activity()
        ->causedBy(auth()->user())
        ->performedOn($state)
        ->log('State created');

        return redirect(route('states.index'))->with('success', 'State created');
    }

    /**
     * Display the specified resource.
     */
    public function show(State $state)
    {
        return Inertia::render('Admin/States/Form', compact('state'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(State $state)
    {
        return Inertia::render('Admin/States/Form', compact('state'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StateRequest $request, State $state)
    {
        $data = $request->validated();
        $state->update($data);

        activity()
        ->causedBy(auth()->user())
        ->performedOn($state)
        ->log('State updated');

        return redirect(route('states.index'))->with('success', 'State updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(State $state)
    {
        $state->delete();

        activity()
        ->causedBy(auth()->user())
        ->performedOn($state)
        ->log('State deleted');

        return redirect(route('states.index'))->with('success', 'State deleted');
    }
}
