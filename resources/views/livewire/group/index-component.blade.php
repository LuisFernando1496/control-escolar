<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom.
    --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Grupos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="flex flex-col">
                    <div class="flex flex-row-reverse">
                        <button wire:click="createShowModal"
                            class="text-white bg-purple-500 hover:bg-purple-700 py-3 px-4">
                            Nuevo Grupo </button>
                    </div>
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <x-table-index  :objects="$groups" :objectProps="[['name'=>'name']]" :headers="['Nombre']" :actions="[]" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
