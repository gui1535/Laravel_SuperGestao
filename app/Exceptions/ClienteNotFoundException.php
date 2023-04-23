<?php

namespace App\Exceptions;

use Exception;

class ClienteNotFoundException extends Exception
{
   /**
     * Render Exception
     */
    public function render()
    {
        return back()->withErrors(["Cliente não encontrado"])->withInput();
    }
}
