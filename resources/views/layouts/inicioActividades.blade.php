{{-- @extends('layouts.app') --}}
@extends('adminlte::page')

@section('title', 'Agregar Actividades')

@section('css')
    <style>
        .colorTop { 
            background-color: #541533;
        }
    </style>
@endsection

@section('content')

    <div class="container-fluid">

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="card">
            <div class="card-header">REGISTRO DE ACTIVIDADES</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-3">Órgano Administrativo</div>
                    <div class="col-4">
                        <select name="organo" class="form-control" id="organo">
                            <option value="{{ $organos[0]->id }}">{{ $organos[0]->descripcion }}</option>
                        </select>
                    </div>
                </div>

                <form action="{{route('actividades.inicio')}}" method="get">
                    @csrf
                    <div class="row mt-2">
                        <div class="col-3">Semana</div>
                        <div class="col-4">
                            <input class="form-control" type="number" name="busqueda" id="busqueda"
                            placeholder="Semana" value="{{$semana}}">
                        </div>
                        <div class="col">
                            <button type="submit" id="btnBuscarCurso" class="btn btn-primary">FILTRAR</button>
                        </div>
                    </div>
                </form>

                <hr class="my-4">
                <form id="formAddActivity" action="{{ route('actividades.store') }}" method="post">
                    @csrf

                    <div class="row d-flex align-items-center">
                        <div class="form-group col">
                            <label for="fecha" class="control-label">Fecha</label>
                            <input type='text' id="fecha" autocomplete="off" readonly="readonly" name="fecha"
                                class="form-control datepicker" required>
                        </div>

                        <div class="form-group col">
                            <label for="asunto" class="control-label">Asunto</label>
                            <textarea name="asunto" id="asunto" class="form-control" placeholder="Asunto" cols="30" rows="2"></textarea>
                        </div>

                        {{-- <div class="form-group col">
                            <label for="area_responsable" class="control-label">Area Responsable</label>
                            <select name="area_responsable" id="area_responsable" class="custom-select">
                                <option value="">SELECCIONAR</option>
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}">{{ $area->descripcion }}</option>
                                @endforeach
                            </select>
                        </div> --}}

                        <div class="form-group col">
                            <label for="actividad" class="control-label">Actividad</label>
                            <textarea name="actividad" id="actividad" class="form-control" placeholder="Actividad" cols="30" rows="2"></textarea>
                        </div>

                        <div class="form-group col">
                            <label for="observaciones" class="control-label">Observaciones</label>
                            <textarea class="form-control" name="observaciones" id="observaciones" cols="30" rows="2" placeholder="Observaciones"></textarea>
                        </div>

                        <div class="form-group col">
                            <label for="semana" class="control-label">Semana</label>
                            <input type="number" class="form-control" id="semana" name="semana" placeholder="Semana"
                                value="{{$semana}}">
                        </div>

                        <div class="form-group col">
                            <label for="status" class="control-label">Estado</label>
                            <select name="status" class="form-control" id="status">
                                <option value="">Seleccione</option>
                                <option value="INICIADO">INICIADO</option>
                                <option value="EN PROCESO">EN PROCESO</option>
                                <option value="TERMINADO">TERMINADO</option>
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="tipo_actividad" class="control-label">Tipo de actividad</label>
                            <select name="tipo_actividad" class="form-control" id="tipo_actividad">
                                <option value="">Seleccione</option>
                                <option value="ACTIVIDAD">ACTIVIDAD</option>
                                <option value="PERMISO">PERMISO</option>
                            </select>
                        </div>

                        <div class="form-group col-1 mt-2">
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>
                    </div>
                </form>

                <hr>
                <div class="row">
                    @if (!$actividades->isEmpty())
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Asunto</th>
                                    <th scope="col">Área responsable</th>
                                    <th scope="col">Actividad</th>
                                    <th scope="col">Estatus</th>
                                    <th scope="col">Observaciones</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Semana</th>
                                    <th scope="col">Enviado</th>
                                    <th scope="col">Opción</th>
                                </tr>
                            </thead>

                            <tbody>
                                {{-- <tr>
                                    <form id="formAddActivity" action="{{ route('actividades.store') }}"
                                        method="post">
                                        @csrf

                                        <td>
                                            <input type='text' id="fecha" autocomplete="off" readonly="readonly" name="fecha"
                                                class="form-control datepicker" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="asunto" name="asunto"
                                                placeholder="Asunto">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="area_responsable"
                                                name="area_responsable" placeholder="Área Responsable">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="actividad" name="actividad"
                                                placeholder="Actividad">
                                        </td>
                                        <td>
                                            <select name="status" class="form-control" id="status">
                                                <option value="">Seleccione</option>
                                                <option value="INICIADO">INICIADO</option>
                                                <option value="EN PROCESO">EN PROCESO</option>
                                                <option value="TERMINADO">TERMINADO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="observaciones" name="observaciones"
                                                placeholder="Observaciones">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" id="semana" name="semana"
                                                placeholder="Semana">
                                        </td>
                                        <td><button type="submit" class="btn btn-primary">Agregar</button></td>
                                    </form>
                                </tr> --}}

                                @foreach ($actividades as $actividad)
                                    <tr>
                                        <form id="formStatus_{{ $actividad->id }}"
                                            action="{{ route('actividades.editar', ['id' => $actividad->id, 'semana'=>$actividad->semana]) }}" method="post">
                                            @csrf

                                            <td width="100px">{{ $actividad->fecha }}</td>
                                            <td>{{ $actividad->asunto }}</td>
                                            <td>{{ $actividad->descripcion }}</td>
                                            <td>{{ $actividad->actividad }}</td>
                                            <td width="170px">
                                                <select name="{{ $actividad->id }}" id="{{ $actividad->id }}"
                                                    class="form-control">
                                                    <option {{ $actividad->status == 'INICIADO' ? 'selected' : '' }}
                                                        value="INICIADO">INICIADO</option>
                                                    <option {{ $actividad->status == 'EN PROCESO' ? 'selected' : '' }}
                                                        value="EN PROCESO">EN PROCESO</option>
                                                    <option {{ $actividad->status == 'TERMINADO' ? 'selected' : '' }}
                                                        value="TERMINADO">TERMINADO</option>
                                                </select>
                                            </td>
                                            <td>{{ $actividad->observaciones }}</td>
                                            <td width="100px" >{{ $actividad->tipo_actividad }}</td>
                                            <td width="40px">{{ $actividad->semana }}</td>
                                            <td width="40px">
                                                @if ($actividad->fecha_enviado == null)
                                                    NO
                                                @else
                                                    SI
                                                @endif
                                            </td>
                                            <td width="120px">
                                                @if ($actividad->fecha_enviado == null)
                                                    <div class="row d-flex justify-content-center">
                                                        <a class="btn btn-info btn-circle m-1 btn-circle-sm" title="Modificar"
                                                            href="#"
                                                            onclick="document.getElementById('formStatus_' + {{ $actividad->id }}).submit()">
                                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                        </a>

                                                        <a class="btn btn-danger btn-circle m-1 btn-circle-sm" title="Eliminar"
                                                            href="{{ route('actividades.destroy', ['id'=>$actividad->id, 'semana'=>$actividad->semana]) }}">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                @else
                                                    NO DISPONIBLE
                                                @endif
                                            </td>
                                        </form>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                    <div class="col text-center">
                        <h5><strong>Sin Actividades Registradas</strong></h5>
                    </div>
                    @endif
                    
                </div>
            </div>
        </div>

        @if (!$actividades->isEmpty())
            <div class="row mt-2">
                <div class="col d-flex justify-content-end">
                    {{-- <button id="btnEnviar" type="button" class="btn btn-primary btn-lg">Enviar</button> --}}
                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalSemana">Enviar</button>
                </div>
            </div>
        @endif

        <!-- Modal solicitar semana -->
        <div class="modal fade" id="modalSemana" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="formSemana" enctype="multipart/form-data" action="{{ route('actividades.enviar') }}"
                        method="post">
                        @csrf

                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">SEMANA A ENVIAR</h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            {{-- archivo --}}
                            {{-- <input class="d-none" type="text" id="idsolicitud" name="idSolicitud"
                                value="{{ $solicitud != null && !$solicitud->isEmpty() ? $solicitud[0]->id_solicitud : '' }}">
                            <input class="d-none" type="text" class="form-control" id="num_solicitud" name="num_solicitud"
                                value="{{ $solicitud != null && !$solicitud->isEmpty() ? $solicitud[0]->num_solicitud : '' }}"> --}}
                            <div class="form-group col">
                                <label for="semanaE">NÚMERO DE SEMANA A ENVIAR</label>
                                <input type="number" class="form-control" id="semanaE" name="semanaE" placeholder="Semana">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">ENVIAR ACTIVIDADES</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <script>
        $("#fecha").datepicker({
            language: "es",
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            dateFormat: 'yy-mm-dd'
        });

        $('#formAddActivity').validate({
            rules: {
                fecha: {
                    required: true
                },
                asunto: {
                    required: true
                },
                area_responsable: {
                    required: true
                },
                actividad: {
                    required: true
                },
                status: {
                    required: true
                },
                observaciones: {
                    required: true
                },
                semana: {
                    required: true
                },
                tipo_actividad: {
                    required: true
                }
            },
            messages: {
                fecha: {
                    required: 'Campo requerido'
                },
                asunto: {
                    required: 'Campo requerido'
                },
                area_responsable: {
                    required: 'Campo requerido'
                },
                actividad: {
                    required: 'Campo requerido'
                },
                status: {
                    required: 'Campo requerido'
                },
                observaciones: {
                    required: 'Campo requerido'
                },
                semana: {
                    required: 'Campo requerido'
                },
                tipo_actividad: {
                    required: 'Campo requerido'
                }
            }
        });

        $('#formSemana').validate({
            rules: {
                semanaE: {
                    required: true
                }
            },
            messages: {
                semanaE: {
                    required: 'Debe ingresar el número de semana a enviar'
                }
            }
        });

    </script>

@endsection
