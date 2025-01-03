<?php

namespace App\Http\Controllers;

use App\Models\{equipos};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EquiposController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('adm');
//    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $obras = DB::table('obras')->select('nombre','id')->orderBy('nombre')->get();
        $equipos = DB::table('equipos')->simplePaginate(10);
        return view('lsequipos', ['equipos'=>$equipos, 'obras'=>$obras]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function nuevo(Request $request)
    {
        if(!$request->activo){
            $request->activo=0;
        }else{
            $request->activo=1;
        }
        $nuevo = new equipos();
        $nuevo->marca = $request->marca;
        $nuevo->codigo = $request->codigo;
        $nuevo->tipo = $request->tipo;
        $nuevo->modelo = $request->modelo;
        $nuevo->potencia = $request->potencia;
        $nuevo->patente = $request->patente;
        $nuevo->activo = $request->activo;
        $nuevo->max = $request->max;
        $nuevo->control = $request->control;
        $nuevo->save();
        return redirect()->route('lsequipos')->with('mensajeOk',$nuevo->codigo.' Se cargó correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(equipos $equipos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        if(!$request->activo){
            $request->activo=0;
        }else{
            $request->activo=1;
        }
        $nuevo = equipos::find($request->id);
        $nuevo->marca = $request->marca;
        $nuevo->codigo = $request->codigo;
        $nuevo->tipo = $request->tipo;
        $nuevo->modelo = $request->modelo;
        $nuevo->potencia = $request->potencia;
        $nuevo->patente = $request->patente;
        $nuevo->activo = $request->activo;
        $nuevo->max = $request->max;
        $nuevo->control = $request->control;
        $nuevo->save();
        $param = "page=".$request->pg;
        return redirect()->route('lsequipos',$param)->with('mensajeOk',$nuevo->codigo.' Se modificó correctamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, equipos $equipos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(equipos $equipos)
    {
        //
    }
}
