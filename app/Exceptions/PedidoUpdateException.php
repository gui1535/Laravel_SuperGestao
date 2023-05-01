<?php

namespace App\Exceptions;

use Exception;

class PedidoUpdateException extends Exception
{
    /**
     * Render Exception
     */
    public function render()
    {
        return back()->withErrors(["Ocorreu um erro ao atualizar o pedido, tente novamente mais tarde"])->withInput();
    }
}
