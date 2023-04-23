<?php

namespace App\Exceptions;

use Exception;

class CreateClienteException extends Exception
{
  /**
     * Render Exception
     */
    public function render()
    {
        return back()->withErrors(["Ocorreu um erro ao criar o cliente, tente novamente mais tarde"])->withInput();
    }
}
