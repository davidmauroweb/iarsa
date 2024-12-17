<?php

namespace App\Http\Controllers;

use App\Models\comitentes;
use Illuminate\Http\Request;

class ComitentesController extends Controller
{
    public function __construct()
    {
        $this->middleware('adm');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos = comitentes::all();
        return view('lscomitentes', ['comit'=>$datos]);
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
        $nuevo = new comitentes();
        $nuevo->comitente=$request['name'];
        $nuevo->save();
        return redirect()->route('lscomitentes')->with('mensajeOk',$nuevo->comitente.' Se cargó correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(comitentes $comitentes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request){
        if(!$request->activo){
            $request->activo=0;
        }else{
            $request->activo=1;
        }
        $upd = comitentes::find($request->id);
        $upd->comitente = $request->name;
        $upd->activo = $request->activo;
        $upd->save();
        return redirect()->route('lscomitentes')->with('mensajeOk',$upd->comitente.' Se modificó correctamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, comitentes $comitentes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(comitentes $comitentes)
    {
        //
    }
}
