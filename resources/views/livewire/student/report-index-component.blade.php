<div>
    <x-jet-dialog-modal wire:model='list'>
        <x-slot name="title">
            Reportar al alumno {{$student?$student->user->fullname():''}}
        </x-slot>

        <x-slot name="content">
            <div class="container">
                <div class="flex flex-col ">
                    <div>
                       <table class="min-w-full divide-y divide-gray-200 flex flex-row flex-no-wrap text-left">
                           <thead>
                               <tr>
                                   <th>Realizado Por</th>
                                   <th>Motivo</th>
                                   <th>Fecha</th>
                                   {{-- si es admin --}}
                                   <th>Acciones</th>
                               </tr>
                           </thead>
                           <tbody>
                               @foreach ($student->reports as $report)
                               <tr>
                                    <td>
                                        {{$report->user->fullname()}}
                                    </td>
                                    <td>
                                        {{$report->reason}}
                                    </td>
                                    <td>
                                        {{$report->created_at->diffForHumans()}}
                                    </td>
                                    <td>

                                    </td>
                               </tr>
                               @endforeach
                           </tbody>
                       </table>
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <div class="sm:px-6 sm:flex sm:flex-row-reverse sm:space-y-0 space-y-2">
                <x-jet-danger-button wire:click="$toggle('list')" wire:loading.attr="disabled"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                    {{ __('Cerrar') }}
                </x-jet-danger-button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
</div>
