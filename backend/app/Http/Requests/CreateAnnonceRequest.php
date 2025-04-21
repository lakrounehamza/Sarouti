<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAnnonceRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'type' => 'required|string',
            'ville' => 'required|string',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'seller_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'images' => 'nullable|array',
            'images.*' => 'mimes:jpeg,png,jpg,gif|max:2048', 
            'features' => 'nullable|array',
            'features.*' => 'string|max:255',
        ];
    }
    
}
