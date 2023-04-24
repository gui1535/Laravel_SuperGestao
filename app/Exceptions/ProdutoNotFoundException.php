<?php

namespace App\Exceptions;

use Exception;

class ProdutoNotFoundException extends Exception
{
  /**
     * Render Exception
     */
    public function render()
    {
        return back()->withErrors(["Produto não encontrado"])->withInput();
    }
}
