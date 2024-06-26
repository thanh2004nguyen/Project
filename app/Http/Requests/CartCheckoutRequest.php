<?php

namespace App\Http\Requests;
use Illuminate\Support\HtmlString;
use Illuminate\Foundation\Http\FormRequest;

class CartCheckoutRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'quantity' => 'min:1|max:100',
        ];
    }

    public function messages()
{
    return [
        'quantity.min' => 'Quantity min must higher tan 0',
        'quantity.max' => 'Quantity min must less than 101',

    ];
}
}
