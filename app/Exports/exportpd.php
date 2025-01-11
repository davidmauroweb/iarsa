<?php

namespace App\Exports;

use App\Models\pdiario;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\{FromView,ShouldAutoSize};
use Illuminate\Contracts\View\View;

class exportpd implements FromView,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
//declara variable que toma del get
    protected $pd;

//contruye la variable según lo que recibe
    function __construct($pd) {
        $this->pd = $pd;
    }
    public function view():View
    {
        list($acc,$id)=explode("|",$this->pd);
        if($acc == 'e'){
            $partes = DB::table('pdiarios')
                ->select('pdiarios.fecha','pdiarios.horas','pdiarios.combustible','pdiarios.aceite','pdiarios.lubricante','pdiarios.obs','equipos.codigo','equipos.max','equipos.control','obras.nombre','items.item','users.name')
                ->join('equipos','pdiarios.equipo','equipos.id')
                ->join('obras','pdiarios.obra','obras.id')
                ->join('users','pdiarios.usuario','users.id')
                ->join('items','pdiarios.item','items.id')
                ->where('pdiarios.equipo','=',$id)
                ->get();
            $equipo = DB::table('equipos')->where('id','=',$id)->first();
            $titulo = " Equipo Cod.:<b>".$equipo->codigo."</b>_Marca:<b>".$equipo->marca."</b>_Patente:<b>".$equipo->patente."</b>";
            }else{
                $partes = DB::table('pdiarios')
                ->select('pdiarios.fecha','pdiarios.horas','pdiarios.combustible','pdiarios.aceite','pdiarios.lubricante','pdiarios.obs','equipos.codigo','equipos.max','equipos.control','obras.nombre','items.item','users.name')
                ->join('equipos','pdiarios.equipo','equipos.id')
                ->join('obras','pdiarios.obra','obras.id')
                ->join('users','pdiarios.usuario','users.id')
                ->join('items','pdiarios.item','items.id')
                ->where('pdiarios.obra','=',$id)
                ->get();
            $obra = DB::table('obras')->where('id','=',$id)->first();
            $titulo = " Obra:<b>".$obra->nombre."</b>_Licitación:<b>".$obra->licitacion."</b>_Inicio:<b>".$obra->inicio."</b>_Plazo:<b>".$obra->plazo." meses</b>";
            }
            return view('exportpd',['partes'=>$partes, 'titulo'=>$titulo]);
    }
}
