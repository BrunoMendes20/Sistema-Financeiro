<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('auth.forgot-password');
    }

    public function store(ForgotPasswordRequest $request)
    {

        // Enviar o link de redefinição de senha
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Verificar o status do envio do link
        if($status === Password::RESET_LINK_SENT){
            return view('auth.email-sent');
        }

        return back()->withErrors([
            'email' => __($status)
        ]);
           


    }
}
