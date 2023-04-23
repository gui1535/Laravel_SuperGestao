<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorUnexpectedException;
use App\Exceptions\PedidoDeleteException;
use App\Exceptions\PedidoNotFoundException;
use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Produto;
use Exception;
use Illuminate\Support\Facades\Crypt;

class PedidoController extends Controller
{

    private Pedido $pedido;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pedidos = Pedido::paginate(10);
        return view('app.pedido.index', ['pedidos' => $pedidos, 'request' => $request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Cliente::all();
        $produtos = Produto::all();
        return view('app.pedido.create', ['clientes' => $clientes, 'produtos' => $produtos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regras = [
            'cliente_id' => 'exists:clientes,id'
        ];

        $feedback = [
            'cliente_id.exists' => 'O cliente informado não existe'
        ];

        $request->validate($regras, $feedback);

        $pedido = new Pedido();
        $pedido->cliente_id = $request->get('cliente_id');
        $pedido->save();

        return redirect()->route('pedido.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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


    private function deletarPedido()
    {
        try {
            $this->pedido->delete();
        } catch (\Throwable $th) {
            throw new PedidoDeleteException();
        }
    }

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
