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
                            <th>Licitación</th>
                            <th>Comitente</th>
                            <th>Inicio</th>
                            <th>Plazo</th>
                            <th>Items</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($obras as $u)
                        <tr  @if($u->activo==0) class="table-warning" @endif >
                            <td>{{$u->id}}</td>
                            <td>{{$u->nombre}}</td>
                            <td>{{$u->licitacion}}</td>
                            <td>{{$u->ncomi}}</td>
                            <td>{{date('d/m/y', strtotime($u->inicio))}}</td>
                            <td>{{$u->plazo}}</td>
                            <td>
                                    <a href="{{ route('lsitems',$u->id) }}">
                                    <button class="btn btn-sm btn-secondary"><i class="bi bi-list-check"></i></button>
                                    </a></td>
                            <td>
 				            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit{{$u->id}}"><i class="bi bi-pencil-square"></i></button>
                                        <!-- ModalEdit -->
                                        <div class="modal fade" id="edit{{$u->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <form method="POST" action="{{ route('eobras') }}" id="Edit-{{$u->id}}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$u->id}}">
                                                <input type="hidden" name="pg" value="{{$obras->currentPage()}}">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="Titulo">Editar Obra</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                <div class="row mb-3">
                                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>
                                                <div class="col-md-6">
                                                    <input id="name" type="text" class="form-control" name="nombre" value="{{$u->nombre}}" required autocomplete="name" autofocus>
                                                </div>
                                                </div>
                                                <div class="row mb-3">
                                                <label for="licitacion" class="col-md-4 col-form-label text-md-end">{{ __('Licitación') }}</label>
                                                <div class="col-md-6">
                                                    <input id="licitacion" type="text" class="form-control" name="licitacion" value="{{$u->licitacion}}" required autocomplete="name" maxlength="11" autofocus>
                                                </div>
                                                </div>
                                                <div class="row mb-3">
                                                <label for="licitacion" class="col-md-4 col-form-label text-md-end">{{ __('Inicio') }}</label>
                                                <div class="col-md-6">
                                                    <input id="licitacion" type="date" class="form-control" name="inicio" value='{{$u->inicio}}' required autocomplete="inicio" autofocus>
                                                </div>
                                                </div>
                                                <div class="row mb-3">
                                                <label for="licitacion" class="col-md-4 col-form-label text-md-end">{{ __('Pazo') }}</label>
                                                <div class="col-md-3">
                                                    <input id="licitacion" type="number" class="form-control" name="plazo" value="{{$u->plazo}}" required autocomplete="name" maxlength="3">
                                                </div>
                                                <div class="col-md-3 mt-2 pl-4">
                                                    Meses
                                                </div>
                                                </div>
                                                <div class="row mb-3">
                                                <label for="comitente-{{$u->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Comitente') }}</label>
                                                <div class="col-md-6">
                                                <select class="form-control" id="comitente-{{$u->id}}" name="comitente" required>
                                                    <option value="{{$u->comitente}}">{{$u->ncomi}}</option>
                                                    <option value="">- - - - - -</option>
                                                @foreach ($comit as $c)
                                                    <option value="{{$c->id}}" @if($c->id==$u->id) selected @endif>{{$c->comitente}}</option>
                                                @endforeach
                                                </select>
                                                </div>
                                                <div class="row mb-3">
                                                <label for="comitente" class="col-md-4 col-form-label text-md-end">{{ __('Activa') }}</label>
                                                <div class="col-md-6  mt-2 pl-4">
                                                <input class="form-check-input" type="checkbox" id="activo" name="activo" @if($u->activo==1) checked @endif>
                                                </div>
                                                </div>
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
                <div class="mx-3"><ul class="pagination">{{ $obras->links() }}</ul></div>
                </div>
                <div class="card-footer">
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#mm">Agregar</button>
                <!-- Modal -->
                <div class="modal fade" id="mm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <form method="POST" action="{{ route('nobras') }}">
                        @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Agregar Obra</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="nombre" value="" required autocomplete="name" autofocus>
                            </div>
                            </div>
                            <div class="row mb-3">
                            <label for="licitacion" class="col-md-4 col-form-label text-md-end">{{ __('Licitación') }}</label>
                            <div class="col-md-6">
                                <input id="licitacion" type="text" class="form-control" name="licitacion" value="" required autocomplete="name" maxlength="11" autofocus>
                            </div>
                            </div>
                            <div class="row mb-3">
                            <label for="inicio" class="col-md-4 col-form-label text-md-end">{{ __('Inicio') }}</label>
                            <div class="col-md-6">
                                <input id="inicio" type="date" class="form-control" name="inicio" value="" required autocomplete="inicio" autofocus>
                            </div>
                            </div>
                            <div class="row mb-3">
                            <label for="licitacion" class="col-md-4 col-form-label text-md-end">{{ __('Pazo') }}</label>
                            <div class="col-md-3">
                                <input id="licitacion" type="number" class="form-control" name="plazo" value="" required autocomplete="name" maxlength="3">
                            </div>
                            <div class="col-md-3 mt-2 pl-4">
                                Meses
                            </div>
                            </div>
                            <div class="row mb-3">
                            <label for="comitente" class="col-md-4 col-form-label text-md-end">{{ __('Comitente') }}</label>
                            <div class="col-md-6">
                            <select class="form-control" id="comitentes" name="comitente" required>
                                <option value="">Comintentes ...</option>
                            @foreach ($comit as $c)
                                <option value="{{$c->id}}">{{$c->comitente}}</option>
                             @endforeach
                            </select>

                            </div>
                            </div>
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
    </div><!-- justifi -->
</div><!-- container -->
@endsection
