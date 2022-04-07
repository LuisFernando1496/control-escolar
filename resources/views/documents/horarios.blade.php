<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Horarios</title>
</head>
<body>
    
    <div style="margin-left: auto;
                        margin-right: auto; width: 30em;">
        <span style="
                                font-size:11px; 
                                width: 60%;
                                padding: 20px;
                                text-align: justify;
                                font-size: small;
                                margin-left: auto;
                                margin-right: auto;
                                ">
            <b>
                SUBSECRETARIA DE EDUCACION ESTATAL
                <br>
                DIRECCION DE EDUCACION BASICA
                <br>
                DEPARTAMENTO DE EDUCACION TELESECUNDARIA
                <br>
                JEFATURA DE SECTOR 02 ZONA ESCOLAR 029
                <br>
                {{ strtoupper($school->name) }}
                <br>
                C.C.T. 07ETV0653N
                <br>
                EJIDO CATEDRAL DE CHIAPAS, MPIO. OSTUACAN, CHIAPAS.
                <br>
                <br>
            </b>
        </span>
    </div>
    <div class="row-fluid">
        <span style="float:right;">
            Ciclo Escolar {{ $date->format('Y') }} - {{ $date->addYear(1)->format('Y') }}
        </span>
        <span style="float: left;">
            Grado: {{ $grade->description }} | Grupo: {{ $group->name }}
        </span>
        <br>
        <div style="text-align: center;">
            Horario de clases
            </span>
        </div>

        {{-- cuerpo del documento --}}
        <table style="width: 100%;">
            {{-- cabezera de esto --}}
            <thead>
                <tr>
                    <th>Hora</th>
                    <th>Lunes</th>
                    <th>Martes</th>
                    <th>Miercoles</th>
                    <th>Jueves</th>
                    <th>Viernes</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($schedules as $keyOne )
                    <tr>
                       @include('documents.shedule-horas', [$keyOne])
                
                         @foreach ($dias as $keyDay => $materia)
                            <td style="width: 10em;">
                                {{ $materia['materia'] }}
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
</body>
</html>