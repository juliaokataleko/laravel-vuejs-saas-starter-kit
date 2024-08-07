<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\Business\PaymentRequest;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentRequest $request)
    {
        $data = $request->validated();
        $payment = Payment::query()->create($data);
        $payment->processImageUpload();

        // @TODO process in payment gateway like paypal, credit card

        activity()
        ->causedBy(auth()->user())
        ->performedOn($payment)
        ->log('Created a payment');

        return  redirect(route('business.payments.index'))->with('success', 'Your payment was created. We are processing it.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PaymentRequest $request, string $id)
    {
        $payment = Payment::findOrFail($id);

        $data = $request->validated();
        $payment->update($data);

        // process updload
        $payment->processImageUpload();

        // @TODO process in payment gateway like paypal, credit card

        activity()
        ->causedBy(auth()->user())
        ->performedOn($payment)
        ->log('Updated a payment');

        return  redirect(route('business.payments.index'))->with('success', 'Your payment was updated. We are processing it.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payment = Payment::findOrFail($id);
    }
}
