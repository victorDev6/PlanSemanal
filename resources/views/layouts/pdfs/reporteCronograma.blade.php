<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>REPORTE CRONOGRAMA DE PAGOS</title>
    <link rel="stylesheet" type="text/css" href="{{ public_path('vendor/bootstrap/3.4.1/bootstrap.min.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: sans-serif;
        }

        @page {
            margin: 110px 10px 110px;
        }

        header {
            position: fixed;
            left: 0px;
            top: -100px;
            right: 0px;
            height: 60px;
            background-color: white;
            color: black;
            text-align: center;
            line-height: 60px;
        }

        header h1 {
            margin: 10px 0;
        }

        header h2 {
            margin: 0 0 10px 0;
        }

        footer {
            position: fixed;
            left: 0px;
            bottom: -90px;
            right: 0px;
            height: 60px;
            background-color: white;
            color: black;
            text-align: center;
        }

        footer .page:after {
            content: counter(page);
        }

        footer table {
            width: 100%;
        }

        footer p {
            text-align: right;
        }

        footer .izq {
            text-align: left;
        }

        img.izquierda {
            float: left;
            width: 300px;
            height: 60px;
        }

        img.izquierdabot {
            float: inline-end;
            width: 450px;
            height: 60px;
        }

        img.derechabot {
            position: absolute;
            left: 700px;
            width: 350px;
            height: 60px;

        }

        img.derecha {
            float: right;
            width: 200px;
            height: 60px;
        }

        div.content {
            margin-top: 60%;
            margin-bottom: 70%;
            margin-right: -25%;
            margin-left: 0%;
        }

    </style>
</head>

