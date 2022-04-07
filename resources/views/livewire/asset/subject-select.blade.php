<select name="subject" wire:model="{{ $modelSelector }}" id="select-2"
    class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    <option value='0'>Selecione la materia</option>
    @foreach ($subjects as $subject)
        <option value="{{ $subject->id }}"> {{ $subject->name }} </option>
    @endforeach
</select>
