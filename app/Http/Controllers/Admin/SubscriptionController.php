<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubscriptionRequest;
use App\Models\Payment;
use App\Models\Subscription;
use Carbon\Carbon;
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
        ->orderBy('id', 'desc')
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
        $payment = Payment::whereSubscriptionId($subscription->id)->first() ?? new Payment;
        $payment->subscription_id = $subscription->id;
        $payment->amount = $subscription->amount;

        // start date
        $lastPayment = Payment::whereSubscriptionId($subscription->id)->orderBy('id', 'desc')->first();
        if ($lastPayment) {
            $start_date = date('Y-m-d', strtotime( $lastPayment->end_date . ' +1 day'));
            $payment->start_date = $start_date;
        } else {
            $start_date = $start_date = date('Y-m-d', strtotime($subscription->start_date . ' +1 day')); 
            $payment->start_date = $start_date;
        }

        // end date
        if ($subscription->billing_cycle == 'monthly') $payment->end_date = date('Y-m-d', strtotime($start_date . ' +1 month'));
        else if ($subscription->billing_cycle == 'quarterly') $payment->end_date = date('Y-m-d', strtotime($start_date . ' +3 months'));
        else if ($subscription->billing_cycle == 'semiannually') $payment->end_date = date('Y-m-d', strtotime($start_date . ' +6 months'));
        else if ($subscription->billing_cycle == 'yearly') $payment->end_date = date('Y-m-d', strtotime($start_date . ' +1 year'));

        return Inertia::render('Admin/Subscriptions/Form', compact('subscription', 'payment'));
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
