<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class lsusers extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('adm');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function lista()
    {
        $lsus = User::all();
        return view('lsusers', ['usr'=>$lsus]);
    }
    public function nus(Request $request)
    {
        $add = new User();
        $add->nombre_p = $request->nombre_p;
        $add->dir_p = $request->dir_p;
        $add->tel_p = $request->tel_p;
        $add->cuit_p = $request->cuit_p;
        $add->save();
        return redirect()->route('lsus')->with('mensajeOk',$request->nombre_p.' Se cargó correctamente.');
    }
}
