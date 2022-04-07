<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Instrumentación') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="flex flex-col">
                    <div class="bg-white">
                        <div class="flex flex-col sm:flex-row">

                            @if ($materias->count() > 0)
                                @foreach ($materias as $materia)
                                    @if ($materia->name == $materiaQuery)
                                        <button wire:click="navigate({{ $materia }})"
                                            class="text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none text-blue-500 border-b-2 font-medium border-blue-500">
                                            {{ $materia->name }}
                                        </button>
                                    @else
                                        <button wire:click="navigate({{ $materia }})"
                                            class="text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none">
                                            {{ $materia->name }}
                                        </button>
                                    @endif
                                @endforeach
                        </div>
                        <div class="grid grid-rows-1 sm:grid-cols-2 gap-4 pt-5 px-2 py-3 bg-gray-100">
                            @if ($assets->count() > 0)
                                @foreach ($assets as $asset)
                                    @include('livewire.asset.student.card-asset', ['asset' => $asset])
                                @endforeach
                            @else
                                <span
                                    class="h-10 rounded-md bg-blue-200 text-blue-900 flex items-center justify-center">No
                                    se encuentra ningun documento para esta materia</span>
                            @endif
                        @else
                            <span class="h-10 rounded-md bg-red-200 text-red-900 flex items-center justify-center">No
                                No cuenta con ninguna materia</span>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
