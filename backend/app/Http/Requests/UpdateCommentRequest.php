<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'client_id' => 'nullabel|exists:clients,id',
            'annonce_id' => 'nullabel|exists:annonces,id',
            'content' => 'nullabel|string|max:255',
            'rating' => 'nullabel|integer|between:1,5',
        ];
    }
}
