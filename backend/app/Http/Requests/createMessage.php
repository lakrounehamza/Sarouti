<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createMessage extends FormRequest
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
            'sender_id' => 'required|exists:users,id',
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string|max:1000',
        ];
    }
    public function messages(): array
{
    return [
        'sender_id.required' => 'The sender ID is required.',
        'sender_id.exists' => 'The sender must exist in the users table.',
        'receiver_id.required' => 'The receiver ID is required.',
        'receiver_id.exists' => 'The receiver must exist in the users table.',
        'content.required' => 'The message content is required.',
        'content.max' => 'The message content must not exceed 1000 characters.',
    ];
}
public function withValidator($validator)
{
    $validator->after(function ($validator) {
        if ($this->sender_id === $this->receiver_id) {
            $validator->errors()->add('receiver_id', 'The sender and receiver cannot be the same.');
        }
    });
}
}
