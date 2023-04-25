<?php

namespace App\Http\Controllers;

use App\Exceptions\ClienteDeleteException;
use App\Exceptions\ClienteNotFoundException;
use App\Exceptions\ClienteUpdateException;
use App\Exceptions\CreateClienteException;
use App\Exceptions\ErrorUnexpectedException;
use App\Http\Requests\ClienteRequest;
use Illuminate\Http\Request;
use App\Models\Cliente;
use Exception;
use Facade\FlareClient\Http\Client;
use Illuminate\Support\Facades\Crypt;

class ClienteController extends Controller
{
    /**
     * Request que será recebido
     * @var \Illuminate\Http\Request $request
     */
    private Request $request;

    /**
     * Cliente
     * @var \App\Models\Cliente $cliente
     */
    private Cliente $cliente;

    /**
     * Index da pagina de clientes
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(Request $request)
    {
        $clientes = Cliente::paginate(10);
        return view('app.cliente.index', ['clientes' => $clientes, 'request' => $request->all()]);
    }

    /**
     * Pagina para criar um cliente
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        return view('app.cliente.create');
    }

    /**
     * Recebe o request para criar um cliente
     * @param \App\Http\Requests\ClienteRequest $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function store(ClienteRequest $request)
    {
        try {
            $this->request = $request;

            $this->cliente = new Cliente();

            $this->criaOuAtualizaCliente();

            return redirect()->route('cliente.index')->with('success', 'Cliente cadastrado com sucesso!');
        } catch (CreateClienteException $e) {
            return $e->render();
        } catch (Exception $e) {
            return ErrorUnexpectedException::render();
        }
    }

    /**
     * Cria um cliente
     * @param bool $atualizar
     * @return void
     */
    private function criaOuAtualizaCliente($atualizar = false)
    {
        try {
            $this->cliente->nome = $this->request->input('nome');
            $this->cliente->email = $this->request->input('email');
            $this->cliente->observacoes = $this->request->input('observacoes');
            $this->cliente->empresa_id = auth()->user()->id;
            $this->cliente->save();
        } catch (\Throwable $th) {
            if ($atualizar) {
                throw new ClienteUpdateException();
            } else {
                throw new CreateClienteException();
            }
        }
    }

    /**
     * Pagina para editar um cliente recebendo um ID criptografado como parametro
     * @param mixed $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit($id)
    {
        try {
            $id = Crypt::decrypt($id);

            $this->getCliente($id);

            $cliente = $this->cliente;

            return view('app.cliente.create', compact('cliente'));
        } catch (ClienteNotFoundException $e) {
            return $e->render();
        } catch (Exception $th) {
            return ErrorUnexpectedException::render();
        }
    }

    /**
     * Busca um cliente pelo ID
     * @param mixed $id
     * @return void
     */
    private function getCliente($id)
    {
        $cliente = Cliente::find($id);
        if ($cliente) {
            $this->cliente = $cliente;
        } else {
            throw new ClienteNotFoundException();
        }
    }

    /**
     * Recebe o request e um ID para editar um cliente
     * @param \App\Http\Requests\ClienteRequest $request
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ClienteRequest $request, $id)
    {
        try {
            $id = Crypt::decrypt($id);

            $this->request = $request;

            $this->getCliente($id);

            $this->criaOuAtualizaCliente(true);

            return redirect()->back()->with('success', 'Cliente atualizado com sucesso!');
        } catch (ClienteNotFoundException $e) {
            return $e->render();
        } catch (ClienteUpdateException $e) {
            return $e->render();
        } catch (Exception $th) {
            return ErrorUnexpectedException::render();
        }
    }

    /**
     * Recebe um ID para deletar um cliente
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $id = Crypt::decrypt($id);

            $this->getCliente($id);

            $this->deletarCliente();

            return redirect()->back()->with('success', 'Cliente deletado com sucesso!');
        } catch (ClienteDeleteException $e) {
            return $e->render();
        } catch (ClienteNotFoundException $e) {
            return $e->render();
        } catch (Exception $th) {
            return ErrorUnexpectedException::render();
        }
    }

    /**
     * Deleta um cliente
     * @return void
     */
    private function deletarCliente()
    {
        try {
            $this->cliente->delete();
        } catch (\Throwable $th) {
            throw new ClienteDeleteException();
        }
    }
}
