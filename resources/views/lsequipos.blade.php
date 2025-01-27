@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">{{ __('Lista de Equipos')}} <a href="{{route('eqxls')}}"><i class="bi bi-filetype-xlsx text-success"></i></a>
                </div>
                <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Tipo</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Patente</th>
                            <th>Potencia</th>
                            <th>Sevice</th>
                            <th>Partes</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($equipos as $u)
                        <tr  @if($u->activo==0) class="table-warning" @endif >
                            @php $resto = $u->max-$u->control;
                            $por = $resto/$u->max @endphp
                            <td>{{$u->codigo}}</td>
                            <td>{{$u->tipo}}</td>
                            <td>{{$u->marca}}</td>
                            <td>{{$u->modelo}}</td>
                            <td>{{$u->patente}}</td>
                            <td>{{$u->potencia}}</td>
                            <td 
                            @if ($resto<0)
                            class="text-danger"
                            @endif
                            >{{$resto}}
                            @if($por < 0.15)
                            <i class="bi bi-exclamation-triangle-fill text-danger"></i>
                            @elseif($por < 0.50)
                            <i class="bi bi-exclamation-circle text-warning"></i>
                            @else
                            <i class="bi bi-check-circle text-success"></i>
                            @endif
                            </td>
                            <td><form method="POST" action="{{route('lspdmnt')}}">
                                @csrf
                                <input type="hidden" name="b" value="e">
                                <input type="hidden" name="id" value="{{$u->id}}">
                                <button type="submit" class="btn btn-secondary btn-sm"><i class="bi bi-list-columns"></i></button>
                            </form>
                            </td>
                            <td> <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit{{$u->id}}"><i class="bi bi-pencil-square"></i></button>
                                        <!-- ModalEdit -->
                                        <div class="modal fade" id="edit{{$u->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <form method="POST" action="{{ route('eequipos') }}">
                                                    <input type="hidden" name="id" value="{{$u->id}}">
                                                    <input type="hidden" name="pg" value="{{$equipos->currentPage()}}">
                        @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Agregar Equipamiento</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <div class="row mb-3">
                            <label for="marca" class="col-md-4 col-form-label text-md-end">Marca</label>
                            <div class="col-md-6">
                                <input id="marca" type="text" class="form-control" name="marca" value="{{$u->marca}}" required autocomplete="marca" autofocus>
                            </div>
                            </div>
                            <div class="row mb-3">
                            <label for="codigo" class="col-md-4 col-form-label text-md-end">Código</label>
                            <div class="col-md-6">
                                <input id="codigo" placeholder="XX-###" type="text" maxlength="6" class="form-control" name="codigo" value="{{$u->codigo}}" required autocomplete="codigo" autofocus>
                            </div>
                            </div>
                            <div class="row mb-3">
                            <label for="tipo" class="col-md-4 col-form-label text-md-end">Tipo</label>
                            <div class="col-md-6">
                                <input id="tipo" type="text" class="form-control" name="tipo" value="{{$u->tipo}}" required autocomplete="tipo" autofocus>
                            </div>
                            </div>
                            <div class="row mb-3">
                            <label for="modelo" class="col-md-4 col-form-label text-md-end">Modelo</label>
                            <div class="col-md-6">
                                <input id="modelo" type="text" class="form-control" name="modelo" value="{{$u->modelo}}" required autocomplete="modelo" autofocus>
                            </div>
                            </div>
                            <div class="row mb-3">
                            <label for="potencia" class="col-md-4 col-form-label text-md-end">Potencia</label>
                            <div class="col-md-6">
                                <input id="potencia" type="text" class="form-control" name="potencia" value="{{$u->potencia}}" required autocomplete="potencia" autofocus>
                            </div>
                            </div>
                            <div class="row mb-3">
                            <label for="patente" class="col-md-4 col-form-label text-md-end">Patente</label>
                            <div class="col-md-6">
                                <input id="patente" type="text" class="form-control" name="patente" value="{{$u->patente}}" required autocomplete="patente" autofocus>
                            </div>
                            </div>
                            <div class="row mb-3">
                            <label for="max" class="col-md-4 col-form-label text-md-end">Máximo</label>
                            <div class="col-md-6">
                                <input id="max" type="number" class="form-control" name="max" value="{{$u->max}}" required autocomplete="max" autofocus>
                            </div>
                            </div>
                            <div class="row mb-3">
                            <label for="control" class="col-md-4 col-form-label text-md-end">Control</label>
                            <div class="col-md-6">
                                <input id="control" type="number" class="form-control" name="control" value="{{$u->control}}" required autocomplete="control" autofocus>
                            </div>
                            </div>
                            <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Activo?</label>
                            <div class="col-md-6  mt-2 pl-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="activo" name="activo" @if($u->activo==1) checked @endif>
                            </div>
                            </div>
                            </div><!-- Modal Body-->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success btn-sm">Editar</button>
                            </div>
                        </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ModalEdit -->
                        
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                <div class="mx-3"><ul class="pagination">{{ $equipos->links() }}</ul></div>
                <div class="card-footer">
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#mm">Agregar</button>
                <!-- Modal -->
                <div class="modal fade" id="mm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <form method="POST" action="{{ route('nequipos') }}">
                        @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Agregar Equipamiento</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <div class="row mb-3">
                            <label for="marca" class="col-md-4 col-form-label text-md-end">Marca</label>
                            <div class="col-md-6">
                                <input id="marca" type="text" class="form-control" name="marca" value="" required autocomplete="marca" autofocus>
                            </div>
                            </div>
                            <div class="row mb-3">
                            <label for="codigo" class="col-md-4 col-form-label text-md-end">Código</label>
                            <div class="col-md-6">
                                <input id="codigo" placeholder="XX-###" type="text" maxlength="6" class="form-control" name="codigo" value="" required autocomplete="codigo" autofocus>
                            </div>
                            </div>
                            <div class="row mb-3">
                            <label for="tipo" class="col-md-4 col-form-label text-md-end">Tipo</label>
                            <div class="col-md-6">
                                <input id="tipo" type="text" class="form-control" name="tipo" value="" required autocomplete="tipo" autofocus>
                            </div>
                            </div>
                            <div class="row mb-3">
                            <label for="modelo" class="col-md-4 col-form-label text-md-end">Modelo</label>
                            <div class="col-md-6">
                                <input id="modelo" type="text" class="form-control" name="modelo" value="" required autocomplete="modelo" autofocus>
                            </div>
                            </div>
                            <div class="row mb-3">
                            <label for="potencia" class="col-md-4 col-form-label text-md-end">Potencia</label>
                            <div class="col-md-6">
                                <input id="potencia" type="text" class="form-control" name="potencia" value="" required autocomplete="potencia" autofocus>
                            </div>
                            </div>
                            <div class="row mb-3">
                            <label for="patente" class="col-md-4 col-form-label text-md-end">Patente</label>
                            <div class="col-md-6">
                                <input id="patente" type="text" class="form-control" name="patente" value="" required autocomplete="patente" autofocus>
                            </div>
                            </div>
                            <div class="row mb-3">
                            <label for="max" class="col-md-4 col-form-label text-md-end">Máximo</label>
                            <div class="col-md-6">
                                <input id="max" type="number" class="form-control" name="max" value="" required autocomplete="max" autofocus>
                            </div>
                            </div>
                            <div class="row mb-3">
                            <label for="control" class="col-md-4 col-form-label text-md-end">Control</label>
                            <div class="col-md-6">
                                <input id="control" type="number" class="form-control" name="control" value="0" required autocomplete="control" autofocus>
                            </div>
                            </div>
                            <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Activo?</label>
                            <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="activo" name="activo" checked>
                            </div>
                            </div>
                            </div><!-- Modal Body-->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success btn-sm">Agregar</button>
                            </div>
                        </form>
                        </div>
                    </div>
                    </div>
                    <!-- Modal -->
                </div><!-- CardFooter -->
                </div><!-- CardBody -->
            </div><!-- Card -->
        </div><!-- colmd8 -->
        <div class="row justify-content-center my-3">
            <form class="form-inline" method="POST" action="{{route('lspdmnt')}}">
                @csrf
                <input type="hidden" name="b" value="o">
                <table>
                    <tr>
                        <td>
                            Listar partes de la obra: 
                        </td>
                        <td>
                        <select name="id" class='form-control'  required="required">
                        <option selected disabled></option>
                        @foreach($obras as $o)
                        <option value="{{$o->id}}">{{$o->nombre}}</option>
                        @endforeach
                        </select>
                        </td>
                        <td>
                        <button type="submit" class="btn btn-secondary btn-sm  mx-sm-3"><i class="bi bi-search"></i></button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div><!-- justifi -->
</div><!-- container -->
@endsection
