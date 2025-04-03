<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
class LoginRequest extends FormRequest
{
 
    public function authorize()
    {
        return true;
    }

 
    public function rules(): array
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|string|min:8|regex:/^[A-Za-z0-9\d@$!%*?&]{8,}$/',
        ];
    }
        public function messages(): array
    {
        return [
            'email.required' => 'ladresse e-mail est requise',
            'email.email' => 'l\'adresse e-mail doit être valide',
            'password.required' => 'le mot de passe est requis',
            'password.min' => 'le mot de passe doit contenir au moins 8 caractères',
        ];
    }
    


}
