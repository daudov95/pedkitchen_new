<?php

namespace App\Http\Requests\Cookbook\Monographs;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMonographsRequest extends FormRequest
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
            'id' => ['required', 'numeric'],
            'category_id' => ['required', 'numeric'],
            'title' => ['required', 'max:255'],
            'desc' => ['required'],
            'year' => ['required', 'numeric'],
            'authors' => ['required'],
            'image' => ['image', 'mimes:jpeg,jpg,png'],
            'document' => ['file', 'mimes:pdf,doc,docx'],
        ];
    }
    

    public function messages() 
    {
        return [
            'id.required' => 'ID поста не указано',
            'category_id.required' => 'Выберите категорию',
            'title.required' => 'Заполните поле для заголовка',
            'desc.required' => 'Заполните поле для описания',
            'image.required' => 'Выберите картинку',
            'image.image' => 'Выберите картинку',
            'image.mimes' => 'Неверный формат изображения. Возможные форматы (jpg, jpeg, png)',
            'year.required' => 'Заполните поле для года',
            'year.numeric' => 'Год нужно указать цифрами',
            'authors.required' => 'Выберите авторов',
            'document.required' => 'Выберите документ',
            'document.file' => 'Неправильный формат файла',
            'document.mimes' => 'Неверный формат файла. Возможные форматы (pdf, doc, doxc)',
        ];
    }
}
