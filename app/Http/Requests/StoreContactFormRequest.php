<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreContactFormRequest extends FormRequest
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
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email'],
            'topic_select' => [Rule::notIn(['0']), 'required'],
            'message' => ['required', 'max:500'],
            'authors' => [Rule::requiredIf($this->topic_select == '1'), 'max:200'],
            'topic' => [Rule::requiredIf($this->topic_select == '2'), 'max:200'],
        ];
    }

    public function messages()
    {
        return [
            'authors.required' => 'Выберите автора',
            'authors.requiredIf' => 'Выберите автора',
            'topic_select.required' => 'Выберите тему',
            'topic_select.not_in' => 'Выберите тему',
            'topic.required' => 'Введите тему',
            'name.required' => 'Введите Имя',
            'email.required' => 'Введите E-mail',
            'name.email' => 'Некорректный E-mail адрес',
            'message.required' => 'Введите ваще сообщение',
            'message.max' => 'Текс должен быть меньше 500 символов',
        ];
    }
}
