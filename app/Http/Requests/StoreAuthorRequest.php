<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuthorRequest extends FormRequest
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
            'name' => "required|max:20|unique:authors",
        ];
    }

    public function messages() 
    {
        return [
            'name.required' => 'Заполните поле для имени',
            'name.max' => 'Максимум 20 символов',
            'name.unique' => 'Такой автор уже существует',
        ];
    }


}
