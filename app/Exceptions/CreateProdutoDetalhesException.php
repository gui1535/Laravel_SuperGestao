<?php

namespace App\Exceptions;

use Exception;

class CreateProdutoDetalhesException extends Exception
{
  /**
     * Render Exception
     */
    public function render()
    {
        return back()->withErrors(["Ocorreu um erro ao criar os detalhes produto, tente novamente mais tarde"])->withInput();
    }
}
