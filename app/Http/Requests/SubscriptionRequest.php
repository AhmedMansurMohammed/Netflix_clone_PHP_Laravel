<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Cambia esto a true si quieres autorizar todas las solicitudes
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'planName' => 'required|string',
            'subscriptionMonths' => 'required|numeric|min:1',
            'entity' => 'required|string',
            'accountNumber' => 'required|string',
            'accountName' => 'required|string',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'planName.required' => 'Please select a plan name.',
            'subscriptionMonths.required' => 'Please select the number of subscription months.',
            'subscriptionMonths.numeric' => 'The subscription months must be a number.',
            'subscriptionMonths.min' => 'The minimum subscription period is 1 month.',
            'entity.required' => 'Please enter your entity.',
            'accountNumber.required' => 'Please enter your card number.',
            'accountName.required' => 'Please enter the name on your card.',
        ];
    }
}
