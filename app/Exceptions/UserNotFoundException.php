<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class UserNotFoundException extends Exception
{

    /**
     * Render Exception
     */
    public function render()
    {
        return back()->withErrors(["Usuário não encontrado"])->withInput();
    }
}
