<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGroupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'user_id' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Champ requis',
            'user_id.required' => 'Une valeur minimum',
        ];
    }
}
