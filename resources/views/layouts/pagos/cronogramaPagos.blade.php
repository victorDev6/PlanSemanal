@extends('adminlte::page')

@section('title', 'Cronograma de Pagos')

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

        <form id="formFechas" action="{{route('cronogramaPagos.inicio')}}" method="get">
            @csrf
            
            <div class="row mt-2">
                <!-- fecha inicial -->
                <div class="col">
                    <div class="form-group">
                        <label for="fecha_inicio" class="control-label">Fecha de Inicio</label>
                        <input type='text' id="fecha_inicio" autocomplete="off" readonly="readonly" name="fecha_inicio"
                            class="form-control datepicker" value="{{$fechaInicio}}" required>
                    </div>
                </div>

                <!-- Fecha conclusion -->
                <div class="col">
                    <div class="form-group">
                        <label for="fecha_termino" class="control-label">Fecha de Termino</label>
                        <input type='text' id="fecha_termino" autocomplete="off" readonly="readonly" name="fecha_termino"
                            class="form-control datepicker" value="{{$fechaTermino}}" required>
                    </div>
                </div>

                <div class="col d-flex align-items-center">
                    <button type="submit" id="btnBuscarCurso" class="btn btn-primary">FILTRAR</button>
                </div>
            </div>
        </form>

        <div class="d-none">{{$comitan = 0, $jiquipilas = 0, $catazaja = 0, $reforma = 0, $tapachula = 0, $sanCristobal = 0, $tuxtla = 0, 
            $tonala = 0, $ocosingo = 0, $villaflores = 0, $yajalon = 0}}</div>
        <table class="table table-bordered table-striped">
            <thead class="thead-light">
                <tr>
                    <th><small>Unidades de Capacitación</small></th>
                    @foreach ($unidades as $unidad)
                        <th scope="col"><small>{{$unidad->nombre}}</small></th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($grouped as $group)
                    <tr>
                        <td>{{$group[0]->start}}</td>
                        <td> {{-- comitan --}}
                            @foreach ($group as $item)
                                @if ($item->id_unidad == 1)
                                    {{$item->title}}
                                    <div class="d-none">{{$comitan += $item->title}}</div>
                                @endif
                            @endforeach
                        </td>
                        <td> {{-- jiquipilas --}}
                            @foreach ($group as $item)
                                @if ($item->id_unidad == 2)
                                    {{$item->title}}
                                    <div class="d-none">{{$jiquipilas += $item->title}}</div>
                                @endif
                            @endforeach
                        </td>
                        <td> {{-- catazaja --}}
                            @foreach ($group as $item)
                                @if ($item->id_unidad == 3)
                                    {{$item->title}}
                                    <div class="d-none">{{$catazaja += $item->title}}</div>
                                @endif
                            @endforeach
                        </td>
                        <td> {{-- reforma --}}
                            @foreach ($group as $item)
                                @if ($item->id_unidad == 4)
                                    {{$item->title}}
                                    <div class="d-none">{{$reforma += $item->title}}</div>
                                @endif
                            @endforeach
                        </td>
                        <td> {{-- tapachula --}}
                            @foreach ($group as $item)
                                @if ($item->id_unidad == 5)
                                    {{$item->title}}
                                    <div class="d-none">{{$tapachula += $item->title}}</div>
                                @endif
                            @endforeach
                        </td>
                        <td> {{-- san cristobal --}}
                            @foreach ($group as $item)
                                @if ($item->id_unidad == 6)
                                    {{$item->title}}
                                    <div class="d-none">{{$sanCristobal += $item->title}}</div>
                                @endif
                            @endforeach
                        </td>
                        <td> {{-- tuxtla --}}
                            @foreach ($group as $item)
                                @if ($item->id_unidad == 7)
                                    {{$item->title}}
                                    <div class="d-none">{{$tuxtla += $item->title}}</div>
                                @endif
                            @endforeach
                        </td>
                        <td> {{-- tonala --}}
                            @foreach ($group as $item)
                                @if ($item->id_unidad == 8)
                                    {{$item->title}}
                                    <div class="d-none">{{$tonala += $item->title}}</div>
                                @endif
                            @endforeach
                        </td>
                        <td> {{-- ocosingo --}}
                            @foreach ($group as $item)
                                @if ($item->id_unidad == 9)
                                    {{$item->title}}
                                    <div class="d-none">{{$ocosingo += $item->title}}</div>
                                @endif
                            @endforeach
                        </td>
                        <td> {{-- villaflores --}}
                            @foreach ($group as $item)
                                @if ($item->id_unidad == 10)
                                    {{$item->title}}
                                    <div class="d-none">{{$villaflores += $item->title}}</div>
                                @endif
                            @endforeach
                        </td>
                        <td> {{-- yajalon --}}
                            @foreach ($group as $item)
                                @if ($item->id_unidad == 11)
                                    {{$item->title}}
                                    <div class="d-none">{{$yajalon += $item->title}}</div>
                                @endif
                            @endforeach
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td><strong>Totales</strong></td>
                    <td><strong>{{$comitan}}</strong></td>
                    <td><strong>{{$jiquipilas}}</strong></td>
                    <td><strong>{{$catazaja}}</strong></td>
                    <td><strong>{{$reforma}}</strong></td>
                    <td><strong>{{$tapachula}}</strong></td>
                    <td><strong>{{$sanCristobal}}</strong></td>
                    <td><strong>{{$tuxtla}}</strong></td>
                    <td><strong>{{$tonala}}</strong></td>
                    <td><strong>{{$ocosingo}}</strong></td>
                    <td><strong>{{$villaflores}}</strong></td>
                    <td><strong>{{$yajalon}}</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="row d-flex justify-content-end">
            <button id="btnReporteCronograma" type="button"
                class="btn btn-info mb-4">Generar Reporte</button>
            <form id="formReporteCronograma" action="{{ route('cronogramaPagos.reporte') }}" method="get">@csrf</form>
        </div>

        
        <button id="btnModal" type="button" class="d-none" data-toggle="modal" data-target="#modalMessages"></button>

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
    </div>
@endsection

@section('js')
    <script>
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

        $('#formFechas').validate({
            rules: {
                fecha_inicio: {
                    required: true
                },
                fecha_termino: {
                    required: true
                }
            },
            messages: {
                fecha_inicio: {
                    required: 'Campo requerido'
                },
                fecha_termino: {
                    required: 'Campo requerido'
                }
            }
        });

        $('#btnReporteCronograma').click(function (){
            if ($('#fecha_inicio').val() == '' || $('#fecha_termino').val() == '') {
                $('#titulo').html('Generar Reporte');
                $('#mensaje').html('Debe realizar una busqueda antes de generar un reporte');
                $('#btnModal').click();
            } else {
                $('#formReporteCronograma').submit();
            }
        });
    </script>
@endsection