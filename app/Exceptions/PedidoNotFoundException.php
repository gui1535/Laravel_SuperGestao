<?php

namespace App\Exceptions;

use Exception;

class PedidoNotFoundException extends Exception
{
    /**
     * Render Exception
     */
    public function render()
    {
        return back()->withErrors(["Pedido não encontrado"])->withInput();
    }
}
