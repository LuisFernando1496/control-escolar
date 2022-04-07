    <x-jet-dialog-modal wire:model='showReportCard'>
        <x-slot name="title">
            <h2 class="w-full text-3xl font-bold leading-tight my-5"> Generar Boleta</h2>
        </x-slot>
        <x-slot name="content">
            @include('livewire.student.report-card.report-card-form')
        </x-slot>
        <x-slot name="footer">

            <div class="sm:px-6 sm:flex sm:flex-row-reverse sm:space-y-0 space-y-2">
                <x-jet-secondary-button wire:click="makeReportCard"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    {{ __('Generar') }}
                </x-jet-secondary-button>
                <x-jet-danger-button wire:click="$toggle('showReportCard')" wire:loading.attr="disabled"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                    {{ __('Cancelar') }}
                </x-jet-danger-button>

            </div>
        </x-slot>

    </x-jet-dialog-modal>
