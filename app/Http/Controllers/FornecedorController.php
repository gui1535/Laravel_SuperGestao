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
    /**
     * Request que será recebido
     * @var \Illuminate\Http\Request $request
     */
    private Request $request;

    /**
     * Fornecedor
     * @var \App\Models\Fornecedor $fornecedor
     */
    private Fornecedor $fornecedor;

    /**
     * Index da pagina de fornecedores
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(Request $request)
    {
        $fornecedores = Fornecedor::paginate(10);

        return view('app.fornecedor.index', ['fornecedores' => $fornecedores, 'request' => $request->all()]);
    }

    /**
     * Recebe o request para criar um fornecedor
     * @param \App\Http\Requests\FornecedorRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FornecedorRequest $request)
    {
        try {
            $this->request = $request;

            $this->fornecedor = new Fornecedor();

            $this->criaOuAtualizaFornecedor();

            return redirect()->route('fornecedor.index')->with('success', 'Fornecedor cadastrado com sucesso!');
        } catch (CreateFornecedorException $e) {
            return $e->render();
        } catch (Exception $e) {
            return ErrorUnexpectedException::render();
        }
    }

    /**
     * Cria ou atualiza um fornecedor
     * @return void
     */
    private function criaOuAtualizaFornecedor($atualizar = false)
    {
        try {
            $this->preencheFornecedorPeloRequest();
            $this->fornecedor->save();
        } catch (\Throwable $th) {
            if ($atualizar) {
                throw new FornecedorUpdateException();
            } else {
                throw new CreateFornecedorException();
            }
        }
    }

    /**
     * Preenche o fornecedor pelo que foi recebido no request
     * @return void
     */
    private function preencheFornecedorPeloRequest()
    {
        $this->fornecedor->nome  = $this->request->input('nome');
        $this->fornecedor->email = $this->request->input('email');
        $this->fornecedor->uf    = $this->request->input('uf');
        $this->fornecedor->site  = $this->request->input('site');
        $this->fornecedor->empresa_id  = auth()->user()->empresa->id;
    }

    /**
     * Pagina para criar um fornecedor
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        return view('app.fornecedor.create');
    }

    /**
     * Pagina para editar um fornecedor recebendo um ID criptografado como parametro
     * @param mixed $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
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
     * Recebe o request e um ID para editar um fornecedor
     * @param \App\Http\Requests\FornecedorRequest $request
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
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

    /**
     * Recebe um ID para deletar um fornecedor
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
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

    /**
     * Busca um fornecedor pelo ID
     * @param mixed $id
     * @return void
     */
    private function getFornecedor($id)
    {
        $fornecedor = Fornecedor::find($id);
        if ($fornecedor) {
            $this->fornecedor = $fornecedor;
        } else {
            throw new FornecedorNotFoundException();
        }
    }

    /**
     * Deleta um fornecedor
     * @return void
     */
    private function deletarCliente()
    {
        try {
            $this->fornecedor->delete();
        } catch (\Throwable $th) {
            throw new FornecedorDeleteException();
        }
    }
}
