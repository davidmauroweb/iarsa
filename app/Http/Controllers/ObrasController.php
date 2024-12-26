<?php

namespace App\Http\Controllers;

use App\Models\{obras,comitentes};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ObrasController extends Controller
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
        $comitentes = comitentes::all()->where('activo','=',1);
        $obras = DB::table('obras')
            ->select('obras.*','comitentes.comitente as ncomi')
            ->join('comitentes', 'obras.comitente', 'comitentes.id')
            ->orderByDesc('id')
            ->simplePaginate(10);
        return view('lsobras', ['obras'=>$obras, 'comit'=>$comitentes]);
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
        $nuevo = new obras();
        $nuevo->nombre = $request->nombre;
        $nuevo->licitacion = $request->licitacion;
        $nuevo->comitente = $request->comitente;
        $nuevo->plazo = $request->plazo;
        $nuevo->inicio = $request->inicio;
        $nuevo->save();
        return redirect()->route('lsobras')->with('mensajeOk',$request->nombre.' Se cargó correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(obras $obras)
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
        $nuevo = obras::find($request->id);
        $nuevo->nombre = $request->nombre;
        $nuevo->licitacion = $request->licitacion;
        $nuevo->comitente = $request->comitente;
        $nuevo->activo = $request->activo;
        $nuevo->save();
        $param = "page=".$request->pg;
        return redirect()->route('lsobras',$param)->with('mensajeOk',$nuevo->nombre.' Se modificó correctamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, obras $obras)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(obras $obras)
    {
        //
    }
}
