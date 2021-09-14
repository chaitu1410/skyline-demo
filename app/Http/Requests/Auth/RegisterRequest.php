<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rules;

class RegisterRequest extends FormRequest
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
            'mobile' => ['required', 'numeric', 'digits:10', 'unique:users'],
            'email' => ['required', 'email', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter your name',
            'name.string' => 'Please enter valid name',
            'name.max' => 'Name can have maximum 255 characters',
            'mobile.required' => 'Please enter mobile number',
            'mobile.digits' => 'Please enter valid mobile number',
            'mobile.numeric' => 'Please enter valid mobile number',
            'mobile.unique' => 'This mobile number is already taken',
            'email.required' => 'Please enter email address',
            'email.email' => 'Please enter valid email address',
            'email.string' => 'Please enter valid email address',
            'email.max' => 'Email can have maximum 255 characters',
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
