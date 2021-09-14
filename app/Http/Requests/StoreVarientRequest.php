<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVarientRequest extends FormRequest
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
            'name' => 'required | max:200',
            'mrp' => 'required | numeric',
            'discount' => 'required | numeric',
            'gst' => 'required | numeric',
            'sellingPrice' => 'required | numeric',
            'stock' => 'required',
            'values.*' => 'sometimes | required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'A name is required',
            'name.max' => 'Name should be less than 200 characters',

            'mrp.required' => 'MRP is required',
            'mrp.numeric' => 'MRP must be numeric value',

            'discount.required' => 'Discount is required',
            'discount.numeric' => 'Discount must be numeric value',

            'gst.required' => 'GST is required',
            'gst.numeric' => 'GST must be numeric value',

            'sellingPrice.required' => 'Selling price is required',
            'sellingPrice.numeric' => 'Selling price must be numeric value',

            'stock.required' => 'Stock state is required',
            'values.*.required' => 'Enter values for all properties'
        ];
    }

    public function withValidator($validator)
    {
        if ($validator->fails()) {
            session()->flash('error', $validator->errors()->first());
        }
    }
}
