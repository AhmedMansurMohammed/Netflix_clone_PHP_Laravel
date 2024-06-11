<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EpisodeRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'required_if:isSerie,0|nullable|url',
            'duration' => 'required_if:isSerie,0|nullable|integer|min:1', 
            'season' => 'required|string|max:255',
        ];
    }

    public function messages()
{
    return [
        'title.required' => 'The title is required.',
        'title.max' => 'The title may not be greater than :max characters.',
        'description.required' => 'The description is required.',
        'url.required_if' => 'The URL is required.',
        'url.url' => 'The URL format is invalid. Please enter a valid URL.',
        'duration.required_if' => 'The duration is required.',
        'duration.min' => 'The duration may not be less than 0min',
        'season.required' => 'The season is required.',
    ];
}

}
