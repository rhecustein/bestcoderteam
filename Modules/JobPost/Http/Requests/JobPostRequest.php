<?php

namespace Modules\JobPost\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobPostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('post')) {
            $rules = [
                'user_id'=>'required',
                'category_id'=>'required',
                'city_id'=>'required',
                'title'=>'required',
                'slug'=>'required|unique:job_posts',
                'description'=>'required',
                'regular_price'=>'required|numeric',
                'address'=>'required',
                'thumb_image'=>'required',
                'job_type'=>'required',
            ];
        }

        if ($this->isMethod('put')) {
            $rules = [
                'user_id'=>'required',
                'category_id'=>'required',
                'city_id'=>'required',
                'title'=>'required',
                'slug'=>'required|unique:job_posts,slug,'.$this->jobpost.',id',
                'description'=>'required',
                'regular_price'=>'required|numeric',
                'address'=>'required',
                'thumb_image'=>'sometimes|required',
            ];
        }

        return $rules;

    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'user_id.required' => trans('User is required'),
            'category_id.required' => trans('Category is required'),
            'city_id.required' => trans('City is required'),
            'title.required' => trans('Title is required'),
            'slug.required' => trans('Slug is required'),
            'slug.unique' => trans('Slug already exist'),
            'description.required' => trans('Description is required'),
            'regular_price.required' => trans('Price is required'),
            'regular_price.numeric' => trans('Price should be numeric'),
            'address.required' => trans('Address is required'),
            'thumb_image.required' => trans('Image is required'),
        ];
    }
}
