<?php

namespace App\Exceptions;

use Exception;

class FornecedorDeleteException extends Exception
{
  /**
     * Render Exception
     */
    public function render()
    {
        return back()->withErrors(["Ocorreu um erro ao deletar o fornecedor, tente novamente mais tarde"])->withInput();
    }
}
