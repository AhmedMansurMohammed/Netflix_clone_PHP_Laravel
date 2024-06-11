<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class GenreRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('genres'),
            ],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The name is required.',
            'name.max' => 'The name may not be greater than :max characters.',
            'name.unique' => 'The name has already been taken.',
        ];
    }
}
