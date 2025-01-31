<?php

namespace App\Exports;

use App\Models\equipos;
use Maatwebsite\Excel\Concerns\{FromView,ShouldAutoSize};
use Illuminate\Contracts\View\View;

class eqxls implements FromView,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view():View
    {
        $eqs = equipos::orderBy('codigo')
                ->get();
        return view('eqxls',['eqs'=>$eqs]);
    }
}
