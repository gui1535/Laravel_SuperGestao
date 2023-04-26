<?php

namespace App\Exceptions;

use Exception;

class CreateContatoException extends Exception
{
  /**
     * Render Exception
     */
    public function render()
    {
        return back()->withErrors(["Ocorreu um erro ao criar o contato, tente novamente mais tarde"])->withInput();
    }
}
