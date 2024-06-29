<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\Business\BusinessRequest;
use App\Http\Requests\Business\SubscriptionRequest;
use App\Models\Payment;
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
        ->whereBusinessId(auth()->user()->business_id)
        ->with(['business', 'plan'])
        ->paginate(10);

        return Inertia::render('Business/Subscriptions/Index', compact('subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subscription = new Subscription();
        $current_subscription = Subscription::whereBusinessId(auth()->user()->business_id)->where('end_date', '>=', now())
        ->whereStatus('active')
        ->whereIsTrial(0)
        ->orderBy('id', 'desc')->first();

        if ($current_subscription) {
            $subscription->start_date = date("Y-m-d", strtotime($current_subscription->end_date . ' +1 day'));
        } else {
            $subscription->start_date = date("Y-m-d", strtotime(now()));
        }

        $subscription->end_date = date("Y-m-d", strtotime($subscription->start_date . ' +1 year'));
        $subscription->billing_cycle = 'yearly';

        return Inertia::render('Business/Subscriptions/Form', compact('subscription'));
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

        return redirect(route('business.subscriptions.index'))->with('success', 'Subscription created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subscription = Subscription::whereBusinessId(auth()->user()->business_id)->whereId($id)->first();
        return Inertia::render('Business/Subscriptions/Form', compact('subscription'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subscription = Subscription::whereBusinessId(auth()->user()->business_id)->whereId($id)->first();

        $payment = Payment::whereSubscriptionId($subscription->id)->first() ?? new Payment;
        $payment->subscription_id = $subscription->id;
        $payment->amount = $subscription->amount;

        return Inertia::render('Business/Subscriptions/Form', compact('subscription', 'payment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubscriptionRequest $request, string $id)
    {
        $subscription = Subscription::whereBusinessId(auth()->user()->business_id)->whereId($id)->first();
        $subscription->update($request->validated());

        activity()
        ->causedBy(auth()->user())
        ->performedOn($subscription)
        ->log('Subscription updated');

        return redirect(route('business.subscriptions.index'))->with('success', 'Subscription updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subscription = Subscription::whereBusinessId(auth()->user()->business_id)->whereId($id)->first();
    }
}
