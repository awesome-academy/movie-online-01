<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilmRequest extends FormRequest
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
            'title_en' => 'required_without:title_vn|max:255',
            'title_vn' => 'required_without:title_en|max:255',
            'director' => 'max:50',
            'year' => 'required|numeric|digits_between:1,4',
            'duration' => 'required|numeric',
            'trailer' => 'required|max:255',
            'description' => 'required',
            'img' => 'required|image',
            'menu' => 'required',
            'actor' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title_en.required_without' => __('message.required_without'),
            'title_en.max' => __('message.max'),
            'title_vn.required_without' => __('message.required_without'),
            'title_vn.max' => __('message.max'),
            'director.max' => __('message.max'),
            'year.required' => __('message.required'),
            'year.numeric' => __('message.numeric'),
            'year.digits_between' => __('message.digits_between'),
            'duration.required' => __('message.required'),
            'duration.numeric' => __('message.numeric'),
            'trailer.required' => __('message.required'),
            'thumb.required' => __('message.required'),
            'thumb.image' => __('message.image'),
            'description.required' => __('message.required'),
            'menu.required' => __('message.required'),
            'actor.required' => __('message.required'),
        ]; 
    }
}
