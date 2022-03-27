<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SobreNosController extends Controller
{
    public function SobreNos(){
        return view('site.sobrenos'); //retorne a view que esta na pasta 'site' com nome de 'sobrenos'
    }
}
