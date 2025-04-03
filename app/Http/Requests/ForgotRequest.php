<?php

namespace App\Http\Requests;

class ForgotRequest
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
            'email' => 'l\'adresse e-mail doit être valide',
        ];
    }
}
