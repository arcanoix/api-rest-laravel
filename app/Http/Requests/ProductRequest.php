<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        switch ($this->method())
        {
            case 'POST':
                return [
                    'name'        => 'required|max:255|unique:product,name',
                    'description' => 'max:255',
                    'price'       => 'required|decimal:2',
                    'category'    => 'required|integer'
                    ];
                    break;

            case 'PATCH':
            case 'PUT':
                return [
                    'name'        => 'required|unique:product,name,' .$this->category->id,
                    'description' => 'max:255',
                    'price'       => 'required|decimal:2',
                    'category'    => 'required|integer'
               ];
                break;
        }
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'the name field product is required',
            'name.unique'       => 'the name of product is unique',
            'price.required'    => 'the price is required',
            'price.decimal'     => 'the price is two decimal, example: 10.2',
            'category.required' => 'the category is required',
            'category.integer'  => 'the category is integer, example: 1'
        ];
    }
}
