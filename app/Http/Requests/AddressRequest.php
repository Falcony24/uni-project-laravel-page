<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest {
    public function rules(){
        return [
            'name' => 'required|string|max:64',
            'surname' => 'required|string|max:64',
            'city' => 'required|string|max:128',
            'postal_code' => 'required|string|max:6',
            'street' => 'required|string|max:128',
            'number' => 'required|string|max:10',
            'phone_number' => 'nullable|string|max:20'
        ];
    }

    public function authorize(): bool {
        return true;
    }

    public function messages(){
        return [
            'name.required' => 'Imię jest wymagane.',
            'surname.required' => 'Nazwisko jest wymagane.',
            'city.required' => 'Miasto jest wymagane.',
            'postal_code.required' => 'Kod pocztowy jest wymagany.',
            'street.required' => 'Ulica jest wymagana.',
            'number.required' => 'Numer domu jest wymagany.',
            'phone_number.string' => 'Numer telefonu musi być ciągiem tekstowym.',
            'user_id.required' => 'Identyfikator użytkownika jest wymagany.',
            'user_id.exists' => 'Podany użytkownik nie istnieje.',
        ];
    }
}
