<?php

namespace App\Http\Requests\Admin;

use App\Models\Business;
use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'business_id' => ['required', 'numeric'],
            'plan_id' => ['required', 'numeric'],
            'billing_cycle' => ['required'],
            // 'amount' => ['required'],
            'status' => ['required'],
            'active' => ['nullable'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date']
        ];
    }

    public function validated($key = null, $default = null)
    {
        $validated = $this->validator->validated();
        $validated['user_id'] = Business::find($validated['business_id'])?->id;

        $amount = 0.00;
        $plan =  Plan::find($validated['plan_id']);

        if ($plan) {
            if ($validated['billing_cycle'] == 'monthly') $amount = $plan->monthly_price;
            else if ($validated['billing_cycle'] == 'quarterly') $amount = $plan->quarterly_price;
            else if ($validated['billing_cycle'] == 'semiannually') $amount = $plan->semiannually_price;
            else if ($validated['billing_cycle'] == 'yearly') $amount = $plan->annually_price;
        }

        $validated['amount'] = $amount;

        return $validated;
    }

}
