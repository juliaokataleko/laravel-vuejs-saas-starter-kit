<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubscriptionRequest;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscriptions = Subscription::query()
        // query
        ->with(['business', 'plan'])
        ->paginate(10);

        return Inertia::render('Admin/Subscriptions/Index', compact('subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subscription = new Subscription();
        return Inertia::render('Admin/Subscriptions/Form', compact('subscription'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubscriptionRequest $request)
    {        
        $data = $request->validated();
        $subscription = Subscription::query()->create($data);

        activity()
        ->causedBy(auth()->user())
        ->performedOn($subscription)
        ->log('Subscription created');

        return redirect(route('subscriptions.index'))->with('success', 'Subscription created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        return Inertia::render('Admin/Subscriptions/Form', compact('subscription'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscription $subscription)
    {
        return Inertia::render('Admin/Subscriptions/Form', compact('subscription'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubscriptionRequest $request, Subscription $subscription)
    {
        $subscription->update($request->validated());

        activity()
        ->causedBy(auth()->user())
        ->performedOn($subscription)
        ->log('Subscription updated');

        return redirect(route('subscriptions.index'))->with('success', 'Subscription updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        $subscription->delete();

        activity()
        ->causedBy(auth()->user())
        ->performedOn($subscription)
        ->log('Subscription deleted');

        return redirect(route('subscriptions.index'))->with('success', 'Subscription deleted');
    }
}
