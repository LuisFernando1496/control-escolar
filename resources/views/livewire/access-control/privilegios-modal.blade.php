<x-jet-dialog-modal wire:model="privilegiosModal">
    <x-slot name="title">
        <h2 class="w-full my-2 text-3xl font-bold leading-tight my-5"> Rol : {{ !isset($role) ?: $role->name }} </h2>
    </x-slot>
    <x-slot name="content">
        <span class="text-gray-700">Privilegios</span>
        {{-- scroll|scrleable: las clases debajo, permiten el scoll para este contenido
        --}}
        <div class="overflow-scroll h-80 w-64 sm:w-full m-2">
            <div class="py-4">
                <form action="">

                    <div class=" grid gap-1 bg-gray-100 px-1">
                        @foreach ($permissions as $index => $permission)
                            {{-- <div class="mt-1">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" value="{{ $permission->id }}" wire:model="rolePermission"
                                        class="form-checkbox h-6 w-6 text-green-500">
                                    <span class="ml-3 text-sm">{{ $permission->description }}</span>
                                </label>
                            </div> --}}
                            <div class="bg-blue-100 py-2 rounded-md mt-2">
                                <label class="inline-flex items-center text-blue-800">
                                    <input class="form-checkbox" type="checkbox" value="{{ $permission->id }}"
                                        wire:model="rolePermission" id="opt-{{ $index }}" />
                                    <span class="ml-2"> {{ $permission->description }} </span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </form>
            </div>
        </div>
    </x-slot>
    <x-slot name="footer">
        <div class="sm:px-6 sm:flex sm:flex-row-reverse sm:space-y-0 space-y-2">
            <x-jet-secondary-button wire:click="updatePerms" wire:loading.attr="disabled"
                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                {{ __('Actualizar') }}
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="$toggle('privilegiosModal')" wire:loading.attr="disabled"
                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                {{ __('Cancelar') }}
            </x-jet-danger-button>
        </div>
    </x-slot>
</x-jet-dialog-modal>
