@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Lista de Usuarios') }}</div>
                <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Rol*</th>
                            <th>Mail</th>
                            <th>Clave</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usr as $u)
                        <tr>
                            <td>{{$u->id}}</td>
                            <td>{{$u->name}}</td>
                            <td><i class="bi bi-person-fill
                                @if ($u->rol=="adm") text-danger
                                @elseif ($u->rol=="opr") text-secondary
                                @else text-success
                                @endif
                                "></i>
                            </td>
                            <td>{{$u->email}}</td>
                            <td>
                            <!-- modal cambio de clave -->
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#cl{{$u->id}}"><i class="bi bi-pencil-fill"></i></button>

                            <div class="modal fade" id="cl{{$u->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <form method="POST" action="{{ route('mus', $u->id)}}">
                            @csrf
                            @method('put')
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Cambio de Clave para {{$u->name}}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Clave') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmar Clave') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-sm">Cambiar</button>
                            </div>
                        </form>
                        </div>
                    </div>
                    </div>
                </div>
                            </td>
                            <td>
                            <form action="{{route('dus', $u->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Desea Quitar a  {{$u->name}}?')" title="Eliminar"
                                    @if ($u->rol=='adm')
                                        disabled
                                        @endif><i class="bi bi-trash-fill"></i></button>
                                    </form>
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
                        <form method="POST" action="{{ route('nus') }}">
                        @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Agregar Usuario</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <div class="row mb-3">
                            <label for="rol" class="col-md-4 col-form-label text-md-end">{{ __('Rol') }}</label>

                            <div class="col-md-6">
                            <select id="rol" class="form-control" name="rol">
                                <option value="opr" selected>Operario</option>
                                <option value="adm">Administrador</option>
                            </select>
                            </div>
                        </div>
                            <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('eMail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Clave') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Clave x2') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-sm">Agregar</button>
                            </div>
                        </form>
                        </div>
                    </div>
                    </div>*<i class="bi bi-person-fill text-danger"></i>Administrador - <i class="bi bi-person-fill text-success"></i>Jefe - <i class="bi bi-person-fill text-secondary"></i>Operario
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
