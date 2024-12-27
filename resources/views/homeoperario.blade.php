@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Lista de Obras') }}
                </div>
                <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nombre</th>
                            <th>Inicio</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($obras as $u)
                        <tr>
                            <td>{{$u->id}}</td>
                            <td>{{$u->nombre}}</td>
                            <td>{{date('d/m/y', strtotime($u->inicio))}}</td>
                            <td>
                                    <form method="POST" action="{{route ('fpdiario')}}">
                                    @csrf
                                    <input type="hidden" value="{{$u->id}}" name="id_obra">
                                    <button class="btn btn-sm btn-secondary" type="submit"><i class="bi bi-list-check"></i></button>
                                    </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                <div class="card-footer">
                <table class="table table-light">
                    <thead>
                        <tr>
                            <th class="table-secondary">Ultimos 5 Partes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($partes as $p)
                        <tr>
                            <td>{{$p->fecha}} : {{$p->codigo}}<br>{{$p->item}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div><!-- CardFooter -->
                </div><!-- CardBody -->
            </div><!-- Card -->
        </div><!-- colmd8 -->
    </div><!-- justifi -->
</div><!-- container -->
@endsection
