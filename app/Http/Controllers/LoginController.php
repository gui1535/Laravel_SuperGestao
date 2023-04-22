<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        return view('site.login', ['titulo' => 'Login']);
    }

    public function autenticar(LoginRequest $request)
    {
        dd($request);
        // Credenciais
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('app.home');
        }
    }

    public function sair()
    {
        session_destroy();
        return redirect()->route('site.index');
    }
}
