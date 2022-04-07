<div>
    {{-- The whole world belongs to you --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Generar Horario') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="grid grid-cols-4">
                    {{-- @include('livewire.student.edit-component')
                    --}}
                    <div>
                        @include('livewire.schedule.schedule-form')
                    </div>
                    <div class="col-span-3">
                        @include('livewire.schedule.schedule-horario')
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
