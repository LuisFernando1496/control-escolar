<div class="grid sm:grid-cols-2 gap-3  bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
    {{-- <input wire:model='search'
        class="form-input rounded-md shadow-sm mt-1 block w-full" type="text" placeholder="Buscar usuario">
    <div class="form-input rounded-md shadow-sm mt-1 ml-6 block">
    </div> --}}
    {{-- select - de lista de materias, y grado
    --}}
    {{-- select para organizar la busqueda
    --}}
    <div class="">
        <div class="relative">
            <select wire:model="age" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label"
                class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <span class="flex items-center">
                    <span class="ml-3 block truncate">
                        Año
                    </span>
                </span>
                {{-- icono - lo implemenare despues
                --}}
                {{-- <span
                    class="ml-3 absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                    <!-- Heroicon name: selector -->
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </span> --}}
                <option value='0'>Selecione un año</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
        </div>
    </div>
    <div class="">
        @include('livewire.asset.subject-select', [
            'modelSelector' => 'subject',
        ])
    </div>
</div>
