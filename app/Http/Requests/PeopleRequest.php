<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class PeopleRequest extends FormRequest
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
                Rule::unique('peoples')->where(function ($query) {
                    return $query->where('profession', $this->profession);
                }),
            ],
            'profession' => 'required|in:DIRECTOR,ACTOR',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'The name is required.',
            'name.max' => 'The name may not be greater than :max characters.',
            'profession.required' => 'The profession is required.',
            'profession.in' => 'Invalid profession selected.',
        ];
    }
}
