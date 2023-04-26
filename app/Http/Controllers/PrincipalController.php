<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MotivoContato;

class PrincipalController extends Controller
{
    /**
     * Pagina principal
     * @return \Illuminate\Contracts\View\View
     */
    public function principal()
    {

        $motivo_contatos = MotivoContato::all();

        return view('site.principal', ['motivo_contatos' => $motivo_contatos]);
    }
}
