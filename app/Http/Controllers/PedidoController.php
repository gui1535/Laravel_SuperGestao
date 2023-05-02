<?php

namespace App\Http\Controllers;

use App\Exceptions\CreatePedidoException;
use App\Exceptions\CreatePedidoProdutosException;
use App\Exceptions\ErrorUnexpectedException;
use App\Exceptions\PedidoDeleteException;
use App\Exceptions\PedidoNotFoundException;
use App\Exceptions\PedidoProdutosUpdateException;
use App\Exceptions\PedidoUpdateException;
use App\Http\Requests\PedidoRequest;
use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\PedidoProduto;
use App\Models\Produto;
use Exception;
use Illuminate\Support\Facades\Crypt;

class PedidoController extends Controller
{
    /**
     * Request
     * @var \Illuminate\Http\Request $request
     */
    private Request $request;

    /**
     * Pedido
     * @var \App\Models\Pedido $pedido
     */
    private Pedido $pedido;

    /**
     * Index da pagina de pedidos
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(Request $request)
    {
        $pedidos = Pedido::paginate(10);
        return view('app.pedido.index', ['pedidos' => $pedidos, 'request' => $request->all()]);
    }

    /**
     * Pagina para criar um pedido
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        $clientes = Cliente::all();
        $produtos = Produto::all();
        return view('app.pedido.create', ['clientes' => $clientes, 'produtos' => $produtos]);
    }

    /**
     * Recebe o request para criar um pedido
     * @param \App\Http\Requests\PedidoRequest $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function store(PedidoRequest $request)
    {
        try {
            $this->request = $request;

            $this->pedido = new Pedido();

            $this->criaOuAtualizaPedido();

            if ($this->request->input('produtos') && $this->request->input('quantidades')) {
                $this->criaOuAtualizaProdutosDoPedido();
            }

            return redirect()->route('pedido.index')->with('success', 'Pedido cadastrado com sucesso!');
        } catch (CreatePedidoException $e) {
            return $e->render();
        } catch (CreatePedidoProdutosException $e) {
            return $e->render();
        } catch (Exception $e) {
            return ErrorUnexpectedException::render();
        }
    }

    /**
     * Cria ou atualiza um pedido
     * @param bool $atualizar
     * @return void
     */
    private function criaOuAtualizaPedido($atualizar = false)
    {
        try {
            $this->pedido->codigo = $this->request->input('codigo');
            $this->pedido->cliente_id = $this->request->input('cliente');
            $this->pedido->empresa_id = auth()->user()->empresa->id;
            $this->pedido->save();
        } catch (\Throwable $th) {
            if ($atualizar) {
                throw new PedidoUpdateException();
            } else {
                throw new CreatePedidoException();
            }
        }
    }

    /**
     * Cria ou atualiza os produtos do pedido
     * @param bool $atualizar
     * @return void
     */
    private function criaOuAtualizaProdutosDoPedido($atualizar = false)
    {
        try {
            $pedidoDelete = PedidoProduto::query();
            $pedidoDelete->where('pedido_id', $this->pedido->id);
            foreach ($this->request->input('produtos') as $key => $prod) {
                // Decrypt ID produto
                $prod = Crypt::decrypt($prod);

                // Procura PedidoProduto
                $pedidoProduto = PedidoProduto::where('pedido_id', $this->pedido->id)->where('produto_id', $prod)->first();

                // Se não existir, criará um novo
                if (!$pedidoProduto) {
                    $pedidoProduto = new PedidoProduto();
                    $pedidoProduto->pedido_id = $this->pedido->id;
                    $pedidoProduto->produto_id = $prod;
                }
                $pedidoProduto->quantidade = $this->request->input('quantidades')[$key];
                $pedidoProduto->save();
                $pedidoDelete->where('produto_id', '<>', $prod);
            }
            $pedidoDelete->delete();
        } catch (\Throwable $th) {
            if ($atualizar) {
                throw new PedidoProdutosUpdateException();
            } else {
                throw new CreatePedidoProdutosException();
            }
        }
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

            $this->getPedido($id);

            $clientes = Cliente::all();

            $produtos = Produto::all();

            return view('app.pedido.create', ['clientes' => $clientes, 'produtos' => $produtos, 'pedido' => $this->pedido]);
        } catch (PedidoNotFoundException $e) {
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
    public function update(PedidoRequest $request, $id)
    {
        try {
            $id = Crypt::decrypt($id);

            $this->request = $request;

            $this->getPedido($id);

            $this->criaOuAtualizaPedido();

            if ($this->request->input('produtos') && $this->request->input('quantidades')) {
                $this->criaOuAtualizaProdutosDoPedido();
            }

            return redirect()->back()->with('success', 'Pedido atualizado com sucesso!');
        } catch (CreatePedidoException $e) {
            return $e->render();
        } catch (CreatePedidoProdutosException $e) {
            return $e->render();
        } catch (Exception $e) {
            return ErrorUnexpectedException::render();
        }
    }

    /**
     * Recebe um ID para deletar um pedido
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $id = Crypt::decrypt($id);

            $this->getPedido($id);

            $this->deletarPedido();

            return redirect()->back()->with('success', 'Pedido deletado com sucesso!');
        } catch (PedidoDeleteException $e) {
            return $e->render();
        } catch (PedidoNotFoundException $e) {
            return $e->render();
        } catch (Exception $th) {
            return ErrorUnexpectedException::render();
        }
    }

    /**
     * Deleta um pedido
     * @return void
     */
    private function deletarPedido()
    {
        try {
            $this->pedido->delete();
        } catch (\Throwable $th) {
            throw new PedidoDeleteException();
        }
    }

    /**
     * Busca um pedido pelo ID
     * @param mixed $id
     * @return void
     */
    private function getPedido($id)
    {
        $pedido = Pedido::find($id);
        if ($pedido) {
            $this->pedido = $pedido;
        } else {
            throw new PedidoNotFoundException();
        }
    }
}
