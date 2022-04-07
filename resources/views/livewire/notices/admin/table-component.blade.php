<div>
    <x-confirm-deletion title="Noticia" :dataToDelete="$noticeToDelete" methodDelete="destroy"/>
    @include('livewire.notices.admin.notices-form' )
    {{-- <x-confirm-deletion title="Materia" :dataToDelete="$materia" methodDelete="destroy"/> --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Administracion de Noticias') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="flex flex-col">
                    <div class="flex flex-row-reverse">
                        <button wire:click="newNotice"
                            class="text-white bg-purple-500 hover:bg-purple-700 py-3 px-4">
                            Nueva Noticia </button>
                    </div>
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <x-table-index :pages="true" :objects="$notices" :objectProps="[['name'=>'title'],['name'=>'body'], ['name'=> 'type']]" :headers="['Titulo','Descripcion', 'tipo']" target="true" :actions="[['method'=>'editShowModal','display'=>'Editar'], ['route'=>'notice.show','display'=>'ver'],['method'=>'destroyModal','display'=>'Eliminar','bg'=>'red','font'=>'red']]" />
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
