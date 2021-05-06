@extends('adminlte::page')

@section('title', 'Pagos Realizados')

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
            <!-- unidad -->
            <div class="col">
                <div class="form-group">
                    <label for="unidad" class="control-label">Unidad de Capacitación</label>
                    <select name="unidad" id="unidad" class="custom-select">
                        <option value="">SELECCIONAR</option>
                        @foreach ($unidades as $unidad)
                            <option value="{{ $unidad->id }}">{{ $unidad->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- fecha inicial -->
            <div class="col">
                <div class="form-group">
                    <label for="fecha_inicio" class="control-label">Fecha de Inicio</label>
                    <input type='text' id="fecha_inicio" autocomplete="off" readonly="readonly" name="fecha_inicio"
                        class="form-control datepicker" required>
                </div>
            </div>

            <!-- Fecha conclusion -->
            <div class="col">
                <div class="form-group">
                    <label for="fecha_termino" class="control-label">Fecha de Termino</label>
                    <input type='text' id="fecha_termino" autocomplete="off" readonly="readonly" name="fecha_termino"
                        class="form-control datepicker" required>
                </div>
            </div>

            <div class="col d-flex align-items-center d-flex justify-content-center">
                <button id="btnBuscar" type="button" class="btn btn-primary">BUSCAR</button>
            </div>
        </div>

        <hr class="my-4">
        <div class="row d-flex justify-content-center" style="position: relative;">
            <div class="col-12 col-md-6">
                <div id='calendar'></div>
            </div>
            <button id="btnTotal" style="position: absolute; bottom: 120px; right: 50px;" type="button"
                class="btn btn-warning">Total de Pagos Realizados</button>
            <button id="btnReporte" style="position: absolute; bottom: 170px; right: 50px;" type="button"
                class="btn btn-info">Generar Reporte</button>
            <form id="formReporte" action="{{ route('pagosRealizados.reporte') }}" method="get">@csrf</form>
        </div>

        <button id="btnModal" type="button" class="d-none" data-toggle="modal" data-target="#modalMessages"></button>
        <button id="btnModalTotal" type="button" class="d-none" data-toggle="modal" data-target="#modalTotal"></button>

        <!-- Modal -->
        <div class="modal fade" id="modalMessages" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
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
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal total -->
        <div class="modal fade" id="modalTotal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background: #541533">
                        <h5 class="modal-title text-white" id="tituloTotal"></h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6 id="mensajeTotal"></h6>
                        <div class="row">
                            <div class="col text-center">
                                <h3><strong id="numberTotal"></strong></h3>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
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
        var calendar;
        document.addEventListener('DOMContentLoaded', function() {
            var unidad, fechaInicio, fechaFinal;
            inicializarCalendario(unidad, fechaInicio, fechaFinal);
        });

        function inicializarCalendario(unidad, fechaInicio, fechaFinal) {
            document.getElementById('calendar').innerHTML = '';
            var calendarEl = document.getElementById('calendar');
            calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['dayGrid', 'interaction', 'timeGrid', 'list'],

                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth, timeGridWeek, timeGridDay',
                },
                dateClick: function(info) {},
                eventClick: function(info) {},
                events: ("{{ url('/pagosRealizados/show') }}" + ('/' + unidad + '/' + fechaInicio + '/' + fechaFinal)),
            });
            calendar.setOption('locale', 'es');
            calendar.render();
        }

        // formato fechas
        var dateFormat = "yy-mm-dd",
            from = $("#fecha_inicio").datepicker({
                changeMonth: true,
                numberOfMonths: 1,
                dateFormat: 'yy-mm-dd'
            }).on("change", function() {
                to.datepicker("option", "minDate", getDate(this));
            }),
            to = $("#fecha_termino").datepicker({
                changeMonth: true,
                numberOfMonths: 1,
                dateFormat: 'yy-mm-dd'
            })
            .on("change", function() {
                // from.datepicker("option", "maxDate", getDate(this));
            });

        function getDate(element) {
            var date;
            try {
                date = $.datepicker.parseDate(dateFormat, element.value);
            } catch (error) {
                date = null;
            }
            return date;
        }

        $('#btnBuscar').click(function() {
            if ($('#unidad').val() == '') {
                $('#titulo').html('Unidad de Capacitación');
                $('#mensaje').html('Seleccione una unidad de capacitación');
                $('#btnModal').click();
            } else if ($('#fecha_inicio').val() == '' || $('#fecha_termino').val() == '') {
                $('#titulo').html('Campos Vacíos');
                $('#mensaje').html('Debe seleccionar la fecha de inicio y de termino');
                $('#btnModal').click();
            } else {
                inicializarCalendario($('#unidad').val(), $('#fecha_inicio').val(), $('#fecha_termino').val());
            }
        });

        $('#btnReporte').click(function() {
            if ($('#unidad').val() == '' || $('#fecha_inicio').val() == '' || $('#fecha_termino').val() == '') {
                $('#titulo').html('Generar Reporte');
                $('#mensaje').html('Debe realizar una busqueda antes de generar un reporte');
                $('#btnModal').click();
            } else {
                $('#formReporte').submit();
            }
        });

        $('#btnTotal').click(function() {
            if ($('#unidad').val() == '' || $('#fecha_inicio').val() == '' || $('#fecha_termino').val() == '') {
                $('#titulo').html('Pagos Realizados');
                $('#mensaje').html('Debe realizar una busqueda antes de visualizar el total de pagos realizados');
                $('#btnModal').click();
            } else {
                var total = 0;
                calendar.getEvents().forEach(function(item) {
                    total += parseInt(item['title']);
                });

                $('#tituloTotal').html('Pagos Realizados');
                $('#mensajeTotal').html('Pagos realizados del ' + $('#fecha_inicio').val() + ' a ' + $('#fecha_termino').val());
                $('#numberTotal').html(total);
                $('#btnModalTotal').click();
            }
        });

    </script>
@endsection
