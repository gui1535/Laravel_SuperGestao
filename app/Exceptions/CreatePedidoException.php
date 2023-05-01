<?php

namespace App\Exceptions;

use Exception;

class CreatePedidoException extends Exception
{
    /**
     * Render Exception
     */
    public function render()
    {
        return back()->withErrors(["Ocorreu um erro ao criar o pedido, tente novamente mais tarde"])->withInput();
    }
}
