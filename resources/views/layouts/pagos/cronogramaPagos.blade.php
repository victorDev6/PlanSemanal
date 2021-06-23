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

        <div class="row">
            <div class="col"><strong>PP</strong> - Pagos Programados</div>
            <div class="col"><strong>CB</strong> - Pagos Cargados al Banco</div>
            <div class="col"><strong>EP</strong> - Pagos Efectivamente Pagados</div>
            <div class="col"><strong>NA</strong> - No Agregado</div>
        </div>
        
        <div class="d-none"> {{$cp = null, $cb = null, $ce = null, $jp = null, $jb = null, $je = null,
                $cap = null, $cab = null, $cae = null, $rp = null, $rb = null, $re = null,
                $tp = null, $tb = null, $te = null, $sp = null, $sb = null, $se = null,
                $tup = null, $tub = null, $tue = null, $top = null, $tob = null, $toe = null,
                $op = null, $ob = null, $oe = null, $vp = null, $vb = null, $ve = null,
                $yp = null, $yb = null, $ye = null}}</div>
        <div class="d-none">{{$comitan = 0, $comitanBanco = 0, $comitanEfectivos = 0,  $jiquipilas = 0, $jiquipilasBanco = 0, $jiquipilasEfectivos = 0, 
                $catazaja = 0, $catazajaBanco = 0, $catazajaEfectivos = 0, $reforma = 0, $reformaBanco = 0, $reformaEfectivos = 0, 
                $tapachula = 0, $tapachulaBanco = 0, $tapachulaEfectivos = 0, $sanCristobal = 0, $sanCristobalBanco = 0, $sanCristobalEfectivos = 0, 
                $tuxtla = 0, $tuxtlaBanco = 0, $tuxtlaEfectivos = 0,$tonala = 0, $tonalaBanco = 0, $tonalaEfectivos = 0, 
                $ocosingo = 0, $ocosingoBanco = 0, $ocosingoEfectivos = 0, $villaflores = 0, $villafloresBanco = 0, $villafloresEfectivos = 0, 
                $yajalon = 0, $yajalonBanco = 0, $yajalonEfectivos = 0}}</div>
        <table class="table table-bordered table-striped">
            <thead class="thead-light">
                <tr>
                    <th><small>Unidades de Capacitación</small></th>
                    @foreach ($unidades as $unidad)
                        <th scope="col"><small>{{$unidad->nombre}} <br> PP - CB - EP</small></th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($grouped as $group)
                    <tr>
                        <td><small>{{$group[0]->start}}</small></td>
                        <td> {{-- comitan --}}
                            <div class="d-none">{{$cp = null}}</div>
                            <div class="d-none">{{$cb = null}}</div>
                            <div class="d-none">{{$ce = null}}</div>
                            @foreach ($group as $item)
                                @if ($item->id_unidad == 1)
                                    @if ($item->backgroundColor == null) 
                                        <div class="d-none">{{$comitan += $item->title}} {{$cp = $item->title}}</div>
                                    @elseif ($item->backgroundColor == '#fceb30')
                                        <div class="d-none">{{$comitanBanco += $item->title}} {{$cb = $item->title}}</div>
                                    @elseif ($item->backgroundColor == '#00ff04')
                                        <div class="d-none">{{$comitanEfectivos += $item->title}} {{$ce = $item->title}}</div>
                                    @endif
                                @endif
                            @endforeach
                            <small>{{$cp != null ? $cp : 'NA'}} - {{$cb != null ? $cb : 'NA'}} - {{$ce != null ? $ce : 'NA'}}</small>
                        </td>
                        <td> {{-- jiquipilas --}}
                            <div class="d-none">{{$jp = null}}</div>
                            <div class="d-none">{{$jb = null}}</div>
                            <div class="d-none">{{$je = null}}</div>
                            @foreach ($group as $item)
                                @if ($item->id_unidad == 2)
                                    @if ($item->backgroundColor == null) 
                                        <div class="d-none">{{$jiquipilas += $item->title}} {{$jp = $item->title}}</div>
                                    @elseif ($item->backgroundColor == '#fceb30')
                                        <div class="d-none">{{$jiquipilasBanco += $item->title}} {{$jb = $item->title}}</div>
                                    @elseif ($item->backgroundColor == '#00ff04')
                                        <div class="d-none">{{$jiquipilasEfectivos += $item->title}} {{$je = $item->title}}</div>
                                    @endif
                                @endif
                            @endforeach
                            <small>{{$jp != null ? $jp : 'NA'}} - {{$jb != null ? $jb : 'NA'}} - {{$je != null ? $je : 'NA'}}</small>
                        </td>
                        <td> {{-- catazaja --}}
                            <div class="d-none">{{$cap = null}}</div>
                            <div class="d-none">{{$cab = null}}</div>
                            <div class="d-none">{{$cae = null}}</div>
                            @foreach ($group as $item)
                                @if ($item->id_unidad == 3)
                                    @if ($item->backgroundColor == null) 
                                        <div class="d-none">{{$catazaja += $item->title}} {{$cap = $item->title}}</div>
                                    @elseif ($item->backgroundColor == '#fceb30')
                                        <div class="d-none">{{$catazajaBanco += $item->title}} {{$cab = $item->title}}</div>
                                    @elseif ($item->backgroundColor == '#00ff04')
                                        <div class="d-none">{{$catazajaEfectivos += $item->title}} {{$cae = $item->title}}</div>
                                    @endif
                                @endif
                            @endforeach
                            <small>{{$cap != null ? $cap : 'NA'}} - {{$cab != null ? $cab : 'NA'}} - {{$cae != null ? $cae : 'NA'}}</small>
                        </td>
                        <td> {{-- reforma --}}
                            <div class="d-none">{{$rp = null}}</div>
                            <div class="d-none">{{$rb = null}}</div>
                            <div class="d-none">{{$re = null}}</div>
                            @foreach ($group as $item)
                                @if ($item->id_unidad == 4)
                                    @if ($item->backgroundColor == null) 
                                        <div class="d-none">{{$reforma += $item->title}} {{$rp = $item->title}}</div>
                                    @elseif ($item->backgroundColor == '#fceb30')
                                        <div class="d-none">{{$reformaBanco += $item->title}} {{$rb = $item->title}}</div>
                                    @elseif ($item->backgroundColor == '#00ff04')
                                        <div class="d-none">{{$reformaEfectivos += $item->title}} {{$re = $item->title}}</div>
                                    @endif
                                @endif
                            @endforeach
                            <small>{{$rp != null ? $rp : 'NA'}} - {{$rb != null ? $rb : 'NA'}} - {{$re != null ? $re : 'NA'}}</small>
                        </td>
                        <td> {{-- tapachula --}}
                            <div class="d-none">{{$tp = null}}</div>
                            <div class="d-none">{{$tb = null}}</div>
                            <div class="d-none">{{$te = null}}</div>
                            @foreach ($group as $item)
                                @if ($item->id_unidad == 5)
                                    @if ($item->backgroundColor == null) 
                                        <div class="d-none">{{$tapachula += $item->title}} {{$tp = $item->title}}</div>
                                    @elseif ($item->backgroundColor == '#fceb30')
                                        <div class="d-none">{{$tapachulaBanco += $item->title}} {{$tb = $item->title}}</div>
                                    @elseif ($item->backgroundColor == '#00ff04')
                                        <div class="d-none">{{$tapachulaEfectivos += $item->title}} {{$te = $item->title}}</div>
                                    @endif
                                @endif
                            @endforeach
                            <small>{{$tp != null ? $tp : 'NA'}} - {{$tb != null ? $tb : 'NA'}} - {{$te != null ? $te : 'NA'}}</small>
                        </td>
                        <td> {{-- san cristobal --}}
                            <div class="d-none">{{$sp = null}}</div>
                            <div class="d-none">{{$sb = null}}</div>
                            <div class="d-none">{{$se = null}}</div>
                            @foreach ($group as $item)
                                @if ($item->id_unidad == 6)
                                    @if ($item->backgroundColor == null) 
                                        <div class="d-none">{{$sanCristobal += $item->title}} {{$sp = $item->title}}</div>
                                    @elseif ($item->backgroundColor == '#fceb30')
                                        <div class="d-none">{{$sanCristobalBanco += $item->title}} {{$sb = $item->title}}</div>
                                    @elseif ($item->backgroundColor == '#00ff04')
                                        <div class="d-none">{{$sanCristobalEfectivos += $item->title}} {{$se = $item->title}}</div>
                                    @endif
                                @endif
                            @endforeach
                            <small>{{$sp != null ? $sp : 'NA'}} - {{$sb != null ? $sb : 'NA'}} - {{$se != null ? $se : 'NA'}}</small>
                        </td>
                        <td> {{-- tuxtla --}}
                            <div class="d-none">{{$tup = null}}</div>
                            <div class="d-none">{{$tub = null}}</div>
                            <div class="d-none">{{$tue = null}}</div>
                            @foreach ($group as $item)
                                @if ($item->id_unidad == 7)
                                    @if ($item->backgroundColor == null) 
                                        <div class="d-none">{{$tuxtla += $item->title}} {{$tup = $item->title}}</div>
                                    @elseif ($item->backgroundColor == '#fceb30')
                                        <div class="d-none">{{$tuxtlaBanco += $item->title}} {{$tub = $item->title}}</div>
                                    @elseif ($item->backgroundColor == '#00ff04')
                                        <div class="d-none">{{$tuxtlaEfectivos += $item->title}} {{$tue = $item->title}}</div>
                                    @endif
                                @endif
                            @endforeach
                            <small>{{$tup != null ? $tup : 'NA'}} - {{$tub != null ? $tub : 'NA'}} - {{$tue != null ? $tue : 'NA'}}</small>
                        </td>
                        <td> {{-- tonala --}}
                            <div class="d-none">{{$top = null}}</div>
                            <div class="d-none">{{$tob = null}}</div>
                            <div class="d-none">{{$toe = null}}</div>
                            @foreach ($group as $item)
                                @if ($item->id_unidad == 8)
                                    @if ($item->backgroundColor == null) 
                                        <div class="d-none">{{$tonala += $item->title}} {{$top = $item->title}}</div>
                                    @elseif ($item->backgroundColor == '#fceb30')
                                        <div class="d-none">{{$tonalaBanco += $item->title}} {{$tob = $item->title}}</div>
                                    @elseif ($item->backgroundColor == '#00ff04')
                                        <div class="d-none">{{$tonalaEfectivos += $item->title}} {{$toe = $item->title}}</div>
                                    @endif
                                @endif
                            @endforeach
                            <small>{{$top != null ? $top : 'NA'}} - {{$tob != null ? $tob : 'NA'}} - {{$toe != null ? $toe : 'NA'}}</small>
                        </td>
                        <td> {{-- ocosingo --}}
                            <div class="d-none">{{$op = null}}</div>
                            <div class="d-none">{{$ob = null}}</div>
                            <div class="d-none">{{$oe = null}}</div>
                            @foreach ($group as $item)
                                @if ($item->id_unidad == 9)
                                    @if ($item->backgroundColor == null) 
                                        <div class="d-none">{{$ocosingo += $item->title}} {{$op = $item->title}}</div>
                                    @elseif ($item->backgroundColor == '#fceb30')
                                        <div class="d-none">{{$ocosingoBanco += $item->title}} {{$ob = $item->title}}</div>
                                    @elseif ($item->backgroundColor == '#00ff04')
                                        <div class="d-none">{{$ocosingoEfectivos += $item->title}} {{$oe = $item->title}}</div>
                                    @endif
                                @endif
                            @endforeach
                            <small>{{$op != null ? $op : 'NA'}} - {{$ob != null ? $ob : 'NA'}} - {{$oe != null ? $oe : 'NA'}}</small>
                        </td>
                        <td> {{-- villaflores --}}
                            <div class="d-none">{{$vp = null}}</div>
                            <div class="d-none">{{$vb = null}}</div>
                            <div class="d-none">{{$ve = null}}</div>
                            @foreach ($group as $item)
                                @if ($item->id_unidad == 10)
                                    @if ($item->backgroundColor == null) 
                                        <div class="d-none">{{$villaflores += $item->title}} {{$vp = $item->title}}</div>
                                    @elseif ($item->backgroundColor == '#fceb30')
                                        <div class="d-none">{{$villafloresBanco += $item->title}} {{$vb = $item->title}}</div>
                                    @elseif ($item->backgroundColor == '#00ff04')
                                        <div class="d-none">{{$villafloresEfectivos += $item->title}} {{$ve = $item->title}}</div>
                                    @endif
                                @endif
                            @endforeach
                            <small>{{$vp != null ? $vp : 'NA'}} - {{$vb != null ? $vb : 'NA'}} - {{$ve != null ? $ve : 'NA'}}</small>
                        </td>
                        <td> {{-- yajalon --}}
                            <div class="d-none">{{$yp = null}}</div>
                            <div class="d-none">{{$yb = null}}</div>
                            <div class="d-none">{{$ye = null}}</div>
                            @foreach ($group as $item)
                                @if ($item->id_unidad == 11)
                                    @if ($item->backgroundColor == null) 
                                        <div class="d-none">{{$yajalon += $item->title}} {{$yp = $item->title}}</div>
                                    @elseif ($item->backgroundColor == '#fceb30')
                                        <div class="d-none">{{$yajalonBanco += $item->title}} {{$yb = $item->title}}</div>
                                    @elseif ($item->backgroundColor == '#00ff04')
                                        <div class="d-none">{{$yajalonEfectivos += $item->title}} {{$ye = $item->title}}</div>
                                    @endif
                                @endif
                            @endforeach
                            <small>{{$yp != null ? $yp : 'NA'}} - {{$yb != null ? $yb : 'NA'}} - {{$ye != null ? $ye : 'NA'}}</small>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td><strong>Totales</strong></td>
                    <td><small><strong>{{$comitan}} - {{$comitanBanco}} - {{$comitanEfectivos}}</strong></small></td>
                    <td><small><strong>{{$jiquipilas}} - {{$jiquipilasBanco}} - {{$jiquipilasEfectivos}}</strong></small></td>
                    <td><small><strong>{{$catazaja}} - {{$catazajaBanco}} - {{$catazajaEfectivos}}</strong></small></td>
                    <td><small><strong>{{$reforma}} - {{$reformaBanco}} - {{$reformaEfectivos}}</strong></small></td>
                    <td><small><strong>{{$tapachula}} - {{$tapachulaBanco}} - {{$tapachulaEfectivos}}</strong></small></td>
                    <td><small><strong>{{$sanCristobal}} - {{$sanCristobalBanco}} - {{$sanCristobalEfectivos}}</strong></small></td>
                    <td><small><strong>{{$tuxtla}} - {{$tuxtlaBanco}} - {{$tuxtlaEfectivos}}</strong></small></td>
                    <td><small><strong>{{$tonala}} - {{$tonalaBanco}} - {{$tonalaEfectivos}}</strong></small></td>
                    <td><small><strong>{{$ocosingo}} - {{$ocosingoBanco}} - {{$ocosingoEfectivos}}</strong></small></td>
                    <td><small><strong>{{$villaflores}} - {{$villafloresBanco}} - {{$villafloresEfectivos}}</strong></small></td>
                    <td><small><strong>{{$yajalon}} - {{$yajalonBanco}} - {{$yajalonEfectivos}}</strong></small></td>
                </tr>
            </tbody>
        </table>

        <div class="row d-flex justify-content-end">
            <button id="btnReporteCronograma" type="button"
                class="btn btn-info mb-4">Generar Reporte</button>
            <form target="_blank" id="formReporteCronograma" action="{{ route('cronogramaPagos.reporte') }}" method="get">@csrf</form>
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