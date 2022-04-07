{{-- editar un un rol activado, solo se podria editar nombre, descripcion
--}}
<div>
    <x-jet-dialog-modal wire:model="formModal">
        <x-slot name="title">
            <h2 class="w-full my-2 text-3xl font-bold leading-tight my-5"> {{ $view == 'edit' ? 'Editar Rol' : 'Crear un Rol'}} </h2>
        </x-slot>
        <x-slot name="content">
            <div class="container">
                <div class="flex flex-col">
                    <form action="">
                        <div class="flex flex-wrap mb-6">
                            <div class="relative w-full appearance-none label-floating">
                                <input wire:model="role.name"
                                    class="tracking-wide py-2 px-4 mb-3 leading-relaxed appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="nombre" type="text" placeholder="Nombre" required>
                                <label for="nombre"
                                    class="absolute tracking-wide py-2 px-4 mb-4 opacity-0 leading-tight block top-0 left-0 cursor-text">
                                    nombre del rol
                                </label>
                            </div>
                            <div class="relative w-full appearance-none label-floating">
                                <input wire:model="role.description"
                                    class="tracking-wide py-2 px-4 mb-3 leading-relaxed appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="nombre" type="text" placeholder="Descripción" required>
                                <label for="nombre"
                                    class="absolute tracking-wide py-2 px-4 mb-4 opacity-0 leading-tight block top-0 left-0 cursor-text">
                                    descripcion del rol
                                </label>
                            </div>
                            {{-- check for is role active --}}
                            <div class="grid grid-cols-6 gap-2">
                                <div class="col-start-3 col-end-13 md:col-start-3  bg-green-50 rounded-xl px-2 py-2">
                                    <div
                                        class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                                        <input type="checkbox" value="1" wire:model="access"
                                            class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer" />
                                        <label for="acceso"
                                            class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                                    </div>
                                    <label for="acceso" class="text-xs text-gray-700">Acceso total.</label>
                                </div>
                                <div
                                    class="col-start-3 col-end-12 md:grid-start-3  mt-2 bg-green-50 rounded-xl px-2 py-2">
                                    <div
                                        class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                                        <input wire:model="role.active" type="checkbox" name="active" id="active"
                                            class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer" />
                                        <label for="active"
                                            class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                                    </div>
                                    <label for="active" class="text-xs text-gray-700">Rol activado.</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            {{-- <div x-data="{vista: @entangle('view')}">

            </div> --}}
            <div class="sm:px-6 sm:flex sm:flex-row-reverse sm:space-y-0 space-y-2">
                @if ($view == 'edit')
                    <x-jet-secondary-button wire:click="update({{ $role }})" wire:loading.attr="disabled"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        {{ __('Actualizar') }}
                    </x-jet-secondary-button>
                @else
                    <button wire:click="store" wire:loading.attr="disabled"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-green-800 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        {{ __('Crear') }}
                    </button>
                @endif
                <x-jet-danger-button wire:click="$toggle('formModal')" wire:loading.attr="disabled"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                    {{ __('Cancelar') }}
                </x-jet-danger-button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
</div>

<style>
    /* .toggle-checkbox:checked {
        @apply: right-0 border-green-400;
        right: 0;
        border-color: #68D391;
    } */

    .toggle-checkbox:checked+.toggle-label {
        @apply: bg-green-400;
        background-color: #68D391;
    }

</style>
