<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'name' => 'required | max:100',
            'image' => 'nullable | image | mimes:jpg,png,jpeg | max:5121',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'A name is required',
            'name.max' => 'Name should be less than 100 characters',
            'image.max' => 'Image size should be less than 5 MB',
            'image.image' => 'Enter valid image(allowed extemtions .jpg, .jpeg, .png )',
            'image.mimes' => 'Enter valid image(allowed extemtions .jpg, .jpeg, .png )',
        ];
    }

    public function withValidator($validator)
    {
        if ($validator->fails()) {
            session()->flash('error', $validator->errors()->first());
        }
    }
}
