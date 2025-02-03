@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <form method="POST" action="{{route ('npdiario')}}">
                    @csrf
                <div class="card-header"><b>Parte Diario :: {{$obra->nombre}}</b>
                </div>
                    <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <input type="hidden" name="obra_id" value="{{$obra->id}}">
                    <input type="hidden" name="usuario_id" value="{{Auth::user()->id}}">
                    <div class="row mb-3">
                            <label for="fe" class="col-md-4 col-form-label text-md-end">{{ __('Fecha') }}</label>
                            <div class="col-md-6">
                                <input id="fe" type="date" class="form-control" name="fecha" min="2025-01-01" max="{{ date('Y-m-d') }}" required>
                            </div>
                    </div><!-- ROW -->
                    <div class="row mb-3">
                            <label for="it" class="col-md-4 col-form-label text-md-end">{{ __('Item') }}</label>
                            <div class="col-md-6">
                            <select id="it" class="form-control" name="item_id" required>
                                <option value="" selected>Item</option>
                                 @foreach ($items as $i)
                                 <option value="{{$i->id}}">{{$i->item}}</option>
                                 @endforeach
                            </select>
                            </div>
                    </div><!-- ROW -->
                    <div class="row mb-3">
                            <label for="eq" class="col-md-4 col-form-label text-md-end">{{ __('Equipo') }}</label>
                            <div class="col-md-6">
                            <select id="eq" class="form-control" name="equipo_id" required>
                                <option value="" selected>Código</option>
                                 @foreach ($equipos as $e)
                                 <option value="{{$e->id}}">{{$e->codigo}}</option>
                                 @endforeach
                            </select>
                            </div>
                    </div><!-- ROW -->
                    <div class="row mb-3">
                            <label for="hora" class="col-md-4 col-form-label text-md-end">{{ __('Horas') }}</label>
                            <div class="col-md-6">
                                <input id="hora" type="number" class="form-control" name="horas" required mint="1" max="250">
                            </div>
                    </div><!-- ROW -->
                    <div class="row mb-3">
                    <label for="comb" class="col-md-4 col-form-label text-md-end">{{ __('Combustible') }}</label>
                            <div class="col-md-6">
                                <input id="comb" type="number" class="form-control" name="combustible" required mint="1" max="500">
                            </div>
                    </div><!-- ROW -->
                    <div class="row mb-3">
                    <label for="aceite" class="col-md-4 col-form-label text-md-end">{{ __('Aceite') }}</label>
                            <div class="col-md-6">
                                <input id="aceite" type="number" class="form-control" name="aceite" required mint="1" max="250">
                            </div>
                    </div><!-- ROW -->
                    <div class="row mb-3">
                    <label for="lub" class="col-md-4 col-form-label text-md-end">{{ __('Lubricante') }}</label>
                            <div class="col-md-6">
                                <input id="lub" type="number" class="form-control" name="lubricante" required mint="1" max="250">
                            </div>
                    </div><!-- ROW -->
                    <div class="row mb-3">
                    <label for="obs" class="col-md-4 col-form-label text-md-end">{{ __('Observaciones') }}</label>
                            <div class="col-md-6">
                            <textarea class="form-control" id="obs" name="obs" value="" maxlength="250"></textarea>
                            </div>
                    </div><!-- ROW -->
                        </div><!-- cardBody -->
                        <div class="card-footer text-center">
                        <button type="button" onclick="window.history.go(-1); return false;" class="btn btn-secondary btn-sm">Cancelar</button>
                        <button type="submit" class="btn btn-primary btn-sm">Agregar</button>
                        </div><!-- cardFooter -->
                    
            </from>
            </div><!-- Card -->
        </div><!-- Col -->
    </div><!-- Justifi -->
</div><!-- container -->
@endsection
