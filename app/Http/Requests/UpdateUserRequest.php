<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => "required|max:20",
            'email' => "required|email|",
            'password' => "required|min:5",
            'admin' => "",
        ];
    }

    public function messages() 
    {
        return [
            'name.required' => 'Заполните поле для имени',
            'name.max' => 'Максимум 20 символов',
            'email.required' => 'Заполните поле для email',
            'email.email' => 'Некорректный email',
            'password.required' => 'Заполните поле для пароля',
            'password.min' => 'Пароль должен состоять минимум из 5 символов',
        ];
    }


}
