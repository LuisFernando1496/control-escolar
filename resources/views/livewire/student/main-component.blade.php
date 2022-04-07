<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Estudiantes') }}
        </h2>
    </x-slot>
    <div>




        <div class="max-w-auto mx-auto sm:px-6 lg:px-8 py-5">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="mt-5 mx-5 flex flex-col">
                    <div class="flex">
                        @if ($path)
                            <a class="bg-green-500 hover:text-white text-green-100 px-3 py-3 rounded-md" href="{{\Storage::url($path)}}" target="_blank" wire:click="$set('path',null)">Descargar {{explode('/',$path)[2]}}</a>
                        @else
                            <form wire:submit.prevent="list" class="border-indigo-500 border-2 rounded-lg pl-2">
                                <label for="group_id" class="py-2 px-2">Grupo</label>
                                <select wire:model="group_id" id="group_id" class="py-2 px-2">
                                    <option>Seleccione el grado</option>
                                    @foreach (\App\Models\Group::all() as $group)
                                        <option value="{{$group->id}}">{{$group->name}}</option>
                                    @endforeach
                                </select>
                                <label for="grade_id" class="py-2 px-2">Grado</label>
                                <select wire:model="grade_id" id="grade_id" class="py-2 px-2">
                                    <option>Seleccione el grupo</option>
                                    @foreach (\App\Models\Grade::all() as $grade)
                                        <option value="{{$grade->id}}">{{$grade->number}}</option>
                                    @endforeach
                                </select>
                                <label for="user_id" class="py-2 px-2">Asessor</label>
                                <select wire:model="user_id" id="user_id" class="py-2 px-2">
                                    <option>Seleccione el asesor</option>
                                    @foreach (\App\Models\Role::where('slug','docente')->first()->users as $user)
                                        <option value="{{$user->id}}">{{$user->fullname()}}</option>
                                    @endforeach
                                </select>
                                <button class="bg-indigo-500 hover:text-white text-indigo-100 ml-2 px-3 py-2 rounded-md float-right" type="submit">Generar lista</button>
                            </form>
                        @endif
                        @if(!$isTheEnd)
                            <button class="bg-purple-500 mx-1 hover:text-white text-purple-100 py-1 px-3 rounded-lg float-right" wire:click="$set('isTheEnd',true)">Terminar Ciclo Escolar</button>
                        @else
                            <span class="bg-indigo-600 text-indigo-200 py-1 px-2 rounded-lg float-right">¿Desea Terminar el Ciclo Escolar?</span>
                            <input class="text-black py-1 px-2 rounded-lg float-right w-100" type="password" wire:model="password" wire:keyup.debounce.500ms="theEnd()" placeholder="Contraseña requerida">
                            <button class="bg-red-500 mx-1 text-red-100 py-1 px-3 rounded-lg float-right" wire:click="$set('isTheEnd',false)">Cancelar</button>
                        @endif
                        @can('hasPermission', 'user.student.create')
                            <a class="text-center text-indigo-100 hover:text-white bg-purple-500 rounded-lg py-2 px-3 float-right" href="{{route('students.register')}}">Registrar Estudiante</a>
                        @endcan
                        <button class="bg-purple-500 mx-1 hover:text-white text-purple-100 py-1 px-3 rounded-lg float-right" wire:click="$set('showReportCard', true)">Generar boleta</button>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <div class="flex bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                                    <input wire:model='search' class="form-input rounded-md shadow-sm mt-1 block w-full" type="text" placeholder="Ingrese la clave del estudiante">
                                    <div class="form-input rounded-md shadow-sm mt-1 ml-6 block">
                                        <select wire:model="perPage" name="range" class="outline-none text-gray-500 text-sm">
                                            @foreach ([5,10,15,20,50,100] as $option)
                                                <option value="{{$option}}">{{$option}} por página</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-input rounded-md shadow-sm mt-1 ml-6 block">
                                        <select wire:model="grade" name="grade" class="outline-none text-gray-500 text-sm" wire:change="$set('grade',$event.target.value)">
                                            <option value="0">Todos</option>
                                            @foreach (\App\Models\Grade::all() as $grade)
                                                <option value="{{$grade->id}}">{{$grade->description}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-input rounded-md shadow-sm mt-1 ml-6 block">
                                        <select wire:model="group" name="group" class="outline-none text-gray-500 text-sm" wire:change="$set('group',$event.target.value)">
                                            <option value="0">Todos</option>
                                            @foreach (\App\Models\Group::all() as $group)
                                                <option value="{{$group->id}}">{{$group->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @unless ($search == '')
                                        <button wire:click="clear" class="form-input rounded-md shadow-sm mt-1 ml-6 block btn text-red-500">
                                            X
                                        </button>
                                    @endunless
                                </div>
                                {{-- modal/dialog para generar una boleta  --}}
                                @include('livewire.student.report-card.report-card-dialog')
                                {{-- Modal de edicion --}}
                                @include('livewire.student.edit-component')
                                {{-- Modal de reporte --}}
                                @include('livewire.student.report-component')
                                {{-- Modal de Lista de reportes --}}
                                @include('livewire.student.report-index-component')
                                {{-- Confirmacion de eliminacion --}}
                                <x-confirm-deletion title="Eliminar Estudiante" :dataToDelete="$studentFullname" methodDelete="destroy"/>
                                {{-- table --}}
                                @if($students->count())
                                    <table class="min-w-full divide-y divide-gray-200 flex flex-row flex-no-wrap text-left">
                                        <thead>
                                            <tr class="flex flex-col flex-no wrap sm:table-row">
                                                <th scope="col"
                                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Estudiante
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Contacto
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Comp./ Calf. año / Prom.
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Reportes
                                                </th>
                                                {{-- si es admin --}}
                                                    <th scope="col"
                                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Pago
                                                    </th>

                                                <th scope="col" class="px-6 py-3 bg-gray-50">
                                                    <span class="sr-only">Edit</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($students as $student)
                                                <tr class="flex flex-col flex-no wrap sm:table-row {{$student->banned ? 'bg-red-100': ''}}">
                                                    {{-- Estudiante --}}
                                                    <td class="px-6 py-4 whitespace-nowrap text-left">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-10 w-10">
                                                                <img class="h-10 w-10 rounded-full"
                                                                    src="{{$student->user->profile_photo_url}}"
                                                                    alt="{{$student->user->fullname()}}">
                                                            </div>
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    {{$student->user->fullname()}}
                                                                </div>
                                                                @if($student->banned)
                                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full @if($student->user->active && !$student->banned) bg-green-100 text-green-800 @else bg-red-100 text-red-800  @endif">
                                                                        <span class="pr-2">
                                                                                Expulsión temina <br> {{\Carbon\Carbon::create($student->banned_time)->diffForHumans()}}
                                                                        </span>
                                                                    </span>
                                                                @else
                                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full @if($student->user->active && !$student->banned) bg-green-100 text-green-800 @else bg-red-100 text-red-800  @endif">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="1rem">
                                                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                                                        </svg>
                                                                        <b class="px-2">{{$student->user->key}}</b>
                                                                        {{$student->user->active ? 'Activo': 'Inactivo'}}
                                                                    </span>
                                                                    <span class="inline-flex px-2 text-sm leading-10 font-semibold">
                                                                        {{$student->user->birthday}} | {{$student->user->sex? 'F':'M'}} |  {{$student->blood->name}}
                                                                    </span>
                                                                    <br>
                                                                    <span class="w-full px-2 text-sm">{{$student->currentGrade->description}}</span> - <span class="w-full px-2 text-sm">{{$student->currentGroup->name}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                    {{-- Contacto --}}
                                                    <td class="px-6 py-4 whitespace-nowrap text-left">
                                                        <div class="text-sm text-gray-900 font-medium flex">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="1rem">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                            </svg>
                                                            <span class="pl-5">
                                                                {{$student->user->phone}}
                                                            </span>
                                                        </div>
                                                        <div class="text-sm text-gray-900 font-medium flex">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="1rem">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                                            </svg>
                                                            <div class="pl-5">
                                                                {{$student->user->email}}
                                                            </div>
                                                        </div>
                                                        <div class="text-sm text-gray-900 font-medium flex">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="1rem">
                                                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            </svg>
                                                            <div class="pl-5">
                                                                {{$student->address}}
                                                            </div>
                                                        </div>
                                                        <div class="text-sm text-gray-900 font-medium flex">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="1rem">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                                            </svg>
                                                            <div class="pl-5">
                                                                {{$student->tutor->name}}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    {{-- Metricas --}}
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <span>
                                                            {{$student->behaviour * 10}}% / {{$student->yearAverage()}} / {{$student->average()}}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <span class="inline-flex px-2 text-sm leading-10 font-semibold flex-inline">
                                                            <span class="px-5">{{$student->strikes}}</span>
                                                            @if($student->reports->count() > 0)
                                                                <button class="shadow bg-indigo-100 px-2 rounded-lg" wire:click="showListReports({{$student}})">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="1rem">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                                    </svg>
                                                                </button>
                                                            @endif
                                                        </span>
                                                    </td>
                                                    {{-- si es admin --}}
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <span>
                                                                {{$student->paid ? 'Pagado': 'Sin realizar Pago'}}
                                                            </span>
                                                        </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        {{-- si es admin --}}
                                                            <button wire:click="edit({{$student}})"  class="shadow my-1 text-indigo-600 hover:text-indigo-900 bg-purple-100 rounded-lg py-1 px-3">Editar</button>
                                                            <button wire:click="deleteConfirmationModal({{$student}})" class="shadow my-1 text-red-600 hover:text-red-900 bg-red-100 rounded-lg py-1 px-3">Eliminar</button>
                                                            <button wire:click="reportModal({{$student}})" class="shadow my-1 text-yellow-600 hover:text-yellow-900 bg-yellow-100 rounded-lg py-1 px-3">Reportar</button>
                                                            @if ($student->letter)
                                                                <div class="inline-flex">
                                                                    <a href="{{Storage::url($student->letter->path)}}" target="_blank">
                                                                        <button class="shadow my-1 text-indigo-600 hover:text-indigo-900 bg-indigo-100 rounded-lg py-1 px-3">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" height="15px">
                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                                            </svg>
                                                                        </button>
                                                                    </a>
                                                                </div>
                                                            @else
                                                                <button wire:click.prefetch="letter({{$student}})" class="shadow my-1 text-indigo-600 hover:text-indigo-900 bg-indigo-100 rounded-lg py-1 px-3">Generar Carta</button>
                                                            @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                                        {{$students->links()}}
                                    </div>
                                @else
                                    <div class="bg-white px-4 py-3 border-t border-gray-500 sm:px-6">
                                        Sin resultados para: {{$search}}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            @media (min-width: 640px) {
              table {
                display: inline-table !important;
              }
            }
            @media (max-width: 640px) {
                thead tr {
                    display: none !important;
                }
            }
          </style>
    </div>

</div>
