<?php

namespace App\Exceptions;

use Exception;

class CreateEmpresaException extends Exception
{
  /**
     * Render Exception
     */
    public function render()
    {
        return back()->withErrors(["Ocorreu um erro ao criar a empresa, tente novamente mais tarde"])->withInput();
    }
}
