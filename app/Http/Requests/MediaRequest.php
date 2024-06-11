<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MediaRequest extends FormRequest
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
            'release_year' => 'required|integer|min:1900|max:2099',
            'director' => 'required|string|max:255',
            'actors.*' => 'required|string|max:255', 
            'img_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'country' => 'required|string|max:255',
            'genres' => 'required|array|min:1', 
            'genres.*' => 'exists:genres,id_genre', 
            'description' => 'required|string',
            'url' => 'required_if:isSerie,0|nullable|url',
            'duration' => 'required_if:isSerie,0|nullable|integer|min:1', 
        ];
    }

    public function messages()
{
    return [
        'title.required' => 'The title is required.',
        'title.max' => 'The title may not be greater than :max characters.',
        'release_year.required' => 'The release year is required.',
        'release_year.integer' => 'The release year must be an integer.',
        'release_year.min' => 'The release year must be at least :min.',
        'release_year.max' => 'The release year may not be greater than :max.',
        'director.required' => 'The director is required.',
        'director.max' => 'The director name may not be greater than :max characters.',
        'actors.*.required' => 'All actors are required.',
        'actors.*.max' => 'An actor name may not be greater than :max characters.',
        'img_url.required' => 'The image is required.',
        'img_url.image' => 'The file must be an image.',
        'img_url.mimes' => 'The image must be a file of type: jpeg, png, jpg, or gif.',
        'img_url.max' => 'The image may not be greater than :max kilobytes.',
        'country.required' => 'The country is required.',
        'country.max' => 'The country name may not be greater than :max characters.',
        'genres.required' => 'At least one genre must be selected.',
        'genres.min' => 'At least one genre must be selected.',
        'genres.*.exists' => 'One or more selected genres are invalid.',
        'description.required' => 'The description is required.',
        'url.required_if' => 'The URL is required.',
        'url.url' => 'The URL format is invalid. Please enter a valid URL.',
        'duration.required_if' => 'The duration is required.',
        'duration.min' => 'The duration may not be less than 0min',
    ];
}

}
