<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sistema') }}
        </h2>
    </x-slot>
    @include('livewire.configuration.edit-component')
    @can('hasPermission', 'stage.create')
        @if ($stage)
            <h1 class="text-center font-bold text-5xl mt-8 tracking-wide relative">Periodos</h1>

            <div class="flex flex-row justify-center my-4 text-sm tracking-tight font-medium text-gray-700">
                <p class="mx-3">Inscripción</p>

                <!-- Toggle Button -->
                <label for="toggle" class="flex items-center cursor-pointer">
                    <!-- toggle -->
                    <div class="relative">
                        <!--  input -->
                        <input id="toggle" class="hidden" type="checkbox" wire:click="change()" />
                        <!-- line -->
                        <div class="w-10 h-3 bg-gray-400 rounded-full shadow-inner"></div>
                        <!-- dot -->
                        <div class="toggle_dot absolute w-5 h-5 bg-white rounded-full shadow inset-y-0 left-0"></div>
                    </div>
                </label>

                <p class="mx-3">Reincripción</p>
            </div>
        @endif
    @endcan

    <div class="flex flex-col md:flex-row md:transform md:scale-75 lg:scale-100 justify-center">
        <div
            class="border rounded-lg md:rounded-r-none text-center p-5 mx-auto md:mx-0 my-2 md:my-6 bg-gray-100 font-medium z-10 shadow-lg">
            <div class="font-bold text-2x1">Escuela</div>

            <img src="{{Storage::url($school->logo)}}" class="object-cover m-auto rounded" width="150px">
            <div class="font-bold text-2xl ">Estudiantes {{$total}}</div>
            <hr>
            <div class="text-sm my-3">Nombre: {{$school->name}}</div>
            <hr>
            <div class="text-sm my-3">Director: {{$school->boss}}</div>
            <hr>
            <div class="text-sm my-3">Correo: {{$school->email}}</div>
            <hr>
            <div class="text-sm my-3">Telefono: {{$school->phone}}</div>
            <hr>
            <div class="text-sm my-3">Dirección: {{$school->address}}</div>

            <form class="flex flex-col border border-purple-600 my-10 px-2 py-2 rounded-lg" wire:submit.prevent="updateLogo()">
                <x-jet-label for="logo" value="{{ __('Logo') }}"/>
                <input class="my-2 bg-purple-500 rounded-lg text-white" id="logo" name="logo" type="file" wire:model="logo" accept="image/png,image/jpeg,image/jpg">
                @error('logo') <span class="error">{{ $message }}</span> @enderror
                <div class="relative">
                    <button class="text-sm bg-purple-500 right-0 rounded py-2 px-2 text-white" type="submit">Actualizar Logo</button>
                </div>
            </form>
            <button wire:click="edit({{$school}})" class="bg-purple-500  border border-purple-600 hover:bg-white text-white hover:text-purple-600 font-bold uppercase text-xs mt-5 py-2 px-4 rounded cursor-pointer">
                Editar
            </button>

            @if(!$stage)
                <button wire:click="setStage({{true}})" class="bg-green-500  border border-green-600 hover:bg-white text-white hover:text-blue-600 font-bold uppercase text-xs mt-5 py-2 px-4 rounded cursor-pointer">
                    Activar Periodos
                </button>
            @else
                <button wire:click="setStage({{0}})" class="bg-red-500  border border-red-600 hover:bg-white text-white hover:text-red-600 font-bold uppercase text-xs mt-5 py-2 px-4 rounded cursor-pointer">
                    Desactivar Periodos
                </button>
            @endif

        </div>
        @can('hasPermission', 'stage.create')
            @if($stage)
                <div class="border-transparent rounded-lg text-center p-5 mx-auto md:mx-0 my-2 bg-gradient text-white font-medium z-10 shadow-lg">
                    <div class="py-4 align-items-center">{{$stage->description}}
                        <div class="text-sm my-3"><span class=" @if($stage->active) rounded-lg px-2 bg-green-400 text-white @endif">{{$stage->active?'Activo': 'Inactivo'}}</span></div>
                        <span>Termina</span>
                        <div class="font-bold text-6xl">{{\Carbon\Carbon::create($stage->deadline)->diffForHumans()}}</div>
                    </div>
                    <div class="py-5">
                        <span>Cambiar Día de Termino de Plazo</span>
                        <input type="date" wire:change="changeDeadline" wire:model="stage.deadline" class="w-full rounded text-black">
                    </div>
                </div>
            @endif
        @endcan
    </div>
    <style>
        @media (min-width: 640px) {
            .sm\:bg-svg-bottom {
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='353' height='304'%3E%3Cg fill='none' fill-rule='evenodd' stroke='%23D0D5F6' stroke-width='2'%3E%3Cpath d='M180.29 759c102.087-21.62 155.232-61.312 159.437-119.074 6.307-86.643-231.598-17.186-136.358-198 95.241-180.813 181.318-185.29 136.358-298C294.767 31.216 174.04-27.954 33.79 16.8c-93.501 29.836-144.652 140.545-153.453 332.126'/%3E%3Cpath d='M138.3 759c80.083-18.988 121.774-53.846 125.072-104.575 4.948-76.093-181.679-15.094-106.966-173.89C231.118 321.738 298.64 317.808 263.372 218.82c-35.269-98.986-129.974-150.95-239.995-111.646C-49.97 133.378-90.096 230.605-97 398.859'/%3E%3Cpath d='M102.065 761c60.604-16.56 92.153-46.963 94.65-91.208 3.743-66.367-137.488-13.165-80.949-151.664 56.54-138.5 107.638-141.927 80.948-228.261-26.69-86.335-98.359-131.656-181.618-97.376C-40.41 215.345-70.775 300.145-76 446.892'/%3E%3C/g%3E%3C/svg%3E");
            }
        }

        .toggle_dot {
            top: -.25rem;
            transition: all 0.3s ease-in-out;
        }

        input:checked~.toggle_dot {
            transform: translateX(100%);
            background-color: #b445cf;
        }

        .bg-gradient {
            background: #667db6;
            /* fallback for old browsers */
            background: #6b3192;
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        }

        .bg-gradient-base {
            background-color: #803aaf;
        }

        .font-work-sans {
            font-family: 'Work Sans', sans-serif;
        }
    </style>
</div>
