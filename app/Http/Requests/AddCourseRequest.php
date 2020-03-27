<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCourseRequest extends FormRequest
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
            'course' => 'required|max:64|unique:courses,name',
            'description' => 'required|max:500',
        ];
    }

    public function messages()
    {
        return [
            'course.required' => 'Name Course không được để trống',
            'course.max' => 'Tối đa 64 ký tự',
            'course.unique' => 'Course is exists',
            'description.required' => 'Description không được để trống',
            'description.max' => 'Tối đa 500 ký tự',
        ];
    }

}
