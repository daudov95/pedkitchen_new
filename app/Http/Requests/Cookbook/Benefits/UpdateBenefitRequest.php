<?php

namespace App\Http\Requests\Cookbook\Benefits;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBenefitRequest extends FormRequest
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
            'title' => ['required', 'max:255'],
            'category_id' => ['required', 'numeric', 'exists:category_diagnostics,id'],
            'authors' => ['required'],
            'image' => ['image', 'mimes:jpeg,jpg,png'],
            'document' => ['file', 'mimes:pdf,doc,docx'],
        ];
    }
    

    public function messages() 
    {
        return [
            'id.required' => 'ID поста не указано',
            'title.required' => 'Заполните поле для заголовка',
            'category_id.required' => 'Выберите категорию',
            'category_id.exists' => 'Выберите категорию',
            'authors.required' => 'Выберите авторов',
            'image.required' => 'Выберите картинку',
            'image.image' => 'Выберите картинку',
            'image.mimes' => 'Неверный формат изображения. Возможные форматы (jpg, jpeg, png)',
            'document.required' => 'Выберите документ',
            'document.file' => 'Неправильный формат файла',
            'document.mimes' => 'Неверный формат файла. Возможные форматы (pdf, doc, doxc)',
        ];
    }
}
