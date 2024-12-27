<?php

namespace App\Http\Controllers;

use App\Models\{pdiario,equipos,obras};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PdiarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partes=DB::table('pdiarios')
        ->select('fecha','items.item','equipos.codigo')
        ->join('items','pdiarios.item','items.id')
        ->join('equipos','pdiarios.equipo','equipos.id')
        ->take(5)->get();
        $obras=obras::all()->where('activo','=',1);
        return view('homeoperario', ['obras'=>$obras,'partes'=>$partes]);
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
        $nuevo = new pdiario();
        $nuevo->usuario = $request->usuario_id;
        $nuevo->obra = $request->obra_id;
        $nuevo->item = $request->item_id;
        $nuevo->equipo = $request->equipo_id;
        $nuevo->fecha = $request->fecha;
        $nuevo->horas = $request->horas;
        $nuevo->combustible = $request->combustible;
        $nuevo->aceite = $request->aceite;
        $nuevo->lubricante = $request->lubricante;
        $nuevo->obs = $request->obs;
        $Actual = equipos::find($request->equipo_id);
        $ncontrol = $Actual->control + $request->horas;
        $Actual->control = $ncontrol;
        $nuevo->save();
        $Actual->save();
        return redirect()->route('homeopr')->with('mensajeOk','Parte Cargado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $obra = DB::table('obras')->select('nombre','id')->where('id','=',$request->id_obra)->first();
        $items = DB::table('items')->select('item','id')->where('obra','=',$request->id_obra)->where('activo','=',1)->get();
        $equipos = equipos::all()->where('activo','=',1);
        return view('partediario', ['obra'=>$obra, 'items'=>$items, 'equipos'=>$equipos]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pdiario $pdiario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pdiario $pdiario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pdiario $pdiario)
    {
        //
    }
}
