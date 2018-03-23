<?php

namespace Casa\Http\Controllers;

use Illuminate\Http\Request;

class AcessoNegadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        return view('acesso-negado.index');
    }
}
