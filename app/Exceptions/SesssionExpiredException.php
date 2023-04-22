<?php

namespace App\Exceptions;

use Exception;

class SesssionExpiredException extends Exception
{
    /**
     * Render Exception
     */
    public function render()
    {
        return back()->withErrors(["Sua sessão foi expirada, faça login novamente"])->withInput();
    }
}
