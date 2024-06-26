<?php

namespace App\Http\Requests;
use Illuminate\Support\HtmlString;
use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest
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
    
            
        ];
    }

    public function messages()
{
    return [
        'name.required' => 'Must enter Product name',
        'description.required' => 'Must enter product description',
        'name.min' => 'Product Name At least 3 Characters',
        'quantity.numeric' => 'Quantity Must Be Number',
        'quantity.max' => 'The Highest Quantity Is 1000',
        'quantity.required' => 'Must enter Product Quantity',
        'price.required' => 'Must enter Product Price',

        
    ];
}
}
