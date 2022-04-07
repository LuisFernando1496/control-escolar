<div>
    {{-- este variable debe estar en la clase 
    que se requiere utilizar para poder abrirla el modal --}}

    <x-jet-dialog-modal wire:model="confirmDeletion">
        <x-slot name="title">
            Eliminar {{ $title }}
        </x-slot>

        <x-slot name="content">
            Estas seguro de eliminar <b> {{ $dataToDelete }} </b>

            <div class="mt-4">
            </div>
        </x-slot>

        <x-slot name="footer">
            {{-- wire:click="$toggle('confirmingUserDeletion')"
            --}}
            <x-jet-secondary-button wire:click="$toggle('confirmDeletion')" wire:loading.attr="disabled">
                {{ __('Cancelar') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="{{ $methodDelete }}" wire:loading.attr="disabled">
                {{ __('Eliminar') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
