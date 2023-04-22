<?php

namespace App\Exceptions;

use Exception;

class ErrorUnexpectedException extends Exception
{
    /**
     * Render Exception
     */
    public static function render()
    {
        return back()->withErrors(["Ocorreu um erro inesperado, tente novamente mais tarde"])->withInput();
    }
}
