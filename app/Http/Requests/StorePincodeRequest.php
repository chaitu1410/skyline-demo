<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePincodeRequest extends FormRequest
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
            'state' => ['required', 'max:255'],
            'city' => ['required', 'max:255'],
            'pincode' => ['required', 'regex:/^[1-9]{1}[0-9]{2}[0-9]{3}$/', 'unique:pincodes,pincode'],
            'deliveryCharge' => ['required', 'numeric'],
            'freeDeliveryLimit' => ['nullable', 'numeric'],
        ];
    }

    public function messages()
    {
        return [
            'state.required' => 'A state is required',
            'state.max' => 'State should be less than 255 characters',
            'city.required' => 'A city is required',
            'city.max' => 'City should be less than 255 characters',

            'pincode.required' => 'A pincode is required',
            'pincode.regex' => 'Enter valid pincode',
            'pincode.unique' => 'Pincode already added',

            'deliveryCharge.required' => 'Please enter delivery charge',
            'deliveryCharge.numeric' => 'Enter valid delivery charge',

            'freeDeliveryLimit.numeric' => 'Enter valid free delivery limit',
        ];
    }

    public function withValidator($validator)
    {
        if ($validator->fails()) {
            session()->flash('error', $validator->errors()->first());
        }
    }
}
