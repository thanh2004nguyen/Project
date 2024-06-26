<?php

namespace App\Http\Requests;
use Illuminate\Support\HtmlString;
use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
            'name' => 'required|min:3',
            'description' => 'required|min:10',
            'quantity' => 'required|numeric|max:1000',
            'price' => 'required',
            'product_image' => 'required',
            'nutrition_fact' => 'required',
            
        ];
    }

    public function messages()
{
    return [
        'name.required' => 'Product name must be entered',
        'name.min' => 'Product name of at least 3 characters',
        'quantity.numeric' => 'The quantity must be numeric',
        'quantity.max' => 'The highest number is 1000',
        'quantity.required' => 'Product quantity must be entered',
        'price.required' => 'Must enter Product Price',
        'nutrition_fact.required' => 'Product nutrient details must be entered',
        
    ];
}
}
