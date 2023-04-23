<?php

namespace App\Http\Controllers;

use App\Exceptions\CreateEmpresaException;
use App\Exceptions\CreateUsuarioEmpresaException;
use App\Exceptions\ErrorUnexpectedException;
use App\Http\Requests\EmpresaRequest;
use App\Models\Empresa;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    private Request $request;

    private Empresa $empresa;

    private User $usuario;

    /**
     * Blade Cadastro
     * @return \Illuminate\Contracts\View\View
     */
    public function indexCadastro(): View
    {
        return view('site.cadastrar', ['titulo' => 'Cadastro']);
    }


    public function cadastrar(EmpresaRequest $request)
    {
        try {
            $this->request = $request;

            $this->criaEmpresa();

            $this->criaUsuarioEmpresa();

            auth()->login($this->usuario);

            return redirect()->route('app.home')->with('success', 'Empresa cadastrada com sucesso, aproveite o sistema 😁');
        } catch (CreateEmpresaException $e) {
            return $e->render();
        } catch (CreateUsuarioEmpresaException $e) {
            return $e->render();
        } catch (Exception $th) {
            return ErrorUnexpectedException::render();
        }
    }

    /**
     * Cria empresa com o request recebido
     * @return void
     */
    private function criaEmpresa()
    {
        try {
            $this->empresa = new Empresa();
            $this->empresa->nome = $this->request->input('nome');
            $this->empresa->cnpj = removerCaracteresEspeciais($this->request->input('cnpj'));
            $this->empresa->telefone = removerCaracteresEspeciais($this->request->input('nome'));
            $this->empresa->email = $this->request->input('email');
            $this->empresa->save();
        } catch (\Throwable $th) {
            throw new CreateEmpresaException();
        }
    }

    /**
     * Cria usuario da empresa
     * @return void
     */
    private function criaUsuarioEmpresa()
    {
        try {
            $this->usuario = new User();
            $this->usuario->name = "Administrador - " . $this->empresa->nome;
            $this->usuario->email = $this->empresa->email;
            $this->usuario->password = bcrypt($this->request->input("senha"));
            $this->usuario->empresa_id = $this->empresa->id;
            $this->usuario->save();
        } catch (\Throwable $th) {
            throw new CreateUsuarioEmpresaException();
        }
    }
}
