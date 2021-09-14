<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuoteRequest extends FormRequest
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
            'company' => 'required | max:255',
            'name' => 'required | max:255',
            'email' => 'required | email | max:255',
            'mobile' => 'required | digits:10',
            'requirements' => 'required',
            'pincode' => 'required | regex:/^[1-9]{1}[0-9]{2}[0-9]{3}$/ | exists:pincodes,pincode',
            'city' => 'required | max:255',
            'clientRequirement' => 'nullable | file | max:10240',
        ];
    }

    public function messages()
    {
        return [
            'company.required' => 'A company name is required',
            'company.max' => 'Company name should be less than 255 characters',

            'name.required' => 'A name is required',
            'name.max' => 'Name should be less than 255 characters',

            'email.required' => 'A email is required',
            'email.email' => 'Enter valid email address',
            'email.max' => 'Email should be less than 255 characters',

            'mobile.required' => 'A mobile number is required',
            'mobile.digits' => 'Enter valid mobile number',

            'requirements.required' => 'A requirement description is required',

            'pincode.required' => 'A pincode is required',
            'pincode.regex' => 'Enter valid pincode',
            'pincode.exists' => 'We doesn\'t deliver to this pincode',

            'city.required' => 'A city name is required',
            'city.max' => 'City name should be less than 255 characters',

            'clientRequirement.max' => 'Requirement file size should be less than 10 MB',
            'clientRequirement.file' => 'Enter valid requirement file(allowed extemtions .pdf, .docx, .doc )',

        ];
    }

    public function withValidator($validator)
    {
        if ($validator->fails()) {
            session()->flash('error', $validator->errors()->first());
        }
    }
}
