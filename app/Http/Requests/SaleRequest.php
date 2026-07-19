<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_id' => ['required', 'exists:customers,id'],

            'products' => ['required', 'array', 'min:1'],

            'products.*' => ['exists:products,id'],

            'quantities' => ['required', 'array'],

            'quantities.*' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages()
    {
        return [
            'customer_id.required' => 'Customer is required.',
            'customer_id.exists' => 'Selected customer does not exist.',

            'products.required' => 'Please select at least one product.',
            'products.min' => 'Please select at least one product.',
            'products.*.exists' => 'One or more selected products do not exist.',

            'quantities.required' => 'Quantities are required.',
            'quantities.array' => 'Quantities must be an array.',
            'quantities.*.required' => 'Product quantity is required.',
            'quantities.*.integer' => 'Product quantity must be a whole number.',
            'quantities.*.min' => 'Product quantity must be at least 1.',
        ];
    }

    public function attributes()
    {
        return [
            'quantities.*' => 'product quantity',
        ];
    }
}
