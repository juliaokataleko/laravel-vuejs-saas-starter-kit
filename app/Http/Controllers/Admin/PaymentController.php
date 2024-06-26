<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PaymentRequest;
use App\Models\Payment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::query()->with(['subscription', 'subscription.business'])
        // filters
        ->orderBy('id', 'desc')
        ->paginate(10);

        return Inertia::render('Admin/Payments/Index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentRequest $request)
    {
        $data = $request->validated();
        $payment = Payment::query()->create($data);

        // @TODO process in payment gateway like paypal, credit card

        activity()
        ->causedBy(auth()->user())
        ->performedOn($payment)
        ->log('Created a payment');

        return  redirect(route('payments.index'))->with('success', 'Payment created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        $payment->start_date = date('Y-m-d', strtotime($payment->start_date));
        $payment->end_date = date('Y-m-d', strtotime($payment->end_date));
        return Inertia::render('Admin/Payments/Form', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        $payment->start_date = date('Y-m-d', strtotime($payment->start_date));
        $payment->end_date = date('Y-m-d', strtotime($payment->end_date));
        return Inertia::render('Admin/Payments/Form', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PaymentRequest $request, Payment $payment)
    {
        $data = $request->validated();
        $payment->update($data);

        // @TODO process in payment gateway like paypal, credit card

        activity()
        ->causedBy(auth()->user())
        ->performedOn($payment)
        ->log('Updated a payment');

        return redirect(route('payments.index'))->with('success', 'Payment updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        activity()
        ->causedBy(auth()->user())
        ->performedOn($payment)
        ->log('Deleted a payment');
        // @TODO process in payment gateway like paypal, credit card
        $payment->delete();

        return  redirect(route('payments.index'))->with('success', 'Payment deleted');
    }
}
