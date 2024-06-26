<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StateRequest extends FormRequest
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
            'country_id' => ['required', 'numeric', 'exists:countries,id']
        ];
    }

    public function validated($key = null, $default = null)
    {
        $validated = $this->validator->validated();
        $validated['slug'] = Str::slug($validated['name']);
        return $validated;
    }
    
}
