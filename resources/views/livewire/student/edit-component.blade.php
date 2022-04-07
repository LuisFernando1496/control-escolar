<div>
    <x-jet-dialog-modal wire:model='editing'>
        <x-slot name="title">
            Editar al estudiante {{$student?$student->user->fullname():''}}
        </x-slot>

        <x-slot name="content">
            <div class="container">
                <div class="flex flex-col ">
                    <div>
                        <x-jet-label for="behaviour" value="{{ __('Comportamiento') }}" />
                        <x-jet-input wire:model="student.behaviour" id="behaviour" class="block mt-1 w-full" type="number" max="10" min="0"
                            name="behaviour" required autofocus />
                        @error('student.behaviour')
                            <span class="text-red-700">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <x-jet-label for="address" value="{{ __('Direccion') }}" />
                        <x-jet-input wire:model="student.address" id="address" class="block mt-1 w-full" type="text"
                            name="address" required autofocus />
                        @error('student.address')
                            <span class="text-red-700">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <x-jet-label for="tutor_id" value="{{ __('Tutor') }}" />
                            <select id="tutor_id" wire:model="student.tutor_id" class="block mt-1 w-full block font-medium text-gray-500"
                        name="student.tutor_id" required autofocus >
                            @foreach ( \App\Models\Role::with('users')->whereId(4)->get() as $tutor)
                                @foreach($tutor->users as $nombre)
                            <option value="{{$nombre->id}}">{{$nombre->name}}</option>
                            @endforeach
                            @endforeach
                        </select>
                        @error('student.tutor_id')
                            <span class="text-red-700">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <x-jet-label for="student.blood_id" value="{{ __('Tipo de Sangre') }}" />
                        <select id="student.blood_id" wire:model="student.blood_id" class="block mt-1 w-full block font-medium text-gray-500"
                        name="student.blood_id" required autofocus>
                            @foreach ( \App\Models\Blood::all() as $blood)
                                <option value="{{$blood->id}}">{{$blood->name}}</option>
                            @endforeach
                        </select>
                        @error('student.blood_id')
                            <span class="text-red-700">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Si es admin --}}
                        @if($student->banned)
                            <div>
                                <x-jet-label for="banned_time" value="{{ __('Expulsion acaba') }}" />
                                {{\Carbon\Carbon::create($student->banned_time)->diffForHumans()}}
                            </div>
                        @endif
                        <div>
                            <x-jet-label for="strikes" value="{{ __('Reportes') }}" />
                            <x-jet-input wire:model="student.strikes" id="strikes" class="block mt-1 w-full" type="number" min="0" max="3"
                                name="strikes" required autofocus />
                            @error('student.strikes')
                                <span class="text-red-700">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <x-jet-label for="paid" value="{{ __('¿Pago Realizado?') }}" />
                            <select wire:model="student.paid" id="paid"
                            class="block mt-1 w-full block font-medium text-gray-500" type="text" name="paid"
                            required>
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select>
                            @error('student.paid')
                                <span class="text-red-700">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <x-jet-label for="banned" value="{{ __('Expulsado') }}" />
                            <select wire:model="student.banned" id="banned"
                            class="block mt-1 w-full block font-medium text-gray-500" type="text" name="banned"
                            required>
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select>
                            @error('student.banned')
                                <span class="text-red-700">{{ $message }}</span>
                            @enderror
                        </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">

            <div class="sm:px-6 sm:flex sm:flex-row-reverse sm:space-y-0 space-y-2">
                <x-jet-secondary-button wire:click="update()"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    {{ __('Actualizar') }}
                </x-jet-secondary-button>
                <x-jet-danger-button wire:click="$toggle('editing')" wire:loading.attr="disabled"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                    {{ __('Cancelar') }}
                </x-jet-danger-button>

            </div>
        </x-slot>
    </x-jet-dialog-modal>
</div>
