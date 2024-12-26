@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Lista de Items de ') }} <b>{{$obra->nombre}}</b><br>{{$obra->licitacion}}
                </div>
                <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $u)
                        <tr  @if($u->activo==0) class="table-warning" @endif >
                            <td>{{$u->numero}}</td>
                            <td>{{$u->item}}</td>
                            <td>{{$u->cantidad}} {{$u->unidad}}</td>
                            <td>
 				            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit{{$u->id}}"><i class="bi bi-pencil-square"></i></button>
                                        <!-- ModalEdit -->
                                        <div class="modal fade" id="edit{{$u->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <form method="POST" action="{{ route('eitems') }}">
                                                @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Editar Item</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <input type="hidden" name="id" value="{{$u->id}}">
                                                    <input type="hidden" name="obra" value="{{$obra->id}}">
                                                    <input type="hidden" name="pg" value="{{$items->currentPage()}}">
                                                    <div class="row mb-3">
                                                    <label for="name-{{$u->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>
                                                    <div class="col-md-6">
                                                        <input id="name-{{$u->id}}" type="text" class="form-control" name="nombre" value="{{$u->item}}" required autocomplete="name" autofocus>
                                                    </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                    <label for="activo-{{$u->id}}" class="col-md-4 col-form-label text-md-end">{{ __('Activo') }}</label>
                                                    <div class="col-md-6">
                                                    <div class="col-md-6  mt-2 pl-4">
                                                        <input class="form-check-input" type="checkbox" id="activo-{{$u->id}}" name="activo" @if($u->activo==1) checked @endif>
                                                    </div>
                                                    </div>
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
                </div>
                <div class="card-footer">
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#mm">Agregar</button>  <a href="{{ route('lsobras') }}"><button class="btn btn-secondary btn-sm">Volver</button></a>
                <!-- Modal -->
                <div class="modal fade" id="mm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <form method="POST" action="{{ route('nitems') }}">
                        @csrf
                        <input type="hidden" name="obra" value="{{$obra->id}}">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Agregar Item</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <div class="row">
                            <label for="name" class="col-md-2 col-form-label text-md-end">{{ __('Items*') }}</label>
                            <div class="col-md-10">
                            <textarea class="form-control" class="form-control" id="name" name="nombre" value=""></textarea>
                            </div>
                            </div>
                            </div>
                            <div class="modal-footer">

                                <div class="col-md-8 text-secondary">* #,Nombre,unidad,cantidad <br></div>
                                <div class="col-md-2">
                                <button type="submit" class="btn btn-success btn-sm">Agregar</button>
                                </div>
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
