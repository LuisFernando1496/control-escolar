<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mx-auto text-center">
                <img class="mx-auto py-10" src="{{asset('images/landing.png')}}" alt="welcome" width="500px">
                <div class="bg-indigo-500 text-indigo-200 w-full hover:text-white py-2">
                    Hola, ¡ Que bueno verte de nuevo {{auth()->user()->name}} ! 
                </div>
                <br>
                <div class="inline-flex my-1">
                    <img class="mx-auto my-1" src="{{asset('images/logo.png')}}" alt="welcome" width="50px">
                    <span class="px-10 my-4 text-lg">
                        Telesis
                    </span>
                </div>
            </div>
            <livewire:notices.feed />
            

        </div>
    </div>
</x-app-layout>
