<?php

namespace App\Exceptions;

use Exception;

class CreateUsuarioEmpresaException extends Exception
{
    /**
     * Render Exception
     */
    public function render()
    {
        return back()->withErrors(["Ocorreu um erro ao criar o usuário da empresa, tente novamente mais tarde"])->withInput();
    }
}
