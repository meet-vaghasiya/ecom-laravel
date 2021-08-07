<?php

namespace App\Http\Requests\HomeSlider;

use Illuminate\Foundation\Http\FormRequest;

class HomeSliderRequest extends FormRequest
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
            'title' => "required|min:3|max:200|unique:home_sliders,title",
            // 'description'=>'nullable',
            'avatar' => 'nullable|mimes:png,jpg|max:2048'
        ];
    }
}
