<div>
    <x-jet-dialog-modal wire:model="modalVisible">
        <x-slot name="title">
            <h2 class="w-full my-2 text-3xl font-bold leading-tight my-5">{{ $title }} </h2>
        </x-slot>

        <x-slot name="content">
            <div class="container">
                <div class="flex flex-col ">
                    <form wire:submit.prevent="store">

                        <div>
                            <div class="flex flex-wrap mb-6">
                                <div class="relative w-full appearance-none label-floating">
                                    <input wire:model="notice.title"
                                        class="tracking-wide py-2 px-4 mb-3 leading-relaxed appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                        id="titulo" type="text" placeholder="Titulo" required>
                                    <label for="titulo"
                                        class="absolute tracking-wide py-2 px-4 mb-4 opacity-0 leading-tight block top-0 left-0 cursor-text">
                                        Titulo de la convocatoria/aviso
                                    </label>
                                </div>
                            </div>
                            @error('notice.title')
                                <span class="text-red-700">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <div class="flex flex-wrap mb-6">
                                <div class="relative w-full appearance-none label-floating">
                                    <textarea wire:model="notice.body"
                                        class="autoexpand tracking-wide py-2 px-4 mb-3 leading-relaxed appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                        id="message" type="text" placeholder="Descripción..."></textarea>
                                    <label for="message"
                                        class="absolute tracking-wide py-2 px-4 mb-4 opacity-0 leading-tight block top-0 left-0 cursor-text">Message...
                                    </label>
                                </div>
                            </div>
                            {{--
                            <x-jet-label for="body" value="{{ __('Cuerpo de la convocatoria') }}" />
                            <x-jet-input wire:model="notice.body" id="clave" class="block mt-1 w-full" type="text"
                                name="clave" :value="old('cuerpo')" required autofocus />
                            --}}
                            @error('notice.body')
                                <span class="text-red-700">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- visualizacion de la imagen --}}
                        @if ($view == 'edit')
                            <div class="flex flex-wrap justify-center">
                                @if ($notice->type == 'pdf')
                                    {{-- componente que contine un svg | componente pdf
                                    --}}
                                    <x-pdf-svg color="9C27B0" width="20" />
                                @elseif($notice->type == 'document')
                                    {{-- componente que contine un svg | componente word
                                    --}}
                                    <x-word-svg color="9C27B0" height="20" />
                                @else
                                    <img src="{{ isset($notice->file) ? url('storage/convocatorias/' . $notice->file) : '' }}"
                                        alt="Girl in a jacket" class="w-400 h-60">
                                @endif
                            </div>
                        @endif
                        <div>
                            <div class="flex flex-col items-center pt-3">

                                {{-- wire:loading wire:target="noticeFile"
                                --}}
                                {{-- <div wire:loading wire:target="noticeFile">
                                    Cargando...</div> --}}
                                <div x-data="{ isUploading: false, progress: 0 }"
                                    x-on:livewire-upload-start="isUploading = true"
                                    x-on:livewire-upload-finish="isUploading = false"
                                    x-on:livewire-upload-error="isUploading = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    {{-- file input --}}
                                    <label
                                        class="w-64 flex px-2 items-center py-2 sm:py-1 bg-white text-blue rounded-lg shadow-lg tracking-wide  border border-blue cursor-pointer hover:bg-green-600 hover:text-white">
                                        <svg class="w-7  h-6 sm:h-8" fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path
                                                d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                        </svg>
                                        <span class="ml-2 text-base leading-normal">Seleccione un archivo</span>
                                        <input type="file" class="hidden" wire:model="noticeFile" />
                                    </label>
                                    <!-- Progress Bar -->
                                    <div x-show="isUploading">
                                        <div class="flex justify-center py-5">
                                            <progress max="100" x-bind:value="progress"></progress>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @error('noticeFile')
                                <div class="flex flex-col items-center pt-4">
                                    <span class=" text-red-700">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </form>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">

            <div class="sm:px-6 sm:flex sm:flex-row-reverse sm:space-y-0 space-y-2">
                <div x-data="{ vista: @entangle('view') }">
                    <template x-if="vista == 'new'">
                        <button wire:click="store" wire:loading.attr="disabled"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-green-800 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            {{ __('Crear') }}
                        </button>
                    </template>
                    <template x-if="vista == 'edit'">
                        <x-jet-secondary-button wire:click="update" wire:loading.attr="disabled"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            {{ __('Actualizar') }}
                        </x-jet-secondary-button>
                    </template>

                </div>


                <x-jet-danger-button wire:click="$toggle('modalVisible')" wire:loading.attr="disabled"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                    {{ __('Cancelar') }}
                </x-jet-danger-button>

            </div>
        </x-slot>
    </x-jet-dialog-modal>
</div>
