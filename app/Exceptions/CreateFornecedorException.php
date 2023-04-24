<?php

namespace App\Exceptions;

use Exception;

class CreateFornecedorException extends Exception
{
  /**
     * Render Exception
     */
    public function render()
    {
        return back()->withErrors(["Ocorreu um erro ao criar o fornecedor, tente novamente mais tarde"])->withInput();
    }
}
