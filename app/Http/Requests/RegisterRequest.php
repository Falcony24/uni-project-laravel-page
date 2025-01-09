<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest {
    protected function prepareForValidation(): void {
        $nameParts = explode(' ', $this->name, 2);

        $this->merge([
            'name' => $nameParts[0] ?? '',
            'surname' => $nameParts[1] ?? '',
        ]);
    }
    public function rules(): array {
        return [
            'name' => 'required|string|between:2,64',
            'surname' => 'required|string|between:2,64',
            'email' => 'required|string|email|max:64|unique:users',
            'password' => 'required|string|between:6,64|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/',
            'password_confirmation' => 'required|string|between:2,64|same:password',
        ];
    }

    public function authorize(): bool {
        return true;
    }

    public function messages(){
        return [
            'name.required' => 'Imię i nazwisko jest wymagane.',
            'email.required' => 'Adres e-mail jest wymagany.',
            'email.email' => 'Adres e-mail nie jest poprawny.',
            'password.required' => 'Hasło jest wymagane.',
            'password.regex' => 'Hasło powinno składać się z dużej i małej litery, przynajmniej jednej cyfry, minimum 6 znaków.',
            'email.unique' => 'Konto z takim mailem już istnieje.',
        ];
    }

}
