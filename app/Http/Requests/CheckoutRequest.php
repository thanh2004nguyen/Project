<?php

namespace App\Http\Requests;
use Illuminate\Support\HtmlString;
use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'shipping' => 'required',
            // 'name' => 'required',
            
            

        ];
    }

    public function messages()
{
    return [
        'shipping.required' => new HtmlString('<strong>Alert!</strong> You must choose a Shipping method.s
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button> '),
        // 'name.required' => 'name required'

        

        // Error messages for other fields
    ];
}
}
