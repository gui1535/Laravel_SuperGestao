<?php

namespace App\Http\Controllers;

use App\Exceptions\CreateFornecedorException;
use App\Exceptions\ErrorUnexpectedException;
use App\Http\Requests\FornecedorRequest;
use Illuminate\Http\Request;
use App\Models\Fornecedor;
use Exception;

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

    public function adicionar(Request $request)
    {

        $msg = '';

        //inclusão
        if ($request->input('_token') != '' && $request->input('id') == '') {
            //validacao
            $regras = [
                'nome' => 'required|min:3|max:40',
                'site' => 'required',
                'uf' => 'required|min:2|max:2',
                'email' => 'email'
            ];

            $feedback = [
                'required' => 'O campo :attribute deve ser preenchido',
                'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
                'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',
                'uf.min' => 'O campo uf deve ter no mínimo 2 caracteres',
                'uf.max' => 'O campo uf deve ter no máximo 2 caracteres',
                'email.email' => 'O campo e-mail não foi preenchido corretamente'
            ];

            $request->validate($regras, $feedback);

            $fornecedor = new Fornecedor();
            $fornecedor->create($request->all());

            //redirect

            //dados view
            $msg = 'Cadastro realizado com sucesso';
        }

        //edição
        if ($request->input('_token') != '' && $request->input('id') != '') {
            $fornecedor = Fornecedor::find($request->input('id'));
            $update = $fornecedor->update($request->all());

            if ($update) {
                $msg = 'Atualização realizada com sucesso';
            } else {
                $msg = 'Erro ao tentar atualizar o registro';
            }

            return redirect()->route('app.fornecedor.editar', ['id' => $request->input('id'), 'msg' => $msg]);
        }

        return view('app.fornecedor.adicionar', ['msg' => $msg]);
    }

    public function editar($id)
    {

        $fornecedor = Fornecedor::find($id);

        return view('app.fornecedor.adicionar', ['fornecedor' => $fornecedor]);
    }

    public function excluir($id)
    {
        Fornecedor::find($id)->delete();
        //Fornecedor::find($id)->forceDelete();

        return redirect()->route('app.fornecedor');
    }
}
