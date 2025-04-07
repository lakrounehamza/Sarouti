<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class ForgotRequest  extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'email' => 'required|string|email',
        ];
    }
    public function messages(): array
    {
        return [
            'email.required' => 'ladresse e-mail est requise',
            'email.email' => 'l\'adresse e-mail doit être valide'
        ];
    }
}
