<?php

namespace App\Http\Controllers;

use App\Exceptions\CreateProdutoDetalhesException;
use App\Exceptions\CreateProdutoException;
use App\Exceptions\ErrorUnexpectedException;
use App\Exceptions\ProdutoDeleteException;
use App\Exceptions\ProdutoDetalheNotFoundException;
use App\Exceptions\ProdutoDetalhesUpdateException;
use App\Exceptions\ProdutoNotFoundException;
use App\Exceptions\ProdutoUpdateException;
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
    /**
     * Request que será recebido
     * @var \Illuminate\Http\Request $request
     */
    private Request $request;

    /**
     * Produto
     * @var \App\Models\Produto $produto
     */
    private Produto $produto;

    /**
     * Produto Detalhe
     * @var \App\Models\ProdutoDetalhe $produtoDetalhe
     */
    private ProdutoDetalhe $produtoDetalhe;

    /**
     * Index da pagina de produto
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(Request $request)
    {
        $produtos = Produto::paginate(10);

        return view('app.produto.index', ['produtos' => $produtos, 'request' => $request->all()]);
    }

    /**
     * Pagina para criar um cliente
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        $unidades = Unidade::all();
        $fornecedores = Fornecedor::all();
        return view('app.produto.create', ['unidades' => $unidades, 'fornecedores' => $fornecedores]);
    }

    /**
     * Recebe o request para criar um produto
     * @param \App\Http\Requests\ProdutoRequest $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function store(ProdutoRequest $request)
    {

        try {
            $this->request = $request;

            $this->produto = new Produto();

            $this->criaOuAtualizaProduto();

            $this->produtoDetalhe = new ProdutoDetalhe();

            $this->criaOuAtualizaProdutoDetalhe();

            return redirect()->route('produto.index')->with('success', 'Produto cadastrado com sucesso!');
        } catch (CreateProdutoException $e) {
            return $e->render();
        } catch (CreateProdutoDetalhesException $e) {
            return $e->render();
        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * Cria ou atualiza um produto
     * @param bool $atualizar
     * @return void
     */
    private function criaOuAtualizaProduto($atualizar = false)
    {
        try {
            $this->preencheProdutoPeloRequest();
            $this->produto->save();
        } catch (\Throwable $th) {
            if ($atualizar) {
                throw new ProdutoUpdateException();
            } else {
                throw new CreateProdutoException();
            }
        }
    }

    /**
     * Cria ou atualiza os detalhes de um produto
     * @param bool $atualizar
     * @return void
     */
    private function criaOuAtualizaProdutoDetalhe($atualizar = false)
    {
        try {
            $this->preencheProdutoDetalhePeloRequest();
            $this->produtoDetalhe->save();
        } catch (\Throwable $th) {
            if ($atualizar) {
                throw new ProdutoDetalhesUpdateException();
            } else {
                throw new CreateProdutoDetalhesException();
            }
        }
    }

    /**
     * Preenche os detalhes do produto pelo que foi recebido no request
     * @return void
     */
    private function preencheProdutoDetalhePeloRequest()
    {
        $this->produtoDetalhe->produto_id = $this->produto->id;
        $this->produtoDetalhe->comprimento = $this->request->input('comprimento');
        $this->produtoDetalhe->largura = $this->request->input('largura');
        $this->produtoDetalhe->peso = $this->request->input('peso');
        $this->produtoDetalhe->altura = $this->request->input('altura');
        $this->produtoDetalhe->preco_venda = precoBrlParaDecimal($this->request->input('preco'));
        $this->produtoDetalhe->estoque_minimo = $this->request->input('estoque_minimo');
        $this->produtoDetalhe->estoque_maximo = $this->request->input('estoque_maximo');
        $this->produtoDetalhe->unidade_id = $this->request->input('unidade');
    }

    /**
     * Preenche o produto pelo que foi recebido no request
     * @return void
     */
    private function preencheProdutoPeloRequest()
    {
        $this->produto->nome = $this->request->input('nome');
        $this->produto->descricao = $this->request->input('descricao');
        $this->produto->fornecedor_id = $this->request->input('fornecedor');
        $this->produto->empresa_id = auth()->user()->id;
    }

    /**
     * Pagina para editar um produto recebendo um ID criptografado como parametro
     * @param mixed $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit($id)
    {
        try {
            $id = Crypt::decrypt($id);

            $this->getProduto($id);

            $unidades = Unidade::all();

            $fornecedores = Fornecedor::all();

            return view('app.produto.create', ['unidades' => $unidades, 'fornecedores' => $fornecedores, 'produto' => $this->produto]);
        } catch (ProdutoNotFoundException $e) {
            return $e->render();
        } catch (Exception $th) {
            return ErrorUnexpectedException::render();
        }
    }

    /**
     * Recebe o request e um ID para editar um produto
     * @param \App\Http\Requests\ProdutoRequest $request
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProdutoRequest $request, $id)
    {
        try {
            $id = Crypt::decrypt($id);

            $this->request = $request;

            $this->getProduto($id);

            $this->getProdutoDetalhe();

            $this->criaOuAtualizaProduto(true);

            $this->criaOuAtualizaProdutoDetalhe(true);

            return redirect()->back()->with('success', 'Produto atualizado com sucesso!');
        } catch (ProdutoNotFoundException $e) {
            return $e->render();
        } catch (ProdutoUpdateException $e) {
            return $e->render();
        } catch (ProdutoDetalhesUpdateException $e) {
            return $e->render();
        } catch (ProdutoDetalheNotFoundException $e) {
            return $e->render();
        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * Recebe um ID para deletar um produto
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
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

    /**
     * Busca um produto pelo ID
     * @param mixed $id
     * @return void
     */
    private function getProduto($id)
    {
        $produto = Produto::find($id);
        if ($produto) {
            $this->produto = $produto;
        } else {
            throw new ProdutoNotFoundException();
        }
    }

    /**
     * Deleta um produto
     * @return void
     */
    private function deletarProduto()
    {
        try {
            $this->produto->delete();
        } catch (\Throwable $th) {
            throw new ProdutoDeleteException();
        }
    }

    /**
     * Busca um produto pelo id do produto
     * @return void
     */
    private function getProdutoDetalhe()
    {
        $produtoDetalhe = ProdutoDetalhe::where('produto_id', $this->produto->id)->first();
        if ($produtoDetalhe) {
            $this->produtoDetalhe = $produtoDetalhe;
        } else {
            throw new ProdutoDetalheNotFoundException();
        }
    }
}
