<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest {
    public function rules(): array {
        return [
            'email' => 'required|email',
            'password' => 'required|string',
        ];
    }
    public function messages(): array{
        return [
            'email.required' => 'Adres e-mail jest wymagany.',
            'email.email' => 'Wprowadź prawidłowy adres e-mail.',
            'password.required' => 'Hasło jest wymagane.',
            'password.string' => 'Hasło musi być ciągiem tekstowym.',
        ];
    }

    public function authorize(): bool {
        return true;
    }
}
