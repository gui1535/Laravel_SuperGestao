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
    private Request $request;
    private Cliente $cliente;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clientes = Cliente::paginate(10);
        return view('app.cliente.index', ['clientes' => $clientes, 'request' => $request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteRequest $request)
    {
        try {
            $this->request = $request;

            $this->criaCliente();

            return redirect()->route('cliente.index')->with('success', 'Cliente cadastrado com sucesso!');
        } catch (CreateClienteException $e) {
            return $e->render();
        } catch (Exception $e) {
            return ErrorUnexpectedException::render();
        }
    }

    private function criaCliente()
    {
        try {
            $this->cliente = new Cliente();
            $this->cliente->nome = $this->request->input('nome');
            $this->cliente->email = $this->request->input('email');
            $this->cliente->observacoes = $this->request->input('observacoes');
            $this->cliente->empresa_id = auth()->user()->id;
            $this->cliente->save();
        } catch (\Throwable $th) {
            throw new CreateClienteException();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteRequest $request, $id)
    {
        try {
            $id = Crypt::decrypt($id);

            $this->request = $request;

            $this->getCliente($id);

            $this->updateCliente();

            return redirect()->back()->with('success', 'Cliente atualizado com sucesso!');
        } catch (ClienteNotFoundException $e) {
            return $e->render();
        } catch (ClienteUpdateException $e) {
            return $e->render();
        } catch (Exception $th) {
            return ErrorUnexpectedException::render();
        }
    }

    private function updateCliente()
    {
        try {
            $this->cliente->nome = $this->request->input('nome');
            $this->cliente->email = $this->request->input('email');
            $this->cliente->observacoes = $this->request->input('observacoes');
            $this->cliente->save();
        } catch (\Throwable $th) {
            throw new ClienteUpdateException();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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

    private function deletarCliente()
    {
        try {
            $this->cliente->delete();
        } catch (\Throwable $th) {
            throw new ClienteDeleteException();
        }
    }
}
