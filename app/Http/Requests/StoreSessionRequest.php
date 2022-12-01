<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSessionRequest extends FormRequest
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
            'title' => ['required'],
            'description' => ['nullable'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            // 'group_id' => ['required'],
            'user_id' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Champ requis',
            'start_date.required' => 'Champ requis',
            'end_date.required' => 'Champ requis',
            // 'group_id.required' => 'Une valeur minimum',
            'user_id.required' => 'Une valeur minimum',
        ];
    }
}
