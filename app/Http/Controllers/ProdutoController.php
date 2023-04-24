<?php

namespace App\Http\Controllers;

use App\Exceptions\CreateProdutoException;
use App\Exceptions\ErrorUnexpectedException;
use App\Exceptions\ProdutoDeleteException;
use App\Exceptions\ProdutoNotFoundException;
use App\Http\Requests\ProdutoRequest;
use App\Models\Produto;
use App\Models\Item;
use App\Models\ProdutoDetalhe;
use App\Models\Unidade;
use App\Models\Fornecedor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProdutoController extends Controller
{

    private Request $request;
    private Produto $produto;
    private ProdutoDetalhe $produtoDetalhe;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $produtos = Produto::paginate(10);

        return view('app.produto.index', ['produtos' => $produtos, 'request' => $request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unidades = Unidade::all();
        $fornecedores = Fornecedor::all();
        return view('app.produto.create', ['unidades' => $unidades, 'fornecedores' => $fornecedores]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdutoRequest $request)
    {

        try {
            $this->request = $request;

            $this->criaProduto();

            $this->criaProdutoDetalhe();

            return redirect()->route('produto.index')->with('success', 'Produto cadastrado com sucesso!');
        } catch (CreateProdutoException $e) {
            return $e->render();
        } catch (Exception $e) {
            return $e;
        }
    }

    private function criaProduto()
    {
        try {
            $this->produto = new Produto();
            $this->produto->nome = $this->request->input('nome');
            $this->produto->descricao = $this->request->input('descricao');
            $this->produto->fornecedor_id = $this->request->input('fornecedor');
            $this->produto->empresa_id = auth()->user()->id;
            $this->produto->save();
        } catch (\Throwable $th) {
            // throw new CreateProdutoException();
        }
    }

    private function criaProdutoDetalhe()
    {
        // try {
        $preco =  $this->request->input('preco');
        if ($preco) {
            $preco = str_replace(".", "", $preco);
            $preco = str_replace(",", ".", $preco);
            $preco = floatval($preco);
        }
        $this->produtoDetalhe = new ProdutoDetalhe();
        $this->produtoDetalhe->produto_id = $this->produto->id;
        $this->produtoDetalhe->comprimento = $this->request->input('comprimento');
        $this->produtoDetalhe->largura = $this->request->input('largura');
        $this->produtoDetalhe->peso = $this->request->input('peso');
        $this->produtoDetalhe->altura = $this->request->input('altura');
        $this->produtoDetalhe->preco_venda = $preco ? number_format($preco, 2, '.', '') :null;
        $this->produtoDetalhe->estoque_minimo = $this->request->input('estoque_minimo');
        $this->produtoDetalhe->unidade_id = $this->request->input('unidade');
        $this->produtoDetalhe->save();
        // } catch (\Throwable $th) {
        //     // throw new CreateProdutoException();
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        return view('app.produto.show', ['produto' => $produto]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        $unidades = Unidade::all();
        $fornecedores = Fornecedor::all();
        return view('app.produto.edit', ['produto' => $produto, 'unidades' => $unidades, 'fornecedores' => $fornecedores]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $regras = [
            'nome' => 'required|min:3|max:40',
            'descricao' => 'required|min:3|max:2000',
            'peso' => 'required|integer',
            'unidade_id' => 'exists:unidades,id',
            'fornecedor_id' => 'exists:fornecedores,id'
        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido',
            'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
            'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',
            'descricao.min' => 'O campo descrição deve ter no mínimo 3 caracteres',
            'descricao.max' => 'O campo descrição deve ter no máximo 2000 caracteres',
            'peso.integer' => 'O campo peso deve ser um número inteiro',
            'unidade_id.exists' => 'A unidade de medida informada não existe',
            'fornecedor_id.exists' => 'O fornecedor informado não existe'
        ];

        $request->validate($regras, $feedback);

        //dd($request->all());
        $produto->update($request->all());
        return redirect()->route('produto.show', ['produto' => $produto->id]);
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

            $this->getProduto($id);

            $this->deletarProduto();

            return redirect()->back()->with('success', 'Produto deletado com sucesso!');
        } catch (ProdutoDeleteException $e) {
            return $e->render();
        } catch (ProdutoNotFoundException $e) {
            return $e->render();
        } catch (Exception $th) {
            return ErrorUnexpectedException::render();
        }
    }

    private function getProduto($id)
    {
        $produto = Produto::find($id);
        if ($produto) {
            $this->produto = $produto;
        } else {
            throw new ProdutoNotFoundException();
        }
    }

    private function deletarProduto()
    {
        try {
            $this->produto->delete();
        } catch (\Throwable $th) {
            throw new ProdutoDeleteException();
        }
    }
}
