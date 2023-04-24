<?php

namespace App\Exceptions;

use Exception;

class FornecedorUpdateException extends Exception
{
  /**
     * Render Exception
     */
    public function render()
    {
        return back()->withErrors(["Ocorreu um erro ao atualizar o fornecedor, tente novamente mais tarde"])->withInput();
    }
}
