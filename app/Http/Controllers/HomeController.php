<?php

namespace Casa\Http\Controllers;
use Mail;
use Casa\Mail\Product;
use Illuminate\Mail\Mailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller 
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() 
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        /*
            $user = auth()->user();

            Mail::to($user)->send(new Product($user));
        */
        return view('home');

    }
}
