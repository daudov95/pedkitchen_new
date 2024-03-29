<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubSectionRequest extends FormRequest
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
            'title' => ['required','max:255'],
            'image' => ['image', 'max:200', 'mimes:png'],
            'menu' => ['required', 'numeric', 'exists:menu_lists,id'],
            'order' => ['required', 'integer'],
        ];
    }

    public function messages() 
    {
        return [
            'title.required' => 'Заполните поле для заголовка',
            'image.required' => 'Выберите иконку',
            'image.image' => 'Выберите иконку',
            'image.max' => 'Максимальный размер иконки 200 kb',
            'image.mimes' => 'Неверный формат иконки. Нужен формат png',
            'menu.required' => 'Выберите раздел',
            'menu.exists' => 'Выберите раздел из списка',
            'order.required' => 'Заполните поле для очередности',
            'order.integer' => 'Поле для очередности должен состоять из цифр',
        ];
    }


}
