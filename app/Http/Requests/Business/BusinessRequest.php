<?php

namespace App\Http\Requests\Business;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class BusinessRequest extends FormRequest
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
            'email' => ['nullable', 'email'],
            'phone' => ['required', 'string'],
            'about' => 'nullable',
            'logo' => ['nullable', 'file', 'image'],
            'doc' => ['nullable'],
            'active' => ['nullable'],
            'country_id' => ['nullable', 'numeric'],
            'state_id' => ['nullable', 'numeric'],
            'city_id' => ['nullable', 'numeric'],
            'address' => ['nullable']
        ];
    }

    public function validated($key = null, $default = null)
    {
        $validated = $this->validator->validated();
        $validated['slug'] = Str::slug($validated['name']);
        return $validated;
    }
}
