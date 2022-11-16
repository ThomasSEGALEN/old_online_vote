<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'last_name' => ['required'],
            'first_name' => ['required'],
            'email' => ['required'],
            'password' => ['required', 'min:6',],
            'avatar' =>  ['nullable', 'image'],
            'role_id' => ['required', 'max:1'],
        ];
    }

    public function messages()
    {
        return [
            'last_name.required' => 'Champ requis',
            'first_name.required' => 'Champ requis',
            'email.required' => 'Champ requis',
            'password.required' => 'Champ requis',
            'password.min' => '6 caractères minimum',
            'avatar.image' => 'Doit être une image',
            'role_id.required' => 'Une valeur minimum',
            'role_id.max' => 'Une valeur maximum',
        ];
    }
}
