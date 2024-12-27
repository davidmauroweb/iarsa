<?php

namespace App\Http\Controllers;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        switch (Auth::user()->rol){
            case('mnt'):
                return redirect()->route('lsequipos');
            case('obr'):
                return redirect()->route('lsobra');
            case('cnt'):
                return redirect()->route('lsus');
            case('opr'):
                return redirect()->route('homeopr');
            default:
                return view('home');
        }
        
    }
}
