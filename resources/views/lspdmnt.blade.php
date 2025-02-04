@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                @php $param=$acc."|".$idex @endphp
                <div class="card-header">Lista de Partes de : @php echo $titulo @endphp <a href="{{route('exportpd',$param)}}"><i class="bi bi-filetype-xlsx text-success"></i></a></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Usuario</th>
                            @if ($acc=='e')
                            <th>Obra</th>
                            @endif
                            @if ($acc=='o')
                            <th>Equipo</th>
                            <th>Tipo</th>
                            <th>Modelo</th>
                            @endif
                            <th>Item</th>
                            <th>Horas</th>
                            <th>Fin</th>
                            <th>Service</th>
                            <th>Comb.</th>
                            <th>Aceite</th>
                            <th>Lub</th>
                            <th>Obs</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($partes as $p)
                        <tr>
                            <td>{{$p->fecha}}</td>
                            <td>{{$p->name}}</td>
                            @if ($acc=='e')
                            <td>{{$p->nombre}}</td>
                            @endif
                            @if ($acc=='o')
                            <td>{{$p->codigo}}</td>
                            <td>{{$p->tipo}}</td>
                            <td>{{$p->modelo}}</td>
                            @endif
                            <td>{{$p->item}}</td>
                            <td>{{$p->horas}}</td>
                            <td>{{$p->hist}}</td>
                            <td>@php echo $p->max - $p->control @endphp</td>
                            <td>{{$p->combustible}}</td>
                            <td>{{$p->aceite}}</td>
                            <td>{{$p->lubricante}}</td>
                            <td>{{$p->obs}}</td>
                            <td>
                            <form action="{{route('dpdiario')}}" method="post">
                            @csrf
                                <input type="hidden" name="pd_id" value="{{$p->pdid}}">
                                <input type="hidden" name="eq_id" value="{{$p->eqid}}">
                                <input type="hidden" name="horas" value="{{$p->horas}}">
                                <input type="hidden" name="b" value="{{$acc}}">
                                <input type="hidden" name="id" value="{{$idex}}">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Desea deshacer el parte de {{$p->name}}?')" title="Deshacer">
                                <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mx-3"><ul class="pagination">{{ $partes->appends(['b' => $acc,'id'=> $idex])->links() }}</ul></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
