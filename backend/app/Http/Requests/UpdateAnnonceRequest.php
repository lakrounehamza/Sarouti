<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAnnonceRequest extends FormRequest
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
            'title' => 'nullabel|string|max:255',
            'description' => 'nullabel|string',
            'price' => 'nullabel|numeric|min:0',
            'type' => 'nullabel|in:rental,sale',
            'ville' => 'nullabel|string|max:255',
            'status' => 'in:accepted,rejected,waiting',
            'seller_id' => 'nullabel|exists:users,id',
            'category_id' => 'nullabel|exists:categories,id',
        ];
    }
}
