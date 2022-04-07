<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reportes') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <x-confirm-deletion title="Reporte" :dataToDelete="$report" methodDelete="destroy"/>
                                @if($reports->count() > 0)
                                    <x-table-index :pages="true" :headers="['ID','Motivo','Realizado']" :objects="$reports" :objectProps="[['name'=>'id'],['name'=>'reason'],['name'=>'created_at']]" :actions="[['method'=>'deleteConfirmationModal','display'=>'Eliminar','bg'=>'red','font'=>'red']]" />
                                @else
                                    <div class="py-10 px-10 flex text-center"><span>Sin Reportes</span></div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
