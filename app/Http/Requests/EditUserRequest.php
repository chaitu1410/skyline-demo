<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'mobile2' => ['nullable', 'digits:10'],
            'pincode' => ['nullable', 'regex:/^[1-9]{1}[0-9]{2}\\s{0,1}[0-9]{3}$/'],
            'town' => ['max:255'],
            'area' => ['max:255'],
            'houseNumber' => ['max:255'],
            'landmark' => ['max:255'],
            'gst' => ['nullable', 'size:15'],
            'company' => ['max:255', 'exclude_if:gst,null', 'required']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter your name',
            'name.string' => 'Please enter valid name',
            'name.max' => 'Name can have maximum 255 characters',

            'mobile2.digits' => 'Please enter valid second mobile number',
            'mobile2.numeric' => 'Please enter valid mobile number(Second mobile number)',
            'mobile2.unique' => 'This mobile number is already taken(Second mobile number)',

            'pincode.regex' => 'Please enter valid pincode',

            'town.max' => 'Town/city should not exceed 255 characters',

            'area.max' => 'Area, Colony, Street, Sector, Village should not exceed 255 characters',

            'houseNumber.max' => 'Flat, House no, Building, Company, Apartment should not exceed 255 characters',

            'landmark.max' => 'Landmark should not exceed 255 characters',

            'gst.size' => 'Please enter valid GST number',

            'company.max' => 'Company name should not exceed 255 characters',
            'company.required' => 'Company name is required if GST number entered',
        ];
    }

    public function withValidator($validator)
    {
        if ($validator->fails()) {
            session()->flash('error', $validator->errors()->first());
        }
    }
}
