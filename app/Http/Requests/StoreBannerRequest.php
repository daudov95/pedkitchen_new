<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBannerRequest extends FormRequest
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
            'link' => "max:100",
            'image' => "required|image|max:3000|mimes:png,jpg,jpeg",
            'banner_order' => "required|numeric|max:20"
        ];
    }

    public function messages() 
    {
        return [
            'image.required' => 'Выберите картинку',
            'image.image' => 'Выберите картинку',
            'image.max' => 'Максимальный размер картинки 3000 kb',
            'image.mimes' => 'Неверный формат картинки. Нужен формат png или jpg',
            'banner_order.required' => 'Укажите очередность баннера',
            'banner_order.numeric' => 'Очередность нужно указывать в цифрах',
        ];
    }


}
