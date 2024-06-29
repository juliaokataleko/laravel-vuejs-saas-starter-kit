<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PaymentMethodRequest;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payment_methods = PaymentMethod::paginate(10);

        activity()
        ->causedBy(auth()->user())
        ->log('Listed payment methods');

        return Inertia::render('Admin/PaymentMethods/Index', compact('payment_methods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $payment_method = new PaymentMethod();
        return Inertia::render('Admin/PaymentMethods/Form', compact('payment_method'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentMethodRequest $request)
    {
        $data = $request->validated();
        $payment_method = PaymentMethod::query()->create($data);

        activity()
        ->causedBy(auth()->user())
        ->performedOn($payment_method)
        ->log('Created a payment_method');

        return redirect(route('payment-methods.index'))->with('success', 'Payment Method created');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $payment_method = PaymentMethod::findOrFail($id);
        return Inertia::render('Admin/PaymentMethods/Form', compact('payment_method'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $payment_method = PaymentMethod::findOrFail($id);
        return Inertia::render('Admin/PaymentMethods/Form', compact('payment_method'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PaymentMethodRequest $request, int $id)
    {
        $payment_method = PaymentMethod::findOrFail($id);
        $data = $request->validated();
        $payment_method->update($data);

        activity()
        ->causedBy(auth()->user())
        ->performedOn($payment_method)
        ->log('Updated a payment_method');

        return redirect(route('payment-methods.index'))->with('success', 'Payment Method created');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $payment_method = PaymentMethod::findOrFail($id);

        activity()
        ->causedBy(auth()->user())
        ->performedOn($payment_method)
        ->log('Deleted a payment_method');

        $payment_method->delete();

        return redirect(route('payment-methods.index'))->with('success', 'Payment Method Deleted');
    }
}
