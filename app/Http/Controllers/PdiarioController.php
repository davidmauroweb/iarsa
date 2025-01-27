<?php

namespace App\Http\Controllers;

use App\Models\{pdiario,equipos,obras};
use App\Exports\exportpd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

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
        ->orderByDesc('pdiarios.fecha')
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
        $nuevo->hist = $Actual->max - $ncontrol;
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

    public function showmnt(Request $request)
    // toma $request['b']={'o','e'} segun el tipo de filtro o=obra, e=equipo
    {
        if($request->b == 'e'){
        $partes = DB::table('pdiarios')
            ->select('pdiarios.fecha','pdiarios.horas','pdiarios.hist','pdiarios.combustible','pdiarios.aceite','pdiarios.lubricante','pdiarios.obs','equipos.codigo','equipos.max','equipos.control','obras.nombre','items.item','users.name')
            ->join('equipos','pdiarios.equipo','equipos.id')
            ->join('obras','pdiarios.obra','obras.id')
            ->join('users','pdiarios.usuario','users.id')
            ->join('items','pdiarios.item','items.id')
            ->where('pdiarios.equipo','=',$request->id)
            ->orderByDesc('pdiarios.fecha')
            ->paginate(15);
        $equipo = DB::table('equipos')->where('id','=',$request->id)->first();
        $titulo = " Equipo Cod.:<b>".$equipo->codigo."</b> Marca:<b>".$equipo->marca."</b> Patente:<b>".$equipo->patente."</b>";
        }else{
            $partes = DB::table('pdiarios')
            ->select('pdiarios.fecha','pdiarios.horas','pdiarios.hist','pdiarios.combustible','pdiarios.aceite','pdiarios.lubricante','pdiarios.obs','equipos.codigo','equipos.max','equipos.control','obras.nombre','items.item','users.name')
            ->join('equipos','pdiarios.equipo','equipos.id')
            ->join('obras','pdiarios.obra','obras.id')
            ->join('users','pdiarios.usuario','users.id')
            ->join('items','pdiarios.item','items.id')
            ->where('pdiarios.obra','=',$request->id)
            ->orderByDesc('pdiarios.fecha')
            ->paginate(15);
        $obra = DB::table('obras')->where('id','=',$request->id)->first();
        $titulo = " Obra:<b>".$obra->nombre."</b> Licitación:<b>".$obra->licitacion."</b> Inicio:<b>".$obra->inicio."</b> Plazo:<b>".$obra->plazo." meses</b>";
        }
        return view('lspdmnt',['partes'=>$partes, 'titulo'=>$titulo, 'acc'=>$request->b,'idex'=>$request->id]);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function exportpd($pd)
    {
        list($acc,$id)=explode("|",$pd);
        if ($acc=="e"){
            $equipo = DB::table('equipos')->select('codigo')->where('id','=',$id)->first();
            $fn=$equipo->codigo."-".date('Y-m-d');
        }else{
            $obra = DB::table('obras')->select('nombre')->where('id','=',$id)->first();
            $fn=$obra->nombre."-".date('Y-m-d');
        }
        return Excel::download(new exportpd($pd),$fn.'.xlsx');
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
