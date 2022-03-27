<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function Contato(){
        var_dump($_POST);
        return view('site.contato'); //retorne a view que esta na pasta 'site' com nome de 'contato'
    }
}
