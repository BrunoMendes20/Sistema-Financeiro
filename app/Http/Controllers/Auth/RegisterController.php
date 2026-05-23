<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;


class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');

    }

    public function store(RegisterRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'insight_day' => now()->day,
            
        ]);

        return redirect()->route('login')->with('success', 'Conta criada com sucesso! Faça login.');
    }
    

    
}
