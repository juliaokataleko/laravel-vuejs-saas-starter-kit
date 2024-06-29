<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TaxRequest;
use App\Models\Tax;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $taxes = Tax::paginate(10);

        activity()
        ->causedBy(auth()->user())
        ->log('Listed taxes');

        return Inertia::render('Admin/Taxes/Index', compact('taxes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tax = new Tax();
        return Inertia::render('Admin/Taxes/Form', compact('tax'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaxRequest $request)
    {
        $data = $request->validated();
        $tax = Tax::query()->create($data);

        activity()
        ->causedBy(auth()->user())
        ->performedOn($tax)
        ->log('Created a tax');

        return redirect(route('taxes.index'))->with('success', 'Tax created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tax $tax)
    {
        return Inertia::render('Admin/Taxes/Form', compact('tax'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tax $tax)
    {
        return Inertia::render('Admin/Taxes/Form', compact('tax'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaxRequest $request, Tax $tax)
    {
        $data = $request->validated();
        $tax->update($data);

        activity()
        ->causedBy(auth()->user())
        ->performedOn($tax)
        ->log('Updated a tax');

        return redirect(route('taxes.index'))->with('success', 'Tax Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tax $tax)
    {
        $tax->delete();
        return redirect(route('taxes.index'))->with('success', 'Tax Updated');
    }
}