<body>
    <header>
        <img class="izquierda" src="{{ public_path('img/instituto_oficial.png') }}">
        <img class="derecha" src="{{ public_path('img/chiapas.png') }}">
        {{-- <br> --}}
        <div id="wrapper">
            <div >
                <b>
                    <h6>
                        <br>INSTITUTO DE CAPACITACIÓN Y VINCULACIÓN TECNOLÓGICA DEL ESTADO DE CHIAPAS
                        <br>CURSOS PARA PAGO DE HONORARIOS-MODALIDAD: CAPACITACIÓN A DISTANCIA
                        <br>CRONOGRAMA DE PAGOS POR UNIDAD DE CAPACITACIÓN (VALIDADOS EN EL SISTEMA SIVYC)
                    </h6>
                    <h6>"2021, Año de la Independencia"</h6>
                </b>
            </div>
        </div>
        <br>
    </header>
    <footer>
        <img class="izquierdabot" src="{{ public_path('img/franja.png') }}">
        <img class="derechabot" src="{{ public_path('img/icatech-imagen.png') }}">
    </footer>

    {{-- <br> --}}
    <div style="display: none">{{$comitan = 0, $jiquipilas = 0, $catazaja = 0, $reforma = 0, $tapachula = 0, $sanCristobal = 0, $tuxtla = 0, 
        $tonala = 0, $ocosingo = 0, $villaflores = 0, $yajalon = 0}}</div>
    
    <table>
        <tbody>
            <tr>
                <td>Rango de Fechas:</td>
                <td> </td>
                <td>{{$fechaInicio}} - {{$fechaTermino}}</td>
            </tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td><small><strong>PP</strong> - Pagos Programados</small></td>
                <td> </td><td> </td><td> </td>
                <td><small><strong>CB</strong> - Pagos Cargados al Banco</small></td>
                <td> </td><td> </td><td> </td>
                <td><small><strong>EP</strong> - Pagos Efectivamente Pagados</small></td>
                <td> </td><td> </td><td> </td>
                <td><small><strong>NA</strong> - No Agregado</small></td>
            </tr>
        </tbody>
    </table>
    
    <div style="display: none"> {{$cp = null, $cb = null, $ce = null, $jp = null, $jb = null, $je = null,
            $cap = null, $cab = null, $cae = null, $rp = null, $rb = null, $re = null,
            $tp = null, $tb = null, $te = null, $sp = null, $sb = null, $se = null,
            $tup = null, $tub = null, $tue = null, $top = null, $tob = null, $toe = null,
            $op = null, $ob = null, $oe = null, $vp = null, $vb = null, $ve = null,
            $yp = null, $yb = null, $ye = null}}</div>
    <div style="display: none">{{$comitan = 0, $comitanBanco = 0, $comitanEfectivos = 0,  $jiquipilas = 0, $jiquipilasBanco = 0, $jiquipilasEfectivos = 0, 
            $catazaja = 0, $catazajaBanco = 0, $catazajaEfectivos = 0, $reforma = 0, $reformaBanco = 0, $reformaEfectivos = 0, 
            $tapachula = 0, $tapachulaBanco = 0, $tapachulaEfectivos = 0, $sanCristobal = 0, $sanCristobalBanco = 0, $sanCristobalEfectivos = 0, 
            $tuxtla = 0, $tuxtlaBanco = 0, $tuxtlaEfectivos = 0,$tonala = 0, $tonalaBanco = 0, $tonalaEfectivos = 0, 
            $ocosingo = 0, $ocosingoBanco = 0, $ocosingoEfectivos = 0, $villaflores = 0, $villafloresBanco = 0, $villafloresEfectivos = 0, 
            $yajalon = 0, $yajalonBanco = 0, $yajalonEfectivos = 0}}</div>

    <table class="table table-bordered table-striped">
        <thead class="thead-light">
            <tr>
                <td><small>Unidades de Capacitación</small></td>
                @foreach ($unidades as $unidad)
                {{-- th --}}
                    <td><small>{{$unidad->nombre}} <br> PP - CB - EP</small></td>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($grouped as $group)
                <tr>
                    <td><small>{{$group[0]->start}}</small></td>
                    <td> {{-- comitan --}}
                        <div style="display: none">{{$cp = null}}</div>
                        <div style="display: none">{{$cb = null}}</div>
                        <div style="display: none">{{$ce = null}}</div>
                        @foreach ($group as $item)
                            @if ($item->id_unidad == 1)
                                @if ($item->backgroundColor == null) 
                                    <div style="display: none">{{$comitan += $item->title}} {{$cp = $item->title}}</div>
                                @elseif ($item->backgroundColor == '#fceb30')
                                    <div style="display: none">{{$comitanBanco += $item->title}} {{$cb = $item->title}}</div>
                                @elseif ($item->backgroundColor == '#00ff04')
                                    <div style="display: none">{{$comitanEfectivos += $item->title}} {{$ce = $item->title}}</div>
                                @endif
                            @endif
                        @endforeach
                        <small>{{$cp != null ? $cp : 'NA'}} - {{$cb != null ? $cb : 'NA'}} - {{$ce != null ? $ce : 'NA'}}</small>
                    </td>
                    <td> {{-- jiquipilas --}}
                        <div style="display: none">{{$jp = null}}</div>
                        <div style="display: none">{{$jb = null}}</div>
                        <div style="display: none">{{$je = null}}</div>
                        @foreach ($group as $item)
                            @if ($item->id_unidad == 2)
                                @if ($item->backgroundColor == null) 
                                    <div style="display: none">{{$jiquipilas += $item->title}} {{$jp = $item->title}}</div>
                                @elseif ($item->backgroundColor == '#fceb30')
                                    <div style="display: none">{{$jiquipilasBanco += $item->title}} {{$jb = $item->title}}</div>
                                @elseif ($item->backgroundColor == '#00ff04')
                                    <div style="display: none">{{$jiquipilasEfectivos += $item->title}} {{$je = $item->title}}</div>
                                @endif
                            @endif
                        @endforeach
                        <small>{{$jp != null ? $jp : 'NA'}} - {{$jb != null ? $jb : 'NA'}} - {{$je != null ? $je : 'NA'}}</small>
                    </td>
                    <td> {{-- catazaja --}}
                        <div style="display: none">{{$cap = null}}</div>
                        <div style="display: none">{{$cab = null}}</div>
                        <div style="display: none">{{$cae = null}}</div>
                        @foreach ($group as $item)
                            @if ($item->id_unidad == 3)
                                @if ($item->backgroundColor == null) 
                                    <div style="display: none">{{$catazaja += $item->title}} {{$cap = $item->title}}</div>
                                @elseif ($item->backgroundColor == '#fceb30')
                                    <div style="display: none">{{$catazajaBanco += $item->title}} {{$cab = $item->title}}</div>
                                @elseif ($item->backgroundColor == '#00ff04')
                                    <div style="display: none">{{$catazajaEfectivos += $item->title}} {{$cae = $item->title}}</div>
                                @endif
                            @endif
                        @endforeach
                        <small>{{$cap != null ? $cap : 'NA'}} - {{$cab != null ? $cab : 'NA'}} - {{$cae != null ? $cae : 'NA'}}</small>
                    </td>
                    <td> {{-- reforma --}}
                        <div style="display: none">{{$rp = null}}</div>
                        <div style="display: none">{{$rb = null}}</div>
                        <div style="display: none">{{$re = null}}</div>
                        @foreach ($group as $item)
                            @if ($item->id_unidad == 4)
                                @if ($item->backgroundColor == null) 
                                    <div style="display: none">{{$reforma += $item->title}} {{$rp = $item->title}}</div>
                                @elseif ($item->backgroundColor == '#fceb30')
                                    <div style="display: none">{{$reformaBanco += $item->title}} {{$rb = $item->title}}</div>
                                @elseif ($item->backgroundColor == '#00ff04')
                                    <div style="display: none">{{$reformaEfectivos += $item->title}} {{$re = $item->title}}</div>
                                @endif
                            @endif
                        @endforeach
                        <small>{{$rp != null ? $rp : 'NA'}} - {{$rb != null ? $rb : 'NA'}} - {{$re != null ? $re : 'NA'}}</small>
                    </td>
                    <td> {{-- tapachula --}}
                        <div style="display: none">{{$tp = null}}</div>
                        <div style="display: none">{{$tb = null}}</div>
                        <div style="display: none">{{$te = null}}</div>
                        @foreach ($group as $item)
                            @if ($item->id_unidad == 5)
                                @if ($item->backgroundColor == null) 
                                    <div style="display: none">{{$tapachula += $item->title}} {{$tp = $item->title}}</div>
                                @elseif ($item->backgroundColor == '#fceb30')
                                    <div style="display: none">{{$tapachulaBanco += $item->title}} {{$tb = $item->title}}</div>
                                @elseif ($item->backgroundColor == '#00ff04')
                                    <div style="display: none">{{$tapachulaEfectivos += $item->title}} {{$te = $item->title}}</div>
                                @endif
                            @endif
                        @endforeach
                        <small>{{$tp != null ? $tp : 'NA'}} - {{$tb != null ? $tb : 'NA'}} - {{$te != null ? $te : 'NA'}}</small>
                    </td>
                    <td> {{-- san cristobal --}}
                        <div style="display: none">{{$sp = null}}</div>
                        <div style="display: none">{{$sb = null}}</div>
                        <div style="display: none">{{$se = null}}</div>
                        @foreach ($group as $item)
                            @if ($item->id_unidad == 6)
                                @if ($item->backgroundColor == null) 
                                    <div style="display: none">{{$sanCristobal += $item->title}} {{$sp = $item->title}}</div>
                                @elseif ($item->backgroundColor == '#fceb30')
                                    <div style="display: none">{{$sanCristobalBanco += $item->title}} {{$sb = $item->title}}</div>
                                @elseif ($item->backgroundColor == '#00ff04')
                                    <div style="display: none">{{$sanCristobalEfectivos += $item->title}} {{$se = $item->title}}</div>
                                @endif
                            @endif
                        @endforeach
                        <small>{{$sp != null ? $sp : 'NA'}} - {{$sb != null ? $sb : 'NA'}} - {{$se != null ? $se : 'NA'}}</small>
                    </td>
                    <td> {{-- tuxtla --}}
                        <div style="display: none">{{$tup = null}}</div>
                        <div style="display: none">{{$tub = null}}</div>
                        <div style="display: none">{{$tue = null}}</div>
                        @foreach ($group as $item)
                            @if ($item->id_unidad == 7)
                                @if ($item->backgroundColor == null) 
                                    <div style="display: none">{{$tuxtla += $item->title}} {{$tup = $item->title}}</div>
                                @elseif ($item->backgroundColor == '#fceb30')
                                    <div style="display: none">{{$tuxtlaBanco += $item->title}} {{$tub = $item->title}}</div>
                                @elseif ($item->backgroundColor == '#00ff04')
                                    <div style="display: none">{{$tuxtlaEfectivos += $item->title}} {{$tue = $item->title}}</div>
                                @endif
                            @endif
                        @endforeach
                        <small>{{$tup != null ? $tup : 'NA'}} - {{$tub != null ? $tub : 'NA'}} - {{$tue != null ? $tue : 'NA'}}</small>
                    </td>
                    <td> {{-- tonala --}}
                        <div style="display: none">{{$top = null}}</div>
                        <div style="display: none">{{$tob = null}}</div>
                        <div style="display: none">{{$toe = null}}</div>
                        @foreach ($group as $item)
                            @if ($item->id_unidad == 8)
                                @if ($item->backgroundColor == null) 
                                    <div style="display: none">{{$tonala += $item->title}} {{$top = $item->title}}</div>
                                @elseif ($item->backgroundColor == '#fceb30')
                                    <div style="display: none">{{$tonalaBanco += $item->title}} {{$tob = $item->title}}</div>
                                @elseif ($item->backgroundColor == '#00ff04')
                                    <div style="display: none">{{$tonalaEfectivos += $item->title}} {{$toe = $item->title}}</div>
                                @endif
                            @endif
                        @endforeach
                        <small>{{$top != null ? $top : 'NA'}} - {{$tob != null ? $tob : 'NA'}} - {{$toe != null ? $toe : 'NA'}}</small>
                    </td>
                    <td> {{-- ocosingo --}}
                        <div style="display: none">{{$op = null}}</div>
                        <div style="display: none">{{$ob = null}}</div>
                        <div style="display: none">{{$oe = null}}</div>
                        @foreach ($group as $item)
                            @if ($item->id_unidad == 9)
                                @if ($item->backgroundColor == null) 
                                    <div style="display: none">{{$ocosingo += $item->title}} {{$op = $item->title}}</div>
                                @elseif ($item->backgroundColor == '#fceb30')
                                    <div style="display: none">{{$ocosingoBanco += $item->title}} {{$ob = $item->title}}</div>
                                @elseif ($item->backgroundColor == '#00ff04')
                                    <div style="display: none">{{$ocosingoEfectivos += $item->title}} {{$oe = $item->title}}</div>
                                @endif
                            @endif
                        @endforeach
                        <small>{{$op != null ? $op : 'NA'}} - {{$ob != null ? $ob : 'NA'}} - {{$oe != null ? $oe : 'NA'}}</small>
                    </td>
                    <td> {{-- villaflores --}}
                        <div style="display: none">{{$vp = null}}</div>
                        <div style="display: none">{{$vb = null}}</div>
                        <div style="display: none">{{$ve = null}}</div>
                        @foreach ($group as $item)
                            @if ($item->id_unidad == 10)
                                @if ($item->backgroundColor == null) 
                                    <div style="display: none">{{$villaflores += $item->title}} {{$vp = $item->title}}</div>
                                @elseif ($item->backgroundColor == '#fceb30')
                                    <div style="display: none">{{$villafloresBanco += $item->title}} {{$vb = $item->title}}</div>
                                @elseif ($item->backgroundColor == '#00ff04')
                                    <div style="display: none">{{$villafloresEfectivos += $item->title}} {{$ve = $item->title}}</div>
                                @endif
                            @endif
                        @endforeach
                        <small>{{$vp != null ? $vp : 'NA'}} - {{$vb != null ? $vb : 'NA'}} - {{$ve != null ? $ve : 'NA'}}</small>
                    </td>
                    <td> {{-- yajalon --}}
                        <div style="display: none">{{$yp = null}}</div>
                        <div style="display: none">{{$yb = null}}</div>
                        <div style="display: none">{{$ye = null}}</div>
                        @foreach ($group as $item)
                            @if ($item->id_unidad == 11)
                                @if ($item->backgroundColor == null) 
                                    <div style="display: none">{{$yajalon += $item->title}} {{$yp = $item->title}}</div>
                                @elseif ($item->backgroundColor == '#fceb30')
                                    <div style="display: none">{{$yajalonBanco += $item->title}} {{$yb = $item->title}}</div>
                                @elseif ($item->backgroundColor == '#00ff04')
                                    <div style="display: none">{{$yajalonEfectivos += $item->title}} {{$ye = $item->title}}</div>
                                @endif
                            @endif
                        @endforeach
                        <small>{{$yp != null ? $yp : 'NA'}} - {{$yb != null ? $yb : 'NA'}} - {{$ye != null ? $ye : 'NA'}}</small>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td><strong>Totales</strong></td>
                <td><small><strong><small>{{$comitan}} - {{$comitanBanco}} - {{$comitanEfectivos}}</small></strong></small></td>
                <td><small><strong><small>{{$jiquipilas}} - {{$jiquipilasBanco}} - {{$jiquipilasEfectivos}}</small></strong></small></td>
                <td><small><strong><small>{{$catazaja}} - {{$catazajaBanco}} - {{$catazajaEfectivos}}</small></strong></small></td>
                <td><small><strong><small>{{$reforma}} - {{$reformaBanco}} - {{$reformaEfectivos}}</small></strong></small></td>
                <td><small><strong><small>{{$tapachula}} - {{$tapachulaBanco}} - {{$tapachulaEfectivos}}</small></strong></small></td>
                <td><small><strong><small>{{$sanCristobal}} - {{$sanCristobalBanco}} - {{$sanCristobalEfectivos}}</small></strong></small></td>
                <td><small><strong><small>{{$tuxtla}} - {{$tuxtlaBanco}} - {{$tuxtlaEfectivos}}</small></strong></small></td>
                <td><small><strong><small>{{$tonala}} - {{$tonalaBanco}} - {{$tonalaEfectivos}}</small></strong></small></td>
                <td><small><strong><small>{{$ocosingo}} - {{$ocosingoBanco}} - {{$ocosingoEfectivos}}</small></strong></small></td>
                <td><small><strong><small>{{$villaflores}} - {{$villafloresBanco}} - {{$villafloresEfectivos}}</small></strong></small></td>
                <td><small><strong><small>{{$yajalon}} - {{$yajalonBanco}} - {{$yajalonEfectivos}}</small></strong></small></td>
            </tr>
        </tbody>
    </table>


</body>