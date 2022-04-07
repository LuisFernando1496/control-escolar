@extends('documents.template')
@section('title')
    Carta de Buena Conducta
@endsection
@section('header')
    <img src="{{asset('/images/secretaria.png')}}" alt="" class="left logo">
    <span class="right letterhead">
        SECRETARIA DE EDUCACIÓN
        <br>
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
    </span>
@endsection
@section('content')
    <div class="adjust">
        <span class="subject">
            ASUNTO: Carta de conducta.
        </span>
        <br>
        <br>
        <span class="greeting">
            <u>
                A QUIEN CORRESPONDA:
            </u>
        </span>
        <br>
        <p class="message justify">
            EL QUE SUSCRIBE, {{strtoupper($school->boss)}}, DIRECTOR DE LA ESCUELA TELESECUNDARIA 649 “ JOSÉ VASCONCELOS CALDERÓN ", CLAVE: 07ETV0653N DEL EJIDO CATEDRAL DE CHIAPAS, MUNICIPIO DE OSTUACAN, CHIAPAS:
        </p>
        <div class="center">
            HACE CONSTAR:
        </div>
        <p class="message justify">
            QUE LA ALUMNA:  {{strtoupper($student->user->fullname())}}, CON NUMERO DE MATRICULA {{strtoupper($student->user->key)}}, DURANTE SU ESTANCIA EN ESTA INSTITUCION EDUCATIVA OBSERVO:
        </p>
        <div class="center">
            <br><br>
            <u>
                {{strtoupper($behaviour)}} CONDUCTA.
            </u>
            <br><br>
            <br>
        </div>
        <p class="message">
            PARA LOS FINES LEGALES Y CONDUCENTES QUE LA INTERESADA CONVENGAN, SE EXTIENDE LA PRESENTE CARTA DE CONDUCTA, EN EL EJIDO CATEDRAL DE CHIAPAS, MUNICIPIO DE OSTUACÁN, CHIAPAS A LOS {{$now->format('j')}} DIAS DEL MES DE {{strtoupper($month)}} DEL {{$now->format('Y')}}.
        </p>
        <br>
        <div class="center sign">
            ATENTAMENTE.
            <br>
            EL DIRECTOR DE LA ESCUELA.
            <br>
            <p class="boss">
                {{$school->boss}}.
            </p>
        </div>
    </div>
    <style>
        .adjust{
            margin-left: 45px;
        }
        .logo{
            padding: 44px 10px;
        }
        .letterhead{
            width: 55%;
            padding: 20px;
            text-align: left;
            font-size: small;
        }
        .right{
            float:right;
        }
        .left{
            float: left;
        }
        .justify{
            text-align: justify;
        }
        .subject{
           position: absolute;
           top: 0;
           right: 0;
        }
        .center{
            text-align: center;
        }
        .sign{
            font-style: italic;
            font-weight: 500;
        }
    </style>
@endsection
