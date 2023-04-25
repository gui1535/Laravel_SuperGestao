<?php

namespace App\Exceptions;

use Exception;

class ProdutoDetalheNotFoundException extends Exception
{
    /**
     * Render Exception
     */
    public function render()
    {
        return back()->withErrors(["Detalhes do produto não encontrado"])->withInput();
    }
}
