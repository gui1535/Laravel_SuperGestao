<?php

namespace App\Exceptions;

use Exception;

class PedidoDeleteException extends Exception
{
  /**
     * Render Exception
     */
    public function render()
    {
        return back()->withErrors(["Ocorreu um erro ao deletar o pedido, tente novamente mais tarde"])->withInput();
    }
}
