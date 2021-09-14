<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest
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
            'brand' => 'required | numeric | exists:brands,id',
            'mrp' => 'required | numeric',
            'discount' => 'required | numeric',
            'gst' => 'required | numeric',
            'sellingPrice' => 'required | numeric',
            'stock' => 'required',
            'verified' => 'required',
            'image' => 'nullable | image | mimes:jpg,png,jpeg | max:5121',
            'images.*' => 'nullable | image | mimes:jpg,png,jpeg | max:5121',
            'manual' => 'file | max:10240',
            'description' => 'required',
            'countryOfOrigin' => 'required | max:100',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'A name is required',
            'name.max' => 'Name should be less than 100 characters',

            'subcategory.required' => 'Please select subcategory',
            'subcategory.numeric' => 'Select valid subcategory',
            'subcategory.exists' => 'Selected subcategory doesn\'t exists',

            'brand.required' => 'Please select brand',
            'brand.numeric' => 'Select valid subcategory',
            'brand.exists' => 'Selected brand doesn\'t exists',

            'mrp.required' => 'MRP is required',
            'mrp.numeric' => 'MRP must be numeric value',

            'discount.required' => 'Discount is required',
            'discount.numeric' => 'Discount must be numeric value',

            'gst.required' => 'GST is required',
            'gst.numeric' => 'GST must be numeric value',

            'sellingPrice.required' => 'Selling price is required',
            'sellingPrice.numeric' => 'Selling price must be numeric value',

            'stock.required' => 'Stock state is required',

            'verified.required' => 'Verification state is required',

            'image.required' => 'A image is required',
            'image.max' => 'Image size should be less than 5 MB',
            'image.image' => 'Enter valid image file(allowed extemtions .jpg, .jpeg, .png )',
            'image.mimes' => 'Enter valid image(allowed extemtions .jpg, .jpeg, .png )',

            'images.*.max' => 'Image size should be less than 5 MB in images field',
            'images.*.image' => 'Enter valid image file in images field(allowed extemtions .jpg, .jpeg, .png )',
            'images.*.mimes' => 'Enter valid image in images field(allowed extemtions .jpg, .jpeg, .png )',

            'manual.required' => 'A manual is required',
            'manual.max' => 'Manual size should be less than 10 MB',
            'manual.file' => 'Enter valid manual file(allowed extemtions .pdf )',

            'description.required' => 'A description is required',

            'countryOfOrigin.required' => 'A country of origin is required',
            'countryOfOrigin.max' => 'Country of origin should be less than 100 characters',
        ];
    }

    public function withValidator($validator)
    {
        if ($validator->fails()) {
            session()->flash('error', $validator->errors()->first());
        }
    }
}
