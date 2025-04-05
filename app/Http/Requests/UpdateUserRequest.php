<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'nullabel|string|min:3|max:30',
            'email' => 'nullabel|string|email|unique:users,email',
            'password' => 'nullabel|string|min:8|regex:/^[A-Za-z0-9\d@$!%*?&]{8,}$/',
            'role' => 'nullabel|string|in:seller,client',
            'phone' => ['nullabel', 'string', 'regex:/^(\+212|0)(6|7)[0-9]{8}$/'],
            'photo' => ['nullabel', 'string'],
        ];
    }
}
