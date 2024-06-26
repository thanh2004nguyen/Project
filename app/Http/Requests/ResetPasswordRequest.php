<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ResetPasswordRequest extends FormRequest
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
            'email' => [
                'required',
                'email',
                Rule::in([$this->session()->get('reset_email')])
            ],
            'password' => 'required|min:6|confirmed',
            //
        ];
    }

    public function messages()
{
    return [
        'password.confirmed' => 'The password confirmation does not match.',
        'password.required' => 'Must enter password',
        'password.min' => 'Password must atleast character',
        'email.in' => 'The email does not match',
        'email.required' => 'The email field is required.',
        'email.email' => 'Please enter a valid email address.',

    ];
}


}
