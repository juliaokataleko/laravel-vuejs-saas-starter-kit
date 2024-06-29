<?php

namespace App\Http\Requests\Business;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'subscription_id' => ['required', 'numeric'],
            'amount' => ['required'],
            // 'status' => ['required'],
            'payment_method' => ['required', 'string'],
            // 'start_date' => ['required', 'date'],
            // 'end_date' => ['nullable', 'date', 'after:start_date']
        ];
    }
}
