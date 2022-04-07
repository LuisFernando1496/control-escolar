<div>
    <div class="flex flex-col shadow-md px-2 ml-2 mr-2">
        <h1 class="flex justify-center">Seleccion</h1>
        @if ($whoIs == 'admin')
                <div class="flex flex-col mb-3" >
                     <button
                     wire:click="$toggle('isEditing')"
                        class="w-100 bg-blue-200 tracking-wide text-gray-800 font-bold rounded border-b-2 border-blue-500 hover:border-blue-600 hover:bg-blue-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center">
                    <span class="px-3"> {{ $isEditing ? 'Buscar horario' :  'crear horario' }} </span>
            </button>
                    
            </div>
        @endif
        <div class="flex flex-row">
@if ($whoIs == 'admin' || $whoIs == 'docente')
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Grado
                </label>
                <select wire:model="grado" class="block mt-1 w-full block font-medium text-gray-500" required autofocus>
                    <option value="0">Seleccione el grado</option>
                    @foreach (\App\Models\Grade::all() as $grade)
                        <option value="{{ $grade->id }}">{{ $grade->number }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Grupo
                </label>
                <select wire:model="grupo" class="block mt-1 w-full block font-medium text-gray-500" required autofocus>
                    <option>Seleccione un grupo</option>
                    @foreach (\App\Models\Group::all() as $group)
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>
               @endif
        </div>

        <div>
            
                @if ($grado != 0 && $grupo != 0 && $whoIs == 'admin' && !$isEditing)
                    <select wire:model="materia" class="block mt-1 w-full block font-medium text-gray-500" required
                        autofocus>
                        <option value="">Seleccione una materia</option>
                        @foreach ($materias as $materia)
                            <option value="{{ $materia->id }}">{{ $materia->name }}</option>
                        @endforeach
                    </select>
                @endif
        </div>

    </div>
    {{-- x-data="isDisabled: @entangle('isFine')" --}}

    <div class="flex flex-col pt-10 ">
        @switch($whoIs)
            @case('admin')

                    <div class="shadow-md px-2 ml-2 mr-2">
                    <h1 class="flex justify-center">Definir Docente</h1>
                    <select wire:model="maestro" class="block mt-1 w-full block font-medium text-gray-500" required autofocus>
                        <option>Docente para la clase</option>
                        @foreach ($teaches as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->fullName() }}</option>
                        @endforeach
                    </select>
                    @error('maestro') <span class="text-red-700">{{ $message }}</span> @enderror
            @if (!$isEditing)
                    <button
                        class="bg-blue-500 hover:bg-blue-700 disabled:opacity-50 text-white font-bold py-1 px-2 rounded float-right mx-2 my-2"
                        wire:click="store" {{ $isComplete ? 'disabled' : '' }} "> crear horario</button>
                @endif
                </div>      
            @break
            @case('alumno')
                    
            @break
            @default  
        @endswitch
            </div>


            {{-- seccion de error | cuando quiera poner materia pero no ha seleccionado
            alguna
            materia --}}
            <div class="flex flex-col">
                @error('materia')
                    {{ Log::alert($materia) }}
                    {{-- @toast-message-show.window="setTimeout(() => show = false, 200);" --}}
                    <div class=" pt-10 mx-4" >
                    <div class="text-white px-2 py-1 border-0 rounded relative mb-4 bg-red-500">
                        <span class="inline-block align-middle mr-8">
                            {{-- <b class="capitalize">purple!</b>
                            --}}
                            {{ $message }}
                        </span>
                    </div>
            </div>
        @enderror
        
            </div>

        <div class="flex flex-col justify-items-end py-4 px-1">
            <button {{ $canGenerate ? 'disabled' : '' }} wire:click="generatePDF"  class="btn-primary transition disabled:opacity-25  duration-300 ease-in-out focus:outline-none focus:shadow-outline bg-purple-700 hover:bg-purple-900 text-white font-normal py-2 px-4 mr-1 rounded">
             generar PDF
            </button>
            {{-- si es administrador y si solo esta en modo busqueda de horario de clases --}}
            @if ($whoIs === 'admin' && $isEditing) 
                <button  {{ $onPeriod ? '' : 'disabled' }} wire:click="fuckingSubscription"  class="mt-4 btn-primary transition disabled:opacity-25  duration-300 ease-in-out focus:outline-none focus:shadow-outline bg-purple-700 hover:bg-purple-900 text-white font-normal py-2 px-4 mr-1 rounded">
             Incribir alumnos 
            </button>
            @endif
        </div>
    </div>
