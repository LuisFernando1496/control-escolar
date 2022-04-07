<div>
    <x-jet-dialog-modal wire:model='editing'>
        <x-slot name="title">
            Editar al estudiante {{$record->student->user->fullname()}}
        </x-slot>

        <x-slot name="content">
            <div class="container">
                <div class="flex flex-col ">
                    <div>
                        <x-jet-label for="group_id" value="{{ __('Grupo') }}" />
                        <select id="group_id" wire:model="record.group_id" class="block mt-1 w-full block font-medium text-gray-500"
                        name="group_id" required autofocus>
                            @foreach ( \App\Models\Group::all() as $group)
                                <option value="{{$group->id}}">{{$group->name}}</option>
                            @endforeach
                        </select>
                        @error('record.group_id')
                            <span class="text-red-700">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <x-jet-label for="grade_id" value="{{ __('Grado') }}" />
                        <select id="grade_id" wire:model="record.grade_id" class="block mt-1 w-full block font-medium text-gray-500"
                        name="grade_id" required autofocus>
                            @foreach ( \App\Models\Grade::all() as $grade)
                                <option value="{{$grade->id}}">{{$grade->description}}</option>
                            @endforeach
                        </select>
                        @error('record.grade_id')
                            <span class="text-red-700">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <x-jet-label for="score" value="{{ __('Calificacion Final') }}" />
                        <x-jet-input wire:model="record.score" id="score" class="block mt-1 w-full" type="number" min="0" max="3"
                            name="score" required autofocus />
                        @error('record.score')
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
