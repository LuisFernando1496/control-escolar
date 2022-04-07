<div>
    <x-jet-dialog-modal wire:model="showModal">
        <x-slot name="title">
            <h2 class="w-full my-2 text-3xl font-bold leading-tight my-5"> Editar: </h2>
        </x-slot>
        <x-slot name="content">
            <div class="container">
                <div class="flex flex-col">
                    <form wire:submit.prevent="store">
                        <div class="flex flex-wrap mb-6">
                            <div class="relative w-full appearance-none label-floating">
                                <input wire:model="asset.title"
                                    class="tracking-wide py-2 px-4 mb-3 leading-relaxed appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="titulo" type="text" placeholder="Titulo" required>
                                <label for="titulo"
                                    class="absolute tracking-wide py-2 px-4 mb-4 opacity-0 leading-tight block top-0 left-0 cursor-text">
                                    titulo del documento
                                </label>
                                @error('asset.title')
                                    <span class="text-red-700">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="relative w-full appearance-none label-floating">
                            <div class="flex flex-wrap mb-6">
                                <div class="relative w-full appearance-none label-floating">
                                    <textarea wire:model="asset.description" title="descripcion"
                                        class="autoexpand tracking-wide py-2 px-4 mb-3 leading-relaxed appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500"
                                        id="descripcion" type="text" placeholder="Descripcion del documento"></textarea>
                                    <label for="descripcion"
                                        class="absolute tracking-wide py-2 px-4 mb-4 opacity-0 leading-tight block top-0 left-0 cursor-text">Message...
                                    </label>
                                    @error('asset.description')
                                        <span class="text-red-700">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="relative w-full appearance-none label-floating">
                            @include('livewire.asset.subject-select', [
                            'modelSelector' => 'asset.subject_id'
                            ])

                            @error('asset.subject_id')
                                <div class="flex flex-col items-center pt-4">
                                    <span class=" text-red-700">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="flex justify-center text-blue-800 pt-4">
                            {{-- solucion al problema de que al guardar no es un objeto si
                            no un array --}}
                            @if ($view == 'edit' && gettype($asset) == 'object')
                                @if (strpos($asset->path, 'pdf'))
                                    <x-pdf-svg color="9C27B0" width="20" />
                                @else
                                    <x-word-svg color="9C27B0" height="20" />
                                @endif

                            @endif
                        </div>
                        <div>

                            <div class="flex justify-center pt-3">
                                <div x-data="{ isUploading: false, progress: 0 }"
                                    x-on:livewire-upload-start="isUploading = true"
                                    x-on:livewire-upload-finish="isUploading = false"
                                    x-on:livewire-upload-error="isUploading = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    {{-- input file upload
                                    --}}
                                    <label
                                        class="w-64 flex px-2 items-center py-2 sm:py-1 bg-white text-blue rounded-lg shadow-lg tracking-wide  border border-blue cursor-pointer hover:bg-green-600 hover:text-white">
                                        <svg class="w-7  h-6 sm:h-8" fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path
                                                d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                        </svg>
                                        <span
                                            class="ml-2 text-base leading-normal">{{ $view == 'edit' ? 'Actualizar archivo' : 'Seleccione un archivo' }}</span>
                                        <input type="file" class="hidden" wire:model="document" />
                                    </label>

                                    {{-- progress bar here bra
                                    --}}
                                    <div x-show="isUploading">
                                        <div class="flex justify-center py-5">
                                            <progress max="100" x-bind:value="progress"></progress>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @error('document')
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
                <x-jet-secondary-button wire:click="{{ $view == 'new' ? 'store' : 'update' }}"
                    wire:loading.attr="disabled"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-indigo-100  text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    {{ $view == 'new' ? 'Crear' : 'Actualizar' }}
                </x-jet-secondary-button>

                <x-jet-danger-button wire:click="$toggle('showModal')" wire:loading.attr="disabled"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                    {{ __('Cancelar') }}
                </x-jet-danger-button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
</div>
