<?php

namespace App\Exceptions;

use Exception;

class ProdutoUpdateException extends Exception
{
  /**
     * Render Exception
     */
    public function render()
    {
        return back()->withErrors(["Ocorreu um erro ao atualizar o produto, tente novamente mais tarde"])->withInput();
    }
}
