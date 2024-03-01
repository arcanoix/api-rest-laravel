<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
                    'name' => 'required|unique:categories,name',
                    ];
                    break;

            case 'PATCH':
            case 'PUT':
                return [
                    'name' => 'required|unique:categories,name,' .$this->category->id,
               ];
                break;
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'the name field category is required',
            'name.unique'   => 'the name of category is unique'
        ];
    }
}
