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
            'lastName' => ['required'],
            'firstName' => ['required'],
            'email' => ['required'],
            'password' => ['required', 'min:6',],
            'avatar' =>  ['nullable', 'image'],
            'title' => ['required', 'max:1'],
            'role' => ['required', 'max:1'],
        ];
    }

    public function messages()
    {
        return [
            'lastName.required' => 'Champ requis',
            'firstName.required' => 'Champ requis',
            'email.required' => 'Champ requis',
            'password.required' => 'Champ requis',
            'password.min' => '6 caractères minimum',
            'avatar.image' => 'Doit être une image',
            'title.required' => 'Une valeur minimum',
            'title.max' => 'Une valeur maximum',
            'role.required' => 'Une valeur minimum',
            'role.max' => 'Une valeur maximum',
        ];
    }
}
