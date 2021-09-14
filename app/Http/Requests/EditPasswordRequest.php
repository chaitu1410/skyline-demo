<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules;
use Illuminate\Foundation\Http\FormRequest;

class EditPasswordRequest extends FormRequest
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
            'mobile' => ['required', 'numeric', 'digits:10', 'exists:users,mobile'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'mobile.required' => 'Please enter mobile number',
            'mobile.digits' => 'Please enter valid mobile number',
            'mobile.numeric' => 'Please enter valid mobile number',
            'mobile.exists' => 'This mobile number doesn\'t belongs to any account',
            'password.required' => 'Please enter password',
            'password.confirmed' => 'Password and confirm password should be equal',
            'password_confirmation.required' => 'Please enter password confirmation',
        ];
    }

    public function withValidator($validator)
    {
        if ($validator->fails()) {
            session()->flash('error', $validator->errors()->first());
        }
    }
}
