<?php

namespace App\Exceptions;

use Exception;

class PedidoProdutosUpdateException extends Exception
{
    /**
     * Render Exception
     */
    public function render()
    {
        return back()->withErrors(["Ocorreu um erro ao atualizar os produtos do pedido, tente novamente mais tarde"])->withInput();
    }
}
