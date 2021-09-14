<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditContactDetailRequest extends FormRequest
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
            'customerSupportContact' => 'required | max:50',
            'salesContact' => 'required | max:50',
            'otherQueryContact' => 'required | max:50',
            'costomerSupportEmail' => 'required | max:50 | email',
            'salesEmail' => 'required | max:50 | email',
            'otherQueryEmail' => 'required | max:50 | email',
            'officeAddress' => 'required | max:2048',
        ];
    }

    public function messages()
    {
        return [
            'customerSupportContact.required' => 'A Customer Support Contact Number is required',
            'customerSupportContact.max' => 'Enter valid Customer Support Contact Number',

            'salesContact.required' => 'A sales contact number is required',
            'salesContact.max' => 'Enter valid sales contact number',

            'otherQueryContact.required' => 'A other query contact number is required',
            'otherQueryContact.max' => 'Enter valid other query contact number',

            'costomerSupportEmail.required' => 'A costomer support email is required',
            'costomerSupportEmail.max' => 'Enter valid costomer support email',

            'salesEmail.required' => 'A sales email is required',
            'salesEmail.max' => 'Enter valid sales email',

            'otherQueryEmail.required' => 'A other query email is required',
            'otherQueryEmail.max' => 'Enter valid other query email',

            'officeAddress.required' => 'A office address is required',
            'officeAddress.max' => 'Office address is too long',
        ];
    }

    public function withValidator($validator)
    {
        if ($validator->fails()) {
            session()->flash('error', $validator->errors()->first());
        }
    }
}
