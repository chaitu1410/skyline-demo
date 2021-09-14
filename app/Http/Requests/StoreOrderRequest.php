<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'digits:10'],
            'mobile2' => ['required', 'digits:10'],
            'pincode' => ['required', 'regex:/^[1-9]{1}[0-9]{2}\\s{0,1}[0-9]{3}$/', 'exists:pincodes,pincode'],
            'town' => ['required', 'string', 'max:255'],
            'area' => ['required', 'string', 'max:255'],
            'houseNumber' => ['required', 'string', 'max:255'],
            'landmark' => ['required', 'string', 'max:255'],
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

            'mobile.required' => 'Please enter first mobile number',
            'mobile.digits' => 'Please enter valid first mobile number',

            'mobile2.required' => 'Please enter second mobile number',
            'mobile2.digits' => 'Please enter valid second mobile number',


            'pincode.required' => 'Please enter pincode',
            'pincode.regex' => 'Please enter valid pincode',
            'pincode.exists' => 'We don\'t deliever to entered pincode',


            'town.required' => 'Please enter Town/city',
            'town.string' => 'Enter valid Town/city name',
            'town.max' => 'Town/city name should not exceed 255 characters',


            'area.required' => 'Please enter Area, Colony, Street, Sector, Village',
            'area.string' => 'Enter valid Area, Colony, Street, Sector, Village ',
            'area.max' => 'Area, Colony, Street, Sector, Village should not exceed 255 characters',

            'houseNumber.required' => 'Please enter Flat, House no, Building, Company, Apartment',
            'houseNumber.string' => 'Please enter valid Flat, House no, Building, Company, Apartment should not exceed 255 characters',
            'houseNumber.max' => 'Flat, House no, Building, Company, Apartment should not exceed 255 characters',

            'landmark.required' => 'Please enter Landmark',
            'landmark.string' => 'Please enter valid Landmark',
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
