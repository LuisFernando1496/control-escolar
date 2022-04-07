<x-confirm-deletion title="Instrumentacion" :dataToDelete="$toDelete" methodDelete="destroy"/>
<table class="w-full flex flex-row flex-no-wrap sm:bg-white   my-5">
    <thead class="text-white">


        <tr class="bg-purple-400 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
            <th class="p-3 text-left">Titulo</th>
            <th class="p-3 text-left">Descripcion</th>
            <th class="p-3 text-left">Docente</th>
            <th class="p-3 text-left">Materia</th>
            <th class="p-5 text-left">Acciones</th>
        </tr>
    </thead>

    <tbody class="flex-1 sm:flex-none">
        @foreach ($assets as $asset)
            <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">
                <td class="border-grey-light border hover:bg-gray-100 p-3">
                    {{ $asset->title }}
                </td>
                <td class="border-grey-light border hover:bg-gray-100 p-3">
                    {{ $asset->description }}
                </td>
                <td class="border-grey-light border hover:bg-gray-100 p-3">
                    {{ $asset->teacher['name'] }}
                </td>
                <td class="border-grey-light border hover:bg-gray-100 p-3">
                    {{ $asset->subject['name'] }}
                </td>
                <td class="border-grey-light border p-3">
                    <div class="flex  justify-start  m-2 ">
                        <button wire:click="showEdit({{$asset->id}})"
                            class="text-blue-900 bg-blue-100 hover:bg-blue-300 px-2 rounded-lg ">editar</button>
                        <button wire:click="deleteConfirmationModal({{$asset->id}})"
                            class="text-red-900 bg-red-100 hover:bg-red-300 px-2 rounded-lg ml-1">eliminar</button>
                        <a href="{{ route('asset.show', $asset->path ) }}" target="_blank">
                            <button
                            class="block text-blue-900 bg-blue-100 hover:bg-blue-300 px-2 rounded-lg ml-1">ver</button>
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>

</table>

<style>
    @media (min-width: 640px) {
        table {
            display: inline-table !important;
        }

        thead tr:not(:first-child) {
            display: none;
        }
    }

    td:not(:last-child) {
        border-bottom: 0;
    }

    th:not(:last-child) {
        border-bottom: 2px solid rgba(0, 0, 0, .1);
    }

</style>
