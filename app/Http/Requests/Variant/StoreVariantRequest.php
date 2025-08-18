<?php

namespace App\Http\Requests\Variant;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreVariantRequest extends FormRequest
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
        $allowedSizes = ['S', 'M', 'L', 'XL'];
        $allowedColors = ['Red', 'Blue', 'Green', 'Black', 'White'];

        return [
            'product_id'     => ['required', 'exists:products,id'],
            'size'           => ['nullable', 'string', 'max:50', Rule::in($allowedSizes)],
            'color'          => ['nullable', 'string', 'max:50', Rule::in($allowedColors)],
            'price_override' => ['required', 'numeric', 'min:0'],
            'stock_qty'      => ['nullable', 'integer', 'min:0'],
        ];
    }
}