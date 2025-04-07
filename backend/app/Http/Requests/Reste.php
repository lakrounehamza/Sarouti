<?php

namespace App\Http\Requests;

class Reste
{
    public function authorize()
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ];
    }
    public function messages(): array
    {
        return [
            'token.required' => 'le token est requis',
            'email.required' => 'ladresse e-mail est requise',
            'email.email' => 'l\'adresse e-mail doit être valide',
            'password.required' => 'le mot de passe est requis',
            'password.confirmed' => 'les mots de passe ne correspondent pas',
            'password.min' => 'le mot de passe doit comporter au moins 8 caractères',
        ];
    }
}
