<?php

namespace Casa\Http\Controllers;

use Illuminate\Http\Request;

class KeyboardCatController extends Controller
{
    public function index()
    {
        return view('keyboardcat.index');
    }
}
