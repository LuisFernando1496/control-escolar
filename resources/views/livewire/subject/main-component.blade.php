<div>
    {{-- The Master doesn't talk, he acts. --}}
    @include('livewire.subject.modal-component' )
    {{-- confirmar eliminacion - titulo - objeto a eliminar  --}}
    <x-confirm-deletion title="Materia" :dataToDelete="$deleteName" methodDelete="destroy"/>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Materias') }}
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
                            Nueva Materia </button>
                    </div>
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <x-table-index :pages="true" :objects="$subjects" :objectProps="[['name'=>'name'],['name'=>'key']]" :headers="['Nombre','Clave']" :actions="[['method'=>'editShowModal','display'=>'Editar'],['method'=>'deleteConfirmationModal','display'=>'Eliminar','bg'=>'red','font'=>'red']]" />

                                {{-- <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Nombre
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Clave
                                            </th>
                                            <th scope="col" class="px-6 py-3 bg-gray-50">
                                                <span class="sr-only">Edit</span>
                                            </th>
                                            <th scope="col" class="px-6 py-3 bg-gray-50">
                                                <span class="sr-only">Eliminar</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($subjects as $subject)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">

                                                        <div
                                                            class="flex-shrink-0 h-13 w-8">

                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{ $subject->name }}
                                                            </div>

                                                        </div>
                                                </td>
                                                <td>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $subject->key }}
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">
                                                        <button wire:click="editShowModal({{ $subject->id }})"
                                                            class="">editar</button>
                                                    </a>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="#" class="text-red-600 hover:text-red-900">
                                                        <button wire:click="deleteConfirmationModal({{ $subject->id }})"
                                                            class="">eliminar</button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table> --}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
