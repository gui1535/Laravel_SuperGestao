<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorUnexpectedException;
use App\Exceptions\UserNotFoundException;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    private Request $request;

    public function index(Request $request)
    {
        return view('site.login', ['titulo' => 'Login']);
    }

    public function autenticar(LoginRequest $request)
    {
        try {
            // Request
            $this->request = $request;

            // Verificando se existe usuario
            if ($this->verificaSeExisteUsuario()) {
                $request->session()->regenerate();
                return redirect()->route('app.home');
            }
        } catch (UserNotFoundException $e) {
            return $e->render();
        } catch (Exception $e) {
            return ErrorUnexpectedException::render();
        }
    }

    private function verificaSeExisteUsuario()
    {
        $credentials = [
            'email' => $this->request->input('email'),
            'password' => $this->request->input('password'),
        ];
        if (Auth::attempt($credentials)) {
            return true;
        } else {
            throw new UserNotFoundException();
        }
    }

    public function sair()
    {
        try {
            Auth::logout();
            return redirect()->route('site.index');
        } catch (\Throwable $th) {
            return ErrorUnexpectedException::render();
        }
    }
}
