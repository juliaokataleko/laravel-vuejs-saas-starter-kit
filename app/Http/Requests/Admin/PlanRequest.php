<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class PlanRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'active' => ['nullable'],
            'is_free' => ['nullable'],
            'description' => ['nullable'],
            'features' => ['nullable', 'array'],
            'monthly_price' => ['nullable'],
            'quarterly_price' => ['nullable'],
            'semiannually_price' => ['nullable'],
            'annually_price' => ['nullable'],
        ];
    }

    public function validated($key = null, $default = null)
    {
        $validated = $this->validator->validated();
        $validated['slug'] = Str::slug($validated['name']);

        if (!isset($validated['features'])) {
            // $validated['features'] = json_encode([]);
        }

        return $validated;
    }
}
