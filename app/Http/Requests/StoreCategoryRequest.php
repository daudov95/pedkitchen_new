<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'title' => "required|max:20|unique:post_categories",
        ];
    }

    public function messages() 
    {
        return [
            'title.required' => 'Заполните поле для заголовка',
            'title.max' => 'Максимум 20 символов',
            'title.unique' => 'Такая категория уже существует',
        ];
    }


}
