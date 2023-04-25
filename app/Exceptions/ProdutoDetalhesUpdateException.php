<?php

namespace App\Exceptions;

use Exception;

class ProdutoDetalhesUpdateException extends Exception
{
  /**
     * Render Exception
     */
    public function render()
    {
        return back()->withErrors(["Ocorreu um erro ao atualizar os detalhes do produto, tente novamente mais tarde"])->withInput();
    }
}
