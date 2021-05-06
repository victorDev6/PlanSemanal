@extends('adminlte::page')

@section('title', 'Agregar Pagos Realizados')

@section('css')
    <style>
        .colorTop {
            background-color: #541533;
        }

    </style>
    <link rel="stylesheet" href="{{ asset('fullCalendar/core/main.css') }}">
    <link rel="stylesheet" href="{{ asset('fullCalendar/daygrid/main.css') }}">
    <link rel="stylesheet" href="{{ asset('fullCalendar/list/main.css') }}">
    <link rel="stylesheet" href="{{ asset('fullCalendar/timegrid/main.css') }}">
@endsection

@section('content')

    <div class="container-fluid">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="row d-flex justify-content-center">
            <div class="col-2 d-flex align-items-center"><strong>Unidad de Capacitación</strong></div>
            <div class="col-4">
                <select name="unidad" id="unidad" class="custom-select">
                    <option value="">SELECCIONAR</option>
                    @foreach ($unidades as $unidad)
                        <option value="{{ $unidad->id }}">{{ $unidad->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <hr class="my-4">
        <div class="row">
            <div class="col-12 col-md-6 mt-5">

                <form id="formCalendario">
                    <div class="row d-flex justify-content-center">
                        <input type="text" name="txtId" id="txtId" class="d-none">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Fecha</label>
                                <input type="text" disabled class="form-control" name="txtFecha" id="txtFecha" required>
                            </div>
                        </div>
                    </div>

                    <div class="row d-flex justify-content-center">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Número de Pagos Realizados</label>
                                <input type="number" class="form-control" name="txtNumero" id="txtNumero" required>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="row d-flex justify-content-center">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Comentarios</label>
                                <textarea class="form-control" name="txtComentarios" id="txtComentarios" cols="30"
                                    rows="2"></textarea>
                            </div>
                        </div>
                    </div> --}}
                    <div class="row d-flex justify-content-center">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Pago Enviado</label>
                                <h6><strong id="textSend"></strong></h6>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="row d-flex justify-content-center px-5">
                        <button id="btnAgregar" type="button" class="btn btn-success">Agregar</button>
                        <button id="btnModificar" class="btn btn-warning mx-2">Modificar</button>
                        <button id="btnBorrar" class="btn btn-danger">Borrar</button>
                    </div>

                    <br>
                    <div class="row d-flex justify-content-center px-5">
                        <button id="btnClean" type="button" class="btn btn-info">Limpiar campos</button>
                        <button id="btnSend" type="button" class="btn btn-primary ml-2">Enviar Pagos</button>
                    </div>
                </form>
                <button id="btnModal" type="button" class="d-none" data-toggle="modal" data-target="#modalMessages"></button>

            </div>
            <div class="col-12 col-md-6">
                <div id='calendar'></div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalMessages" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background: #541533">
                        <h5 class="modal-title text-white" id="titulo">cj</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <strong id="mensaje"></strong>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
                        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')
    <script src="{{ asset('fullCalendar/core/main.js') }}" defer></script>
    <script src="{{ asset('fullCalendar/core/locales-all.js') }}" defer></script>
    <script src="{{ asset('fullCalendar/interaction/main.js') }}" defer></script>
    <script src="{{ asset('fullCalendar/daygrid/main.js') }}" defer></script>
    <script src="{{ asset('fullCalendar/list/main.js') }}" defer></script>
    <script src="{{ asset('fullCalendar/timegrid/main.js') }}" defer></script>

    <script>
        // calendario
        var calendar;
        document.addEventListener('DOMContentLoaded', function() {

            var idEvento, objEvento, unidad;
            limpiarFormulario();
            inicializarCalendario(unidad);

            $('#unidad').on('change', function(e) {
                unidad = $('#unidad').val();
                limpiarFormulario();
                inicializarCalendario(unidad);
            });

            $('#btnAgregar').click(function() {
                if($('#unidad').val() == '') {
                    $('#titulo').html('Unidad de Capacitación');
                    $('#mensaje').html('Seleccione una unidad de capacitación');
                    $('#btnModal').click();
                } else if ($('#txtFecha').val() == '' || $('#txtNumero').val() == '') {
                    $('#titulo').html('Campos Vacíos');
                    $('#mensaje').html('Seleccione una fecha y agregue el número de pagos realizados');
                    $('#btnModal').click();
                } else {
                    objEvento = null;
                    objEvento = recolectarDatos("POST");
                    EnviarInformacion("", objEvento, 'insert');   
                }
            });

            // boton eliminar
            $('#btnBorrar').click(function(e) {
                e.preventDefault();
                objEvento = [];
                objEvento = recolectarDatos("DELETE");
                EnviarInformacion('/' + $('#txtId').val(), objEvento, 'delete');
            });

            // boton modificar
            $('#btnModificar').click(function(e) {
                e.preventDefault();
                
                if ($('#txtNumero').val() == '') {
                    $('#titulo').html('Campos Vacíos');
                    $('#mensaje').html('Agregue el número de pagos realizados');
                    $('#btnModal').click();
                } else {
                    objEvento = null;
                    objEvento = recolectarDatos("POST");
                    EnviarInformacion('/' + $('#txtId').val(), objEvento, 'update');   
                }
                
            });

            $('#btnClean').click(function() {
                limpiarFormulario();
            });

            $('#btnSend').click(function() {
                if (document.getElementById('unidad').value == '') {
                    $('#titulo').html('Unidad de Capacitación');
                    $('#mensaje').html('Seleccione una unidad de capacitación');
                    $('#btnModal').click();
                } else {
                    objData = getData(); 
                    EnviarPagos(objData);
                }
            });

            function getData() {
                enviar = [];
                enviar = {
                    id_unidad: document.getElementById('unidad').value,
                    '_token': $("meta[name='csrf-token']").attr("content"),
                    '_method': 'POST'
                }
                return enviar;
            }

            function recolectarDatos(method) {
                nuevoEvento = []
                nuevoEvento = {
                    title: $('#txtNumero').val(),
                    start: $('#txtFecha').val() + ' 00:00',
                    end: $('#txtFecha').val() + ' 00:00',
                    textColor: '#000000',
                    comentarios: null,
                    id_unidad: document.getElementById('unidad').value,
                    '_token': $("meta[name='csrf-token']").attr("content"),
                    '_method': method
                }
                return nuevoEvento;
            }

            function EnviarInformacion(accion, objEvento, tipo) {
                link = ((tipo == 'insert') ? "{{ url('/pagos/guardar') }}" : (tipo == 'update') ?
                    "{{ url('/pagos/update') }}" + accion : "{{ url('/pagos') }}" + accion);
                tipo2 = (tipo == 'insert') ? 'POST' : (tipo == 'update') ? 'POST' : 'GET';

                $.ajax({
                    type: tipo2,
                    url: link,
                    data: objEvento,
                    success: function(msg) {
                        console.log(msg);
                        calendar.refetchEvents();
                        limpiarFormulario();
                    },
                    error: function(jqXHR, textStatus) {
                        console.log(jqXHR);
                        alert("Hubo un error: " + jqXHR.status);
                    }
                });
            }

            function EnviarPagos(objData) {
                $.ajax({
                    type: 'POST',
                    url: "{{ url('/pagos/enviar') }}",
                    data: objData,
                    success: function(msg) {
                        calendar.refetchEvents();
                        limpiarFormulario();
                        $('#titulo').html('Pagos Realizados');
                        $('#mensaje').html('Pagos enviados correctamente');
                        $('#btnModal').click();
                    },
                    error: function(jqXHR, textStatus) {
                        console.log(jqXHR);
                        alert("Hubo un error: " + jqXHR.status);
                    }
                });
            }
        });

        function limpiarFormulario() {
            $('#formCalendario')[0].reset();
            $('#textSend').html('');
            idEvento = null;
            objEvento = null;

            $('#btnAgregar').prop('disabled', false);
            $('#btnModificar').prop('disabled', true);
            $('#btnBorrar').prop('disabled', true);
        }

        function inicializarCalendario(unidad) {
            document.getElementById('calendar').innerHTML = '';
            var calendarEl = document.getElementById('calendar');
            calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['dayGrid', 'interaction', 'timeGrid', 'list'],

                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth, timeGridWeek, timeGridDay',
                },

                dateClick: function(info) {
                    limpiarFormulario();
                    $('#txtFecha').val(info.dateStr);
                },

                eventClick: function(info) {

                    if (info.event.extendedProps.fecha_enviado == null) {
                        $('#btnAgregar').prop('disabled', true);
                        $('#btnModificar').prop('disabled', false);
                        $('#btnBorrar').prop('disabled', false);
                    } else {
                        $('#btnAgregar').prop('disabled', true);
                        $('#btnModificar').prop('disabled', true);
                        $('#btnBorrar').prop('disabled', true);
                    }
                    
                    mes = (info.event.start.getMonth() + 1);
                    dia = (info.event.start.getDate());
                    anio = (info.event.start.getFullYear());
                    mes = (mes < 10) ? '0' + mes : mes;
                    dia = (dia < 10) ? '0' + dia : dia;

                    $('#txtId').val(info.event.id);
                    $('#txtNumero').val(info.event.title),
                        $('#txtFecha').val(dia + '-' + mes + '-' + anio);
                    $('#txtComentarios').val(info.event.extendedProps.comentarios);
                    $('#textSend').html(info.event.extendedProps.fecha_enviado == null ? 'NO' : 'SI')
                },

                events: ("{{ url('/pagos/show') }}" + ('/' + unidad)),
            });
            calendar.setOption('locale', 'es');
            calendar.render();
        }

    </script>
@endsection
