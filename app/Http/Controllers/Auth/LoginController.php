<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');

    }

    public function store(LoginRequest $request)
    {
        $key = 'login.' . $request->ip();

        if(RateLimiter::tooManyAttempts($key, 5)){
            $seconds = RateLimiter::availableIn($key);
            return back()
                ->withErrors(['email' => "Muitas tentativas de login. Tente novamente em {$seconds} segundos.",]);
        }

        
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            RateLimiter::hit($key, 60); // bloqueia por 60 segundos após 5 tentativas
            return back()
                ->withErrors(['email' => 'E-mail ou senha incorretos.',])
                ->onlyInput('email');
        }

        RateLimiter::clear($key); // Limpa o contador de tentativas após login bem-sucedido
        
        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }
   
}
