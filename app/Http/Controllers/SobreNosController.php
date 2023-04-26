<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SobreNosController extends Controller
{
    /**
     * Pagina Sobre Nos
     * @return \Illuminate\Contracts\View\Vie
     */
    public function sobreNos() {
        return view('site.sobre-nos');
    }
}
