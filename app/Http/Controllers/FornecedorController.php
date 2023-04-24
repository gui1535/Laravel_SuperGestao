<?php

namespace App\Http\Controllers;

use App\Exceptions\CreateFornecedorException;
use App\Exceptions\ErrorUnexpectedException;
use App\Exceptions\FornecedorDeleteException;
use App\Exceptions\FornecedorNotFoundException;
use App\Exceptions\FornecedorUpdateException;
use App\Http\Requests\FornecedorRequest;
use Illuminate\Http\Request;
use App\Models\Fornecedor;
use Exception;
use Illuminate\Support\Facades\Crypt;

class FornecedorController extends Controller
{

    private Request $request;
    private Fornecedor $fornecedor;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fornecedores = Fornecedor::paginate(10);

        return view('app.fornecedor.index', ['fornecedores' => $fornecedores, 'request' => $request->all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\FornecedorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FornecedorRequest $request)
    {
        try {
            $this->request = $request;

            $this->criaFornecedor();

            return redirect()->route('fornecedor.index')->with('success', 'Fornecedor cadastrado com sucesso!');
        } catch (CreateFornecedorException $e) {
            return $e->render();
        } catch (Exception $e) {
            return ErrorUnexpectedException::render();
        }
    }


    private function criaFornecedor()
    {
        try {
            $this->fornecedor = new Fornecedor();
            $this->fornecedor->nome  = $this->request->input('nome');
            $this->fornecedor->email = $this->request->input('email');
            $this->fornecedor->uf    = $this->request->input('uf');
            $this->fornecedor->site  = $this->request->input('site');
            $this->fornecedor->empresa_id  = auth()->user()->empresa->id;
            $this->fornecedor->save();
        } catch (\Throwable $th) {
            throw new CreateFornecedorException();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.fornecedor.create');
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

            $this->getFornecedor($id);

            $fornecedor = $this->fornecedor;

            return view('app.fornecedor.create', compact('fornecedor'));
        } catch (FornecedorNotFoundException $e) {
            return $e->render();
        } catch (Exception $th) {
            return ErrorUnexpectedException::render();
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FornecedorRequest $request, $id)
    {
        try {
            $id = Crypt::decrypt($id);

            $this->request = $request;

            $this->getFornecedor($id);

            $this->updateFornecedor();

            return redirect()->back()->with('success', 'Fornecedor atualizado com sucesso!');
        } catch (FornecedorNotFoundException $e) {
            return $e->render();
        } catch (FornecedorUpdateException $e) {
            return $e->render();
        } catch (Exception $th) {
            return ErrorUnexpectedException::render();
        }
    }

    private function updateFornecedor()
    {
        try {
            $this->fornecedor->nome  = $this->request->input('nome');
            $this->fornecedor->email = $this->request->input('email');
            $this->fornecedor->uf    = $this->request->input('uf');
            $this->fornecedor->site  = $this->request->input('site');
            $this->fornecedor->save();
        } catch (\Throwable $th) {
            throw new FornecedorUpdateException();
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

            $this->getFornecedor($id);

            $this->deletarCliente();

            return redirect()->back()->with('success', 'Fornecedor deletado com sucesso!');
        } catch (FornecedorDeleteException $e) {
            return $e->render();
        } catch (FornecedorNotFoundException $e) {
            return $e->render();
        } catch (Exception $th) {
            return ErrorUnexpectedException::render();
        }
    }

    private function getFornecedor($id)
    {
        $fornecedor = Fornecedor::find($id);
        if ($fornecedor) {
            $this->fornecedor = $fornecedor;
        } else {
            throw new FornecedorNotFoundException();
        }
    }

    private function deletarCliente()
    {
        try {
            $this->fornecedor->delete();
        } catch (\Throwable $th) {
            throw new FornecedorDeleteException();
        }
    }
}
