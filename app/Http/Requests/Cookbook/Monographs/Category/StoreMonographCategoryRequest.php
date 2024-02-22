<?php

namespace App\Http\Requests\Cookbook\Monographs\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreMonographCategoryRequest extends FormRequest
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
            'title' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Заполните поле для заголовка'
        ];
    }
}
