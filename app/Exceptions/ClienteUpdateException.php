<?php

namespace App\Exceptions;

use Exception;

class ClienteUpdateException extends Exception
{
  /**
     * Render Exception
     */
    public function render()
    {
        return back()->withErrors(["Ocorreu um erro ao atualizar o cliente, tente novamente mais tarde"])->withInput();
    }
}
