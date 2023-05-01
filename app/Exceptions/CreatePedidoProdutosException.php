<?php

namespace App\Exceptions;

use Exception;

class CreatePedidoProdutosException extends Exception
{
    /**
     * Render Exception
     */
    public function render()
    {
        return back()->withErrors(["Ocorreu um erro ao cadastrar os produtos do pedido, tente novamente mais tarde"])->withInput();
    }
}
