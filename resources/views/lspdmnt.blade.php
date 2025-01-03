@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">Lista de Partes de : @php echo $titulo @endphp</div>

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
                            <th>Obra</th>
                            <th>Equipo</th>
                            <th>Item</th>
                            <th>Horas</th>
                            <th>Resto</th>
                            <th>Comb.</th>
                            <th>Aceite</th>
                            <th>Lub</th>
                            <th>Obs</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($partes as $p)
                        <tr>
                            <td>{{$p->fecha}}</td>
                            <td>{{$p->name}}</td>
                            <td>{{$p->nombre}}</td>
                            <td>{{$p->codigo}}</td>
                            <td>{{$p->item}}</td>
                            <td>{{$p->horas}}</td>
                            <td>@php echo $p->max - $p->control @endphp</td>
                            <td>{{$p->combustible}}</td>
                            <td>{{$p->aceite}}</td>
                            <td>{{$p->lubricante}}</td>
                            <td>{{$p->obs}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
