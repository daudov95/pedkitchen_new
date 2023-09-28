<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'topic' => ['max:200'],
            'authors' => ['max:200'],
            'topic_select' => ['max:50'],
            'topic' => ['max:200'],
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email'],
            'message' => ['required', 'max:500'],
        ];
    }
}
