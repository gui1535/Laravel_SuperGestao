<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrincipalController extends Controller
{
    //
    public function Principal(){
        return view('site.principal'); //retorne a view que esta na pasta 'site' com nome de 'principal'
    }
}
