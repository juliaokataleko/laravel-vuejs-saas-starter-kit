<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FaqRequest;
use App\Models\SaasFaq;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = SaasFaq::query()
        // query
        ->paginate(10);

        return Inertia::render("Admin/Faqs/Index", compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faq = new SaasFaq();
        return Inertia::render("Admin/Faqs/Form", compact('faq'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FaqRequest $request)
    {
        $data = $request->validated();
        $faq = SaasFaq::query()->create($data);

        activity()
        ->causedBy(auth()->user())
        ->performedOn($faq)
        ->log('Created a faq');

        return redirect(route('faqs.index'))->with('success', 'Faq created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $faq = SaasFaq::findOrFail($id);
        return Inertia::render("Admin/Faqs/Form", compact('faq'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $faq = SaasFaq::findOrFail($id);
        return Inertia::render("Admin/Faqs/Form", compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FaqRequest $request, string $id)
    {
        $faq = SaasFaq::findOrFail($id);
        $data = $request->validated();
        $faq->update($data);

        activity()
        ->causedBy(auth()->user())
        ->performedOn($faq)
        ->log('Updated a faq');

        return redirect(route('faqs.index'))->with('success', 'Faq Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $faq = SaasFaq::findOrFail($id);
        $faq->delete();

        activity()
        ->causedBy(auth()->user())
        ->performedOn($faq)
        ->log('Deleted a faq');

        return redirect(route('faqs.index'))->with('success', 'Faq Deleted');
    }
}
