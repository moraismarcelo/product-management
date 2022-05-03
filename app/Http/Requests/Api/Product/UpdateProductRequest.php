<?php

namespace App\Http\Requests\Api\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:120'],
            'product_voltage_id' => ['required', 'exists:product_voltages,id'],
            'product_brand_id' => ['required', 'exists:product_brands,id'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name is required',
            'name.string' => 'The name must be a string',
            'name.max' => 'The name must be less than 100 characters',
            'description.required' => 'The description is required',
            'description.string' => 'The description must be a string',
            'description.max' => 'The description must be less than 120 characters',
            'product_voltage_id.required' => 'The voltage is required',
            'product_voltage_id.exists' => 'The voltage must exist',
            'product_brand_id.required' => 'The brand is required',
            'product_brand_id.exists' => 'The brand must exist',
        ];
    }

}
