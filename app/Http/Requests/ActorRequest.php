<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActorRequest extends FormRequest
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
        $rules = [
            'stage_name' => 'required_without:real_name|max:255',
            'real_name' => 'required_without:stage_name|max:255',
            'location' => 'max:255',
        ];

        if (request()->method() == 'POST') {
            $rules = array_merge($rules, ['img' => 'required|image']);
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'stage_name.required_without' => __('message.required_without'),
            'stage_name.max' => __('message.max'),
            'real_name.required_without' => __('message.required_without'),
            'real_name.max' => __('message.max'),
            'location.max' => __('message.max'),
            'img.required' => __('message.required'),
            'img.image' => __('message.image'),
        ]; 
    }
}
