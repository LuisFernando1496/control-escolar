<div>
    <x-jet-dialog-modal wire:model='editing'>
        <x-slot name="title">
            Editar Datos de Escuela
        </x-slot>

        <x-slot name="content">
            <div class="container">
                <div class="flex flex-col ">
                    <div>
                        <x-jet-label for="name" value="{{ __('Nombre') }}" />
                        <x-jet-input wire:model="school.name" id="name" class="block mt-1 w-full" type="text"
                            name="name" required autofocus />
                        @error('school.name')
                            <span class="text-red-700">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <x-jet-label for="boss" value="{{ __('Director') }}" />
                        <x-jet-input wire:model="school.boss" id="boss" class="block mt-1 w-full" type="text"
                            name="boss" required autofocus />
                        @error('school.boss')
                            <span class="text-red-700">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <x-jet-label for="address" value="{{ __('Direccion') }}" />
                        <x-jet-input wire:model="school.address" id="address" class="block mt-1 w-full" type="text"
                            name="address" required autofocus />
                        @error('school.address')
                            <span class="text-red-700">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <x-jet-label for="email" value="{{ __('Email') }}" />
                        <x-jet-input wire:model="school.email" id="email" class="block mt-1 w-full" type="text"
                            name="email" required autofocus />
                        @error('school.email')
                            <span class="text-red-700">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <x-jet-label for="phone" value="{{ __('Telefono') }}" />
                        <x-jet-input wire:model="school.phone" id="phone" class="block mt-1 w-full" type="tel" maxlength="10"
                            name="phone" required autofocus />
                        @error('school.phone')
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
