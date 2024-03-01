<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

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

    public function messages(): Arr
    {
        return [
            'name'
        ];
    }
}
