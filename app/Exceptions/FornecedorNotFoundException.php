<?php

namespace App\Exceptions;

use Exception;

class FornecedorNotFoundException extends Exception
{
   /**
     * Render Exception
     */
    public function render()
    {
        return back()->withErrors(["Fornecedor não encontrado"])->withInput();
    }
}
