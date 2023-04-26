<?php

namespace App\Http\Controllers;

use App\Exceptions\CreateContatoException;
use App\Exceptions\ErrorUnexpectedException;
use App\Http\Requests\ContatoRequest;
use Illuminate\Http\Request;
use App\Models\SiteContato;
use App\Models\MotivoContato;

class ContatoController extends Controller
{
    /**
     * Request que será recebido
     * @var \Illuminate\Http\Request $request
     */
    private Request $request;

    /**
     * Contato
     * @var \App\Models\SiteContato $contato
     */
    private SiteContato $contato;

    /**
     * Recebe o request para criar um contato
     * @param \App\Http\Requests\ContatoRequest $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function store(ContatoRequest $request)
    {
        try {
            $this->request = $request;

            $this->contato = new SiteContato();

            $this->criaOuAtualizaContato();

            return redirect()->back()->with('success', 'Contato enviado com sucesso!');
        } catch (CreateContatoException $e) {
            return $e->render();
        } catch (\Throwable $th) {
            return ErrorUnexpectedException::render();
        }
    }

    /**
     * Cria ou atualiza um contato
     * @param bool $atualizar
     * @return void
     */
    private function criaOuAtualizaContato($atualizar = false)
    {
        try {
            $this->contato->nome = $this->request->input('nome');
            $this->contato->telefone = $this->request->input('telefone');
            $this->contato->email = $this->request->input('email');
            $this->contato->mensagem = $this->request->input('mensagem');
            $this->contato->motivo_contatos_id = $this->request->input('motivo-contato');
            $this->contato->save();
        } catch (\Throwable $th) {
            throw new CreateContatoException();
        }
    }
}
