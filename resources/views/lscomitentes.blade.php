@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Lista de Comitentes') }}
                </div>
                <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nombre</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comit as $u)
                        <tr  @if($u->activo==0) class="table-warning" @endif >
                            <td>{{$u->id}}</td>
                            <td @if($u->activo==0) class="text-secondary"><i class="bi bi-person-fill-slash"> @else ><i class="bi bi-person-fill-check text-success"> @endif</i> {{$u->comitente}}</td>
                            <td>
 				            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit{{$u->id}}"><i class="bi bi-pencil-square"></i></button>
                                        <!-- ModalEdit -->
                                        <div class="modal fade" id="edit{{$u->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <form method="POST" action="{{ route('ecom') }}">
                                                @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Editar Comitente</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <input type="hidden" name="id" value="{{$u->id}}">
                                                    <div class="row mb-3">
                                                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>
                                                    <div class="col-md-6">
                                                        <input id="name" type="text" class="form-control" name="name" value="{{$u->comitente}}" required autocomplete="name" autofocus>
                                                    </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Activo') }}</label>
                                                    <div class="col-md-6">
                                                    <div class="col-md-6  mt-2 pl-4">
                                                        <input class="form-check-input" type="checkbox" id="activo" name="activo" @if($u->activo==1) checked @endif>
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
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#mm">Agregar</button>
                <!-- Modal -->
                <div class="modal fade" id="mm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <form method="POST" action="{{ route('ncom') }}">
                        @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Agregar Comitente</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="" required autocomplete="name" autofocus>
                            </div>
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
