<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReturnOrderRequest extends FormRequest
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
            'products' => 'required',
            'products.*' => 'required | exists:order_products,id',
            'reasons.*' => 'required | max:255',
            'detailedReasons.*' => 'required | max:2048',
            'pickupAddress' => 'required | max:2048',
        ];
    }

    public function messages()
    {
        return [
            'products.required' => 'Please select any product',

            'products.*.required' => 'Please select any product',
            'products.*.exists' => 'Selected product doesn\'t exists',

            'reasons.*.required' => 'A please select reason for all selected products',
            'reasons.*.max' => 'Selected reason should be less than 255 characters',

            'detailedReasons.*.required' => 'A please enter detailed reason for all selected products',
            'detailedReasons.*.max' => 'Detailed reason should be less than 255 characters',

            'pickupAddress.required' => 'A pickup address is required',
            'pickupAddress.max' => 'Name should be less than 255 characters',
        ];
    }

    public function withValidator($validator)
    {
        if ($validator->fails()) {
            session()->flash('error', $validator->errors()->first());
        }
    }
}
