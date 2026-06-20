<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Http\Requests\Auth\ResetPasswordRequest;


class ResetPasswordController extends Controller
{
    public function index(string $token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function store(ResetPasswordRequest $request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => $password,

                    // invalida remember me em outros dispositivos
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        if($status === Password::PASSWORD_RESET){

            return redirect()->route('login')->with('success', 'Senha redefida com sucesso! Faça login.');
        }

        return back()->withErrors([
            'email' => trans($status)
        ]); 
    }



  
}