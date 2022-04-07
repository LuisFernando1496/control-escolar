<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Calificaciones') }}
        </h2>
    </x-slot>
    <div>
        <div class="max-w-auto mx-auto sm:px-6 lg:px-8 py-5">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="mt-5 mx-5 flex flex-col">
                    @if($isStudent||$isTutor)
                        <button class="bg-indigo-500 text-indigo-100 rounded-lg px-3 py-1 mx-5" wire:click="toggle()">{{$kardexMode?'Modo Seleccion':'Modo Kardex'}}</button>
                    @endif
                    
                    <div class="md:flex md:flex-row sm:flex-col border border-solid border-indigo-700 rounded-lg px-5 my-3 py-3">
                        <button class="bg-indigo-500 text-indigo-100 rounded-lg px-3 py-1 mx-5" wire:click="dscargarPdfScore()">Descragar Boleta</button>
                        <label for="group_id" class="px-2">Grupo</label>
                        @if ($isStudent||$isTutor)
                            {{\App\Models\Group::find($group_id)->name}}
                        @else
                            <select wire:model="group_id" id="group_id" class="px-2">
                                <option>Seleccione el grado</option>
                                @foreach (\App\Models\Group::all() as $group)
                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                @endforeach
                            </select>
                        @endif
                        <label for="grade_id" class="px-2">Grado</label>
                        <select wire:model="grade_id" id="grade_id" class="px-2" wire:change="$set('bimester_id',null)">
                            <option>Seleccione el grupo</option>
                            @foreach (\App\Models\Grade::all() as $grade)
                                <option value="{{$grade->id}}">{{$grade->number}}</option>
                            @endforeach
                        </select>
                        @if (!$kardexMode)
                        
                            <label for="bimester_id" class="px-2">Bimestre</label>
                            <select wire:model="bimester_id" id="bimester_id" class="px-2">
                                <option>Seleccione el bimestre</option>
                                @foreach (\App\Models\Bimester::all() as $bimester)
                                    @if (($grade_id - 1) * 6 < ($bimester->number) && $grade_id * 6 >= intval($bimester->number))
                                        <option value="{{$bimester->id}}">{{$bimester->number}}</option>
                                    @endif
                                @endforeach
                            </select>
                        @endif
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                {{-- table --}}
                                @if ($kardexMode)
                                    <table class="min-w-full divide-y divide-gray-200 flex flex-row flex-no-wrap text-left">
                                        <thead>
                                           
                                            <tr class="flex flex-col flex-no wrap sm:table-row">
                                                <th colspan="11"  class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                                    Estudiante: {{$student_->user->fullname()}}
                                                </th>
                                            </tr>
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
                                                                            @if ($isStudent || $isTutor)
                                                                                <span class="extra-info">{{$subject->name}}</span>
                                                                                <label class="text-black text-bold">{{$score?$score->score:'Sin Captura'}}</label>
                                                                            @else
                                                                                @if($student_ && $student->id == $student_->id)
                                                                                    <input class="boeder border-indigo-500 rounded-lg px-2" wire:model="scoreRow.s{{$subject->id}}" type="number" max="10" min="0" step="0.1" placeholder="0">
                                                                                @else
                                                                                    <label class="text-black text-bold">{{$score?$score->score:'Sin Captura'}}</label>
                                                                                @endif
                                                                            @endif
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
                                                            Promedio Anual: {{$student_->yearAverage()}}
                                                        </span>
                                                        <span class="border border-purple-500 rounded-lg px-3 py-1">
                                                            Promedio General: {{$student_->average()}}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @else
                                                <p class="bg-red-600 w-full px-5 py-5 text-center mx-auto block text-red-200">No hay registros</p>
                                            @endif
                                        </tbody>
                                    </table>
                                @else
                                    @if($bimester_id && $group_id && $grade_id)
                                        <table class="min-w-full divide-y divide-gray-200 flex flex-row flex-no-wrap text-left">
                                            <thead>
                                                <tr class="flex flex-col flex-no wrap sm:table-row">
                                                    <th scope="col"
                                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Estudiante
                                                    </th>
                                                    @if ($subjects)
                                                        @foreach ($subjects as $subject)
                                                            <th scope="col"
                                                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                {{$subject->name}}
                                                            </th>
                                                        @endforeach
                                                    @endif
                                                    <th>
                                                        Acciones
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @if($students->count() > 0)
                                                    @foreach ($students as $student)
                                                        <tr class="flex flex-col flex-no wrap sm:table-row {{$student->banned ? 'bg-red-100': ''}}">
                                                            {{-- Estudiante --}}
                                                            <td class="touchable px-6 py-4 whitespace-nowrap text-left hover:bg-indigo-400 @if($student_ && $student->id == $student_->id) bg-indigo-600 text-white rounded-lg @endif" wire:click="setStudent('{{$student->id}}')">
                                                                <div style="inline-flex">
                                                                    {{$student->user->fullname()}}
                                                                    <br>
                                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full @if($student->user->active && !$student->banned) bg-green-100 text-green-800 @else bg-red-100 text-red-800  @endif">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="1rem">
                                                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                                                        </svg>
                                                                        <b class="px-2">{{$student->user->key}}</b>
                                                                        {{$student->user->active ? 'Activo': 'Inactivo'}}
                                                                    </span>
                                                                </div>
                                                            </td>
                                                            @if ($subjects)
                                                                @foreach ($subjects as $subject)
                                                                    <td class="px-6 py-4 whitespace-nowrap text-left">
                                                                        @php
                                                                            $score = $student->scoreBySubject($subject->id,$bimester_id);
                                                                        @endphp
                                                                        @if ($isStudent || $isTutor)
                                                                            <span class="extra-info">{{$subject->name}}</span>
                                                                            <label class="text-black text-bold">{{$score?$score->score:'Sin Captura'}}</label>
                                                                        @else
                                                                            @if($student_ && $student->id == $student_->id )
                                                                              <input class="boeder border-indigo-500 rounded-lg px-2" wire:model="scoreRow.s{{$subject->id}}" type="number" max="10" min="0" step="0.1" placeholder="0">
                                                                            @else
                                                                                <span class="extra-info">{{$subject->name}}</span>
                                                                                <label class="text-black text-bold">{{$score?$score->score:'Sin Captura'}}</label>
                                                                            @endif
                                                                        @endif
                                                                    </td>
                                                                @endforeach
                                                            @endif
                                                            <td>
                                                                <div class=" inline-flex">
                                                                    @if ($isStudent || $isTutor)
                                                                        📗📘📙
                                                                    @else
                                                                        <button class="mx-1 px-3 py-2 bg-indigo-600 text-white rounded-lg" wire:click="save('{{$student->id}}')">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="1em">
                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                                            </svg>
                                                                        </button>
                                                                        @if ($student_ && $student->id == $student_->id)
                                                                            <button class="float-right px-3 py-2 bg-red-600 text-white rounded-lg" wire:click="setnull()">
                                                                            X
                                                                            </button>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <p class="bg-red-600 w-full px-5 py-5 text-center mx-auto block text-red-200">No hay registros</p>
                                                @endif
                                            </tbody>
                                        </table>
                                        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                                            {{$students->links()}}
                                        </div>
                                    @else
                                        <p class="bg-red-600 w-full px-5 py-5 text-center mx-auto block text-red-200">Seleccione Grado, Grupo y Bimestre</p>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .touchable{
                cursor: pointer;
            }
            @media (min-width: 640px) {
              table {
                display: inline-table !important;
              }
              .extra-info{
                  display: none;
              }
            }
            @media (max-width: 640px) {
                thead tr {
                    display: none !important;
                }
                .extra-info{
                    display: flex;
                }
            }
          </style>
    </div>

</div>
