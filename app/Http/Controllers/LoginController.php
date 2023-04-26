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
    /**
     * Request que será recebido
     * @var \Illuminate\Http\Request $request
     */
    private Request $request;

    /**
     * Pagina de LOGIN
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(Request $request)
    {
        return view('site.login', ['titulo' => 'Login']);
    }

    /**
     * Recebe o request para autenticação
     * @param \App\Http\Requests\LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Verifica se usuário existe
     * @return true
     */
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

    /**
     * Efetuar loggout
     * @return \Illuminate\Http\RedirectResponse
     */
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
