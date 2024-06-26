<?php

namespace App\Http\Requests;
use Illuminate\Support\HtmlString;
use Illuminate\Foundation\Http\FormRequest;

class postcontac extends FormRequest
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
            'firstname' => 'required|min:3',
            
        ];
    }

    public function messages()
{
    return [
        'firstname.required' => 'Product name must be entered',

        
    ];
}
}
