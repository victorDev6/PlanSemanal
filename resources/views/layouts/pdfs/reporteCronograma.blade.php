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

    <br>
    <div style="display: none">{{$comitan = 0, $jiquipilas = 0, $catazaja = 0, $reforma = 0, $tapachula = 0, $sanCristobal = 0, $tuxtla = 0, 
        $tonala = 0, $ocosingo = 0, $villaflores = 0, $yajalon = 0}}</div>
    <table class="table table-bordered table-striped">
        <thead class="thead-light">
            <tr>
                <th><small>Unidades de Capacitación</small></th>
                @foreach ($unidades as $unidad)
                    <th><small>{{$unidad->nombre}}</small></th>
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
                                <div style="display: none">{{$comitan += $item->title}}</div>
                            @endif
                        @endforeach
                    </td>
                    <td> {{-- jiquipilas --}}
                        @foreach ($group as $item)
                            @if ($item->id_unidad == 2)
                                {{$item->title}}
                                <div style="display: none">{{$jiquipilas += $item->title}}</div>
                            @endif
                        @endforeach
                    </td>
                    <td> {{-- catazaja --}}
                        @foreach ($group as $item)
                            @if ($item->id_unidad == 3)
                                {{$item->title}}
                                <div style="display: none">{{$catazaja += $item->title}}</div>
                            @endif
                        @endforeach
                    </td>
                    <td> {{-- reforma --}}
                        @foreach ($group as $item)
                            @if ($item->id_unidad == 4)
                                {{$item->title}}
                                <div style="display: none">{{$reforma += $item->title}}</div>
                            @endif
                        @endforeach
                    </td>
                    <td> {{-- tapachula --}}
                        @foreach ($group as $item)
                            @if ($item->id_unidad == 5)
                                {{$item->title}}
                                <div style="display: none">{{$tapachula += $item->title}}</div>
                            @endif
                        @endforeach
                    </td>
                    <td> {{-- san cristobal --}}
                        @foreach ($group as $item)
                            @if ($item->id_unidad == 6)
                                {{$item->title}}
                                <div style="display: none">{{$sanCristobal += $item->title}}</div>
                            @endif
                        @endforeach
                    </td>
                    <td> {{-- tuxtla --}}
                        @foreach ($group as $item)
                            @if ($item->id_unidad == 7)
                                {{$item->title}}
                                <div style="display: none">{{$tuxtla += $item->title}}</div>
                            @endif
                        @endforeach
                    </td>
                    <td> {{-- tonala --}}
                        @foreach ($group as $item)
                            @if ($item->id_unidad == 8)
                                {{$item->title}}
                                <div style="display: none">{{$tonala += $item->title}}</div>
                            @endif
                        @endforeach
                    </td>
                    <td> {{-- ocosingo --}}
                        @foreach ($group as $item)
                            @if ($item->id_unidad == 9)
                                {{$item->title}}
                                <div style="display: none">{{$ocosingo += $item->title}}</div>
                            @endif
                        @endforeach
                    </td>
                    <td> {{-- villaflores --}}
                        @foreach ($group as $item)
                            @if ($item->id_unidad == 10)
                                {{$item->title}}
                                <div style="display: none">{{$villaflores += $item->title}}</div>
                            @endif
                        @endforeach
                    </td>
                    <td> {{-- yajalon --}}
                        @foreach ($group as $item)
                            @if ($item->id_unidad == 11)
                                {{$item->title}}
                                <div style="display: none">{{$yajalon += $item->title}}</div>
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


</body>