<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQueryRequest extends FormRequest
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
            'name' => 'required | max:100',
            'email' => 'required | max:100 | email',
            'message' => 'required | max:512'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'A name is required',
            'name.max' => 'Name should be less than 100 characters',
            'email.required' => 'A email is required',
            'email.max' => 'Email address should be less than 100 characters',
            'email.email' => 'Enter valid email address',
            'message.required' => 'A message is required',
            'message.max' => 'Message should be less than 512 characters',
        ];
    }

    public function withValidator($validator)
    {
        if ($validator->fails()) {
            session()->flash('error', 'Failed to submit query!');
        }
    }
}
