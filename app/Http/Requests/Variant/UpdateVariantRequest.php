<?php

namespace App\Http\Requests\Variant;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVariantRequest extends FormRequest
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
            'product_id'     => ['sometimes', 'required', 'exists:products,id'],
            'size'           => ['sometimes', 'nullable', 'string', 'max:50', Rule::in($allowedSizes)],
            'color'          => ['sometimes', 'nullable', 'string', 'max:50', Rule::in($allowedColors)],
            'price_override' => ['sometimes', 'required', 'numeric', 'min:0'],
            'stock_qty'      => ['sometimes', 'nullable', 'integer', 'min:0'],
        ];
    }
}
