<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
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
            'email'=>'required|email',
        ];

    }

    public function messages(): array
    {
        return [
            'email.required'=>'O email é obrigatório',
            'email.email'=>'O email deve ser um endereço válido',
        ];
    }


}
