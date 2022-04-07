<div>
    <x-jet-dialog-modal wire:model='reporting'>
        <x-slot name="title">
            Reportar al estudiante {{$student?$student->user->fullname():''}}
        </x-slot>

        <x-slot name="content">
            <div class="container">
                <div class="flex flex-col ">
                    <div>
                        <x-jet-label for="reason" value="{{ __('Razon del Reporte') }}" />
                        <x-jet-input wire:model="reason" id="reason" class="block mt-1 w-full" type="text"
                            name="reason" required autofocus />
                        @error('reason')
                            <span class="text-red-700">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">

            <div class="sm:px-6 sm:flex sm:flex-row-reverse sm:space-y-0 space-y-2">
                <x-jet-secondary-button wire:click="report({{$student}})"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    {{ __('Reportar') }}
                </x-jet-secondary-button>
                <x-jet-danger-button wire:click="$toggle('reporting')" wire:loading.attr="disabled"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                    {{ __('Cancelar') }}
                </x-jet-danger-button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
</div>
