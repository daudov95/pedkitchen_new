<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
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
            'post_id' => "required|numeric",
            'title' => "required|max:255",
            'image' => "image|mimes:jpeg,jpg,png",
            'menu' => "required|numeric|exists:menu_lists,id",
            'submenu' => "required|numeric|exists:submenu_lists,id",
            'category' => "required|numeric|exists:post_categories,id",
            'authors' => "required",
            'tab1_title' => ['max:255'],
            'tab1_desc' => ['nullable'],
            'tab2_title' => ['max:255'],
            'tab2_desc' => ['nullable'],
            'tab3_title' => ['max:255'],
            'tab3_desc' => ['nullable'],
            'tab4_title' => ['max:255'],
            'tab4_desc' => ['nullable'],
            'is_video' => "required",
            'video' => [Rule::requiredIf(intval($this->is_video)), 'url', 'nullable'],
            'video_desc' => Rule::requiredIf(intval($this->is_video)),
        ];
    }



    public function messages() 
    {
        return [
            'title.required' => 'Заполните поле для заголовка',
            'image.required' => 'Выберите картинку',
            'image.image' => 'Выберите картинку',
            'image.mimes' => 'Неверный формат изображения. Возможные форматы (jpg, jpeg, png)',
            'menu.required' => 'Выберите раздел',
            'menu.exists' => 'Выберите раздел из списка',
            'submenu.required' => 'Выберите подраздел',
            'submenu.exists' => 'Выберите подраздел из списка',
            'category.required' => 'Выберите категорию',
            'category.exists' => 'Выберите категорию из списка',
            'tab1_title.required' => 'Заполните поле для заголовка таба 1',
            'tab2_title.required' => 'Заполните поле для заголовка таба 2',
            'tab3_title.required' => 'Заполните поле для заголовка таба 3',
            'tab4_title.required' => 'Заполните поле для заголовка таба 4',
            'tab1_desc.required' => 'Заполните поле для описания таба 1',
            'tab2_desc.required' => 'Заполните поле для описания таба 2',
            'tab3_desc.required' => 'Заполните поле для описания таба 3',
            'tab4_desc.required' => 'Заполните поле для описания таба 4',
            'authors.required' => 'Выберите автора(ов)',
            'is_video.required' => 'Выберите вид поста',
            'video.required' => 'Заполните поле для ссылки',
            'video.url' => 'Некорретный адрес на видео, введите ссылку',
            'video_desc.required' => 'Заполните поле для описание видео',
        ];
    }

}
