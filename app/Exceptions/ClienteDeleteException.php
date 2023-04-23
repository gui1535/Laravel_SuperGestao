<?php

namespace App\Exceptions;

use Exception;

class ClienteDeleteException extends Exception
{
  /**
     * Render Exception
     */
    public function render()
    {
        return back()->withErrors(["Ocorreu um erro ao deletar o cliente, tente novamente mais tarde"])->withInput();
    }
}
