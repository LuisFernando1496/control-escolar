<div class="py-4">
    <div class="flex flex-col">
        <select name="grupo" wire:model="rGroup" id="group"
            class="relative w-full mb-2 bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <option value=''>Selecione el grupo</option>
            @foreach (\App\Models\Group::all() as $group)
                <option value="{{ $group->id }}"> {{ $group->name }} </option>
            @endforeach
        </select>
        @error('rGroup')
            <span class="text-red-700">{{ $message }}</span>
        @enderror
        <select name="grado" wire:model="rGrade" id="grado"
            class="mb-2 relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <option value=''>Selecione el grado</option>
            @foreach (\App\Models\Grade::all() as $grade)
                <option value="{{ $grade->id }}"> {{ $grade->description }} </option>
            @endforeach
        </select>
        @error('rGrade')
            <span class="text-red-700">{{ $message }}</span>
        @enderror
        <select name="periodo" wire:model="period" id="periodo"
            class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <option value=''>Selecione el periodo</option>
            @foreach ($periods as $period)
                @if (!empty($period))
                    <option value="{{ $period->period }}"> {{ $period->period }} </option>
                @endif
            @endforeach
        </select>
        @error('period')
            <span class="text-red-700">{{ $message }}</span>
        @enderror
    </div>
</div>
