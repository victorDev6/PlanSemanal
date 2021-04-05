{{-- @extends('layouts.app') --}}
@extends('adminlte::page')

@section('title', 'Validación de Actividades')

@section('content')
    
    <div class="container-fluid">

        {{-- @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif --}}
        @if(!empty($success))
            <div class="alert alert-success"> {{ $success }}</div>
        @endif

        <div class="card">
            <div class="card-header">
                VALIDACIÓN DE ACTIVIDADES POR ÓRGANO ADMINISTRATIVO
            </div>
            <div class="card-body">

                <form action="{{route('validacion.inicio')}}" method="get">
                    @csrf

                    <div class="row">
                        <div class="col-3">Órgano Validador</div>
                        <div class="col-4">
                            <select name="organo" class="form-control" id="organo">
                                <option value="{{ $organo[0]->id }}">{{ $organo[0]->descripcion }}</option>
                            </select>
                        </div>
                    </div>
    
                    <div class="row mt-2">
                        <div class="col-3">Órgano Administrativo</div>
                        <div class="col-4">
                            <select name="area" id="area" class="custom-select">
                                <option value="">SELECCIONAR</option>
                                @foreach ($areas as $area)
                                    <option {{$administrativo == $area->id ? 'selected' : ''}} value="{{ $area->id }}">{{ $area->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2">
                            <input class="form-control" type="number" name="semana" id="semana" placeholder="Semana" value="{{$semana}}">
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-outline-primary">FILTRAR</button>
                        </div>
                    </div>
                </form>

                {{-- <div class="form-row mt-2">
                    <div class="col-3">Órgano Administrativo</div>
                    <div class="col ml-1">
                        {!! Form::open(['route' => 'validacion.inicio', 'method' => 'GET', 'class' => 'form-inline']) !!}
                        <select name="area" id="area" class="custom-select">
                            <option value="">SELECCIONAR</option>
                            @foreach ($areas as $area)
                                <option {{$administrativo == $area->id ? 'selected' : ''}} value="{{ $area->id }}">{{ $area->descripcion }}</option>
                            @endforeach
                        </select>
        
                        {!! Form::number('semana', null, ['class' => 'form-control ml-2 mr-sm-2', 'placeholder' => 'Semana',
                        'aria-label' => 'Semana', 'value' => '123']) !!}
                        <button type="submit" class="btn btn-outline-primary">FILTRAR</button>
                        {!! Form::close() !!}
                    </div>
                </div> --}}

                <div class="row mt-4">
                    <div class="col">
                        <form action="{{route('validacion.enviar')}}" method="post">
                            @csrf
    
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Asunto</th>
                                        <th scope="col">Área responsable</th>
                                        <th scope="col">Actividad</th>
                                        <th scope="col">Estatus</th>
                                        <th scope="col">Observaciones</th>
                                        <th scope="col">Semana</th>
                                        <th scope="col">Enviado</th>
                                        <th scope="col">Selección</th>
                                    </tr>
                                </thead>
        
                                <tbody>
                                    <input id="administrativo" name="administrativo" class="d-none" type="number" value="{{$administrativo}}">
                                    <input id="semana" name="semana" class="d-none" type="number" value="{{$semana}}">


                                    @foreach ($actividades as $actividad)
                                        <tr>
                                            <td width="100px">{{ $actividad->fecha }}</td>
                                            <td>{{ $actividad->asunto }}</td>
                                            <td width="200px" >{{ $actividad->descripcion }}</td>
                                            <td>{{ $actividad->actividad }}</td>
                                            <td width="120px">{{ $actividad->status }}</td>
                                            <td>{{ $actividad->observaciones }}</td>
                                            <td width="40px">{{ $actividad->semana }}</td>
                                            <td width="50px">
                                                @if ($actividad->fecha_validacion == null)
                                                    NO
                                                @else
                                                    SI
                                                @endif
                                            </td>
                                            <td width="40px">
                                                @if ($actividad->fecha_validacion == null)
                                                    <div class="custom-control custom-checkbox d-flex justify-content-center">
                                                        <input type="checkbox" value="{{ $actividad->id }}" class="custom-control-input settings"
                                                            name="actividades[]" id="check + {{$actividad->id}}">
                                                        <label class="custom-control-label"
                                                            for="check + {{$actividad->id}}"></label>
                                                    </div>
                                                @else
                                                    No Disponible
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            @if (!$actividades->isEmpty())
                                <div class="row">
                                    <div class="col d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary btn-lg">Enviar a DG</button>
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    
@endsection