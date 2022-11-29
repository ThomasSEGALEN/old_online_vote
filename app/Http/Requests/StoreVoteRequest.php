<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVoteRequest extends FormRequest
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
            'type_id' => ['required', 'max:1'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Champ requis',
            'type_id.required' => 'Une valeur minimum',
            'type_id.max' => 'Une valeur maximum',
        ];
    }
}
