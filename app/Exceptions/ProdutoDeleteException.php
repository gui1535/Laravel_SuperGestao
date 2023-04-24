<?php

namespace App\Exceptions;

use Exception;

class ProdutoDeleteException extends Exception
{
  /**
     * Render Exception
     */
    public function render()
    {
        return back()->withErrors(["Ocorreu um erro ao deletar o produto, tente novamente mais tarde"])->withInput();
    }
}
