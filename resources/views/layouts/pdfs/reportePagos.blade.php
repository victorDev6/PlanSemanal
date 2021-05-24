<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>REPORTE PAGOS REALIZADOS</title>
    <link rel="stylesheet" type="text/css" href="{{ public_path('vendor/bootstrap/3.4.1/bootstrap.min.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: sans-serif;
        }

        @page {
            margin: 110px 40px 110px;
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
            <div align=center>
                <b>
                    <h6>REPORTE DE PAGOS
                        <br>INSTITUTO DE CAPACITACIÓN Y
                        <br>VINCULACIÓN TECNOLÓGICA DEL ESTADO DE CHIAPAS
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
    <table class="mt-3" width="100%">
        <tbody>
            <tr>
                <td width="20%"><small>UNIDAD DE CAPACITACIÓN:</small></td>
                <td width="80%"> <small><strong>{{$unidad[0]->nombre}}</strong></small></td>
            </tr>
            <tr>
                <td width="20%"><small>RANGO DE FECHA:</td>
                <td width="80%"><small><strong>{{$fechaInicio}}</strong> - <strong>{{$fechaFinal}}</strong></small></td>
            </tr>
            <tr>
                <td width="20%"><small>TOTAL DE PAGOS REALIZADOS:</td>
                <td width="80%"><small><strong>{{$totalPagos}}</strong></small></td>
            </tr>  
        </tbody>
    </table>

    <div class="form-row">
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th scope="col"><small>Fecha</small></th>
                    <th scope="col"><small>Dia</small></th>
                    <th scope="col"><small>Pagos Realizados</small></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pagos as $pago)
                    <tr>
                        <td scope="col">{{$pago->start}}</td>
                        <td scope="col">{{$pago->dia}}</td>
                        <td scope="col">{{$pago->title}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>