<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadCover extends FormRequest
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
            'uploadCover' => 'bail|image|mimes:jpg,png,jpeg,gif|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'uploadCover.image' => "File is not image",
            'uploadCover.mimes' => "File is accept type are: jpg,jpeg,png,gif",
            'uploadCover' => "Max size is 2048 KB"
        ];
    }
}
