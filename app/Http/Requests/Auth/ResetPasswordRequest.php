<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'],
            'password_confirmation' => ['required', 'same:password'],
        ];
    }

    public function messages(): array
    {
        return [

           'token.required' => 'Token inválido ou ausente',
            'email.required' => 'O e-mail é obrigatório',
            'email.email' => 'Informe um e-mail válido',

            'password.required' => 'A nova senha é obrigatória',
            'password.min' => 'A nova senha deve conter no mínimo :min caracteres',
            'password.max' => 'A nova senha deve conter no máximo :max caracteres',
            'password.regex' => 'A nova senha deve conter pelo menos uma letra maiúscula, uma minúscula e um número',
            'password_confirmation.required' => 'A confirmação da nova senha é obrigatória',
            'password_confirmation.same' => 'A confirmação da nova senha deve ser igual à nova senha',
        ];
    }
}
