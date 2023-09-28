<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnswerRequest extends FormRequest
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
            // 'user_id' => ['required'],
            'message' => ['required', 'max:500'],
        ];
    }

    public function messages() 
    {
        return [
            'user_id.required' => 'Пользователь не выбран',
            'message.required' => 'Заполните поле сообщение',
            'message.max' => 'Максимум 20 символов',
        ];
    }
}
