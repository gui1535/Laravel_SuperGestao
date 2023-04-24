<?php

namespace App\Exceptions;

use Exception;

class CreateProdutoException extends Exception
{
  /**
     * Render Exception
     */
    public function render()
    {
        return back()->withErrors(["Ocorreu um erro ao criar o produto, tente novamente mais tarde"])->withInput();
    }
}
