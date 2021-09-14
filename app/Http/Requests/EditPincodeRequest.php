<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditPincodeRequest extends FormRequest
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
            'pincode' => ['required', 'regex:/^[1-9]{1}[0-9]{2}[0-9]{3}$/'],
            'deliveryCharge' => ['required', 'numeric'],
            'freeDeliveryLimit' => ['nullable', 'numeric'],
        ];
    }

    public function messages()
    {
        return [
            'pincode.required' => 'A pincode is required',
            'pincode.regex' => 'Enter valid pincode',

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
