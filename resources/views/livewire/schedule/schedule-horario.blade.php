<div class="flex flex-row w-full">
    <table class="w-full">
        {{-- cabezera de esto --}}
        <thead>
            <tr>
                <th>Hora</th>
                <th>Lunes</th>
                <th>Martes</th>
                <th>Miercoles</th>
                <th>Jueves</th>
                <th>Viernes</th>
            </tr> 
        </thead>
        <tbody>
            @foreach ($schedule as $keyOne => $sch)
                @include('livewire.schedule.horario', [$keyOne])
                <tr>
                    @foreach ($sch as $key => $item)
                        <td class="bg-blue-100 hover:bg-red-300 w-36 py-3">
                            <div class="flex flex-col">
                                {{-- solo en modo crear horario se visualiza el boton  --}}
                                @if ($whoIs == 'admin' && !$isEditing) 
                                    <button
                                        class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1 px-4 border border-blue-500 hover:border-transparent rounded"
                                        wire:click="materiaSelect({{ $keyOne }} , '{{ $key }}')">Poner Aquí</button>
                                @endif
                                {{ empty($item['materia']) ? 'Sin Materia ' : $item['materia'] }}
                            </div>
                        </td>

                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
