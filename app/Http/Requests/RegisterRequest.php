<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'required|string|between:2,100',
            'surname' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8',
        ];
    }

    public function authorize(): bool {
        return true;
    }
}
