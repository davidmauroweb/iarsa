<?php

namespace App\Http\Controllers;

use App\Models\{items,obras};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemsController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('adm');
//    }
    /**
     * Display a listing of the resource.
     */
    public function index(obras $obra)
    {
        $items = DB::table('items')->select('items.*')->where('obra','=',$obra->id)->orderBy('numero')->paginate(10);
        return view('lsitems', ['items'=>$items, 'obra'=>$obra]);
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
        /*Separar el text area con explode(PHP_EOL, $txt);
        foreach(explode(PHP_EOL,$request->nombre) as $row)
*/
        $todos = explode(PHP_EOL,$request->nombre);
        foreach($todos as $item){
            $vector = explode('_',$item);
            $nuevo = new items();
            $nuevo->obra=$request->obra;
            $nuevo->numero = $vector[0];
            $nuevo->item = $vector[1];
            $nuevo->unidad = $vector[2];
            $nuevo->cantidad = $vector[3];
            $nuevo->save();
        }
        return redirect()->route('lsitems',$request->obra)->with('mensajeOk',' Items agregados.');
    }

    /**
     * Display the specified resource.
     */
    public function show(items $items)
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
        $nuevo = items::find($request->id);
        $nuevo->item = $request->nombre;
        $nuevo->activo = $request->activo;
        $nuevo->save();
        return redirect()->route('lsitems',$request->obra)->with('mensajeOk',$nuevo->item.' Se modificó correctamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, items $items)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(items $items)
    {
        //
    }
}
