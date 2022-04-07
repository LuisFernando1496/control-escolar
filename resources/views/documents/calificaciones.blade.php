@extends('documents.base')
@section('content')
<style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    th {
        text-align: center;
    }
    td {
        text-align: center;
    }

</style>
    <img src="images/secretaria.png">
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
        
        </span>
        <br>
        <div style="text-align: center;">
            Boleta de calificaciones: {{$student->user->fullname()}} <br>
            Tutor: {{$user->fullname()}}
            </span>
        </div>

        {{-- cuerpo del documento --}}
        <table style="width: 100%;"> 
            <thead>
               
                <tr class="flex flex-col flex-no wrap sm:table-row">
                    <th scope="col"
                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bimestre</th>
                    @if ($subjects)
                        @foreach ($subjects as $subject)
                            <th scope="col"
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{$subject->name}}
                            </th>
                        @endforeach
                    @endif
                    <th scope="col"
                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Promedio</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @if($students->count() > 0)
                    @foreach ($students as $student)
                        @foreach (\App\Models\Bimester::all() as $bimester)
                            @if (($grade_id - 1) * 6 < ($bimester->number) && $grade_id * 6 >= intval($bimester->number))
                                <tr class="flex flex-col flex-no wrap sm:table-row {{$student->banned ? 'bg-red-100': ''}}">
                                    <td class="px-6 py-4 whitespace-nowrap text-left">Bimestre {{$bimester->number}}</td>
                                    @if ($subjects)
                                        @foreach ($subjects as $subject)
                                            <td class="px-6 py-4 whitespace-nowrap text-left">
                                                @php
                                                    $score = $student->scoreBySubject($subject->id,$bimester->id);
                                                @endphp
                                              
                                                    
                                                    <label class="text-black text-bold">{{$score?$score->score:'Sin Captura'}}</label>
                                               
                                                   
                                            </td>
                                        @endforeach
                                    @endif
                                    <td class="px-6 py-4 whitespace-nowrap text-left">{{$student->bimesterAverage($bimester->id)}}</td>
                                </tr>
                            @endif
                        @endforeach
                    @endforeach
                    <tr class="flex flex-col flex-no wrap sm:table-row">
                        <td colspan="11" class="px-6 py-4 whitespace-nowrap text-right">
                            <span class="border border-purple-500 rounded-lg px-3 py-1">
                                Promedio Anual: {{$student->yearAverage()}}
                            </span>
                            <span class="border border-purple-500 rounded-lg px-3 py-1">
                                Promedio General: {{$student->average()}}
                            </span>
                        </td>
                    </tr>
                @else
                    <p class="bg-red-600 w-full px-5 py-5 text-center mx-auto block text-red-200">No hay registros</p>
                @endif
            </tbody>
        </table>
    @endsection