@extends('documents.template')
@php
    $max = 5;
@endphp
@section('header')
    <img src="{{asset('/images/secretaria.png')}}" alt="logo" class="left logo">
    <span class="right letterhead" style="font-size:11px">
        <b>
            SUBSECRETARIA DE EDUCACION ESTATAL
            <br>
            DIRECCION DE EDUCACION BASICA
            <br>
            DEPARTAMENTO DE EDUCACION TELESECUNDARIA
            <br>
            JEFATURA DE SECTOR 02 ZONA ESCOLAR 029
            <br>
            {{strtoupper($school->name)}}
            <br>
            C.C.T.   07ETV0653N
            <br>
            EJIDO CATEDRAL DE CHIAPAS, MPIO. OSTUACAN, CHIAPAS.
            <br>
            <br>
        </b>
    </span>
@endsection
@section('content')
    <span class="right">
        Ciclo Escolar {{$date->format('Y')}} - {{$date->addYear(1)->format('Y')}}
    </span>
    <span class="left">
        Grado: {{$grade->description}}  |  Grupo: {{$group->name}}
    </span>
    <br>
    <div class="center">
        Lista de asistencia del mes de {{$month}}
    </span>
    <table id="table" style="font-size: 11px;">
        <thead>
            <tr>
                <th>No</th>
                <th>Estudiante</th>
                <th>Clave</th>
                @for($i = 0; $i < $max; $i++ )
                <th>L</th>
                <th>M</th>
                <th>M</th>
                <th>J&nbsp;</th>
                <th>V</th>
                @endfor
            </tr>
        </thead>
        <tbody>

            @foreach($students as $student)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$student->user->fullname()}}</td>
                    <td>{{$student->user->key}}</td>
                    @for($i = 0; $i < $max*5; $i++ )
                        <td>&nbsp;</td>
                    @endfor
                </tr>
                @if($loop->iteration % 15 == 0)
                    <div class="page-break"></div>
                @endif
            @endforeach

        </tbody>
    </table>
    <br>
    <div class="center margin" style="font-size: 11px;">
        <span class="left">ASESOR DEL GRUPO <br> {{$user->fullname()}} </span>
        <span class="right">VTO. BNO.  <br>EL DIRECTOR DE LA ESCUELA<br>{{$school->boss}}</span>
    </div>
<style>
    table{
        width: 100%;
        margin-bottom: 10px;
        text-align: center;
        border-collapse: separate;
        border-spacing: 1px;
        border-color: darkolivegreen;
        border-style: solid;
        border-width: 1px;
    }
    table td,
    table th {
        border-left: 0;
        border-right: 0.05em solid darkolivegreen;
        border-top: 0;
        border-bottom: 0.05em solid darkolivegreen;
    }
    .content{
        top: 170px !important;
    }
    .logo{
        padding: 5px 25px;
        width: 170px;
        max-width: 170px;
    }
    .letterhead{
        width: 60%;
        padding: 20px;
        text-align: left;
        font-size: small;
    }
    .margin{
        margin-top: 10px;
        margin-left: 50px;
        margin-right: 50px;
    }
    .page-break {
        page-break-after: always;
    }
</style>
@endsection
