<div>
    <x-jet-dialog-modal wire:model="modalVisible">
        <x-slot name="title">
            {{ $title == 'new' ? 'Nueva materia' : 'Editar materia' }}
        </x-slot>

        <x-slot name="content">
            <div class="container">
                <div class="flex flex-col ">
                    <div>
                        <x-jet-label for="materia" value="{{ __('Nombre de la materia') }}" />
                        <x-jet-input wire:model="materia.name" id="materia" class="block mt-1 w-full" type="text"
                            name="materia" :value="old('materia')" required autofocus />
                        @error('materia.name')
                            <span class="text-red-700">{{ $message }}</span>
                        @enderror
                    </div>
                    <div x-data="{ isDisabled: @entangle('keySubject') }">
                        <x-jet-label for="clave" value="{{ __('Clave de Materia') }}" />
                        <template x-if="isDisabled">
                            <x-jet-input wire:model="materia.key" id="clave"
                                class=" {{ $title != 'edit' ?: 'bg-red-300' }}   block mt-1 w-full" type="text"
                                name="clave" :value="old('clave')" required autofocus maxlength="10" />
                        </template>
                        <template x-if="!isDisabled">
                            <x-jet-input wire:model="materia.key" id="clave"
                                class=" {{ $title != 'edit' ?: 'bg-red-300' }}   block mt-1 w-full" type="text"
                                name="clave" :value="old('clave')" required autofocus maxlength="10" disabled />
                        </template>
                        @error('materia.key')
                            <span class="text-red-700">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <select id="grade_id" wire:model="materia.grade_id"
                            class="block mt-1 w-full block font-medium text-gray-500" name="grade_id" required
                            autofocus>
                            <option value="">Seleccione el grado</option>
                            @foreach (\App\Models\Grade::all() as $grade)
                                <option value="{{ $grade->id }}">{{ $grade->description }}</option>
                            @endforeach
                        </select>
                        @error('materia.grade_id')
                            <span class="text-red-700">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">

            <div class="sm:px-6 sm:flex sm:flex-row-reverse sm:space-y-0 space-y-2">
                <div x-data="{ titulo: @entangle('title') }">
                    <template x-if="titulo == 'new'">
                        <x-jet-secondary-button wire:click="store" wire:loading.attr="disabled"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            {{ __('Crear') }}
                        </x-jet-secondary-button>
                    </template>
                    <template x-if="titulo == 'edit'">
                        <x-jet-secondary-button wire:click="update({{ $this->idMateria }})" wire:loading.attr="disabled"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            {{ __('Actualizar') }}
                        </x-jet-secondary-button>
                    </template>

                </div>


                <x-jet-danger-button wire:click="$toggle('modalVisible')" wire:loading.attr="disabled"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                    {{ __('Cancelar') }}
                </x-jet-danger-button>

            </div>
        </x-slot>
    </x-jet-dialog-modal>
</div>
