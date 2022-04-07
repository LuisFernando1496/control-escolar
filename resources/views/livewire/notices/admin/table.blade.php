<div>
    <table class="min-w-full divide-y divide-gray-200 flex flex-row flex-no-wrap">
        <thead>
            <tr class="flex flex-col flex-no wrap sm:table-row">

                <th scope="col"
                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                   Titulo 
                </th>
                <th scope="col"
                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                   Descripción 
                </th>


                <th scope="col"
                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Acciones
                </th>

            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($objects as $object)
                <tr class="flex flex-col flex-no wrap sm:table-row">
                    @foreach ($objectProps as $prop)
                        <td
                            class="px-6 py-4 whitespace-nowrap text-{{ isset($prop['color']) ? $prop['color'] : 'gray' }}-{{ isset($prop['w']) ? $prop['w'] : '500' }}">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
                                {{ $object[$prop['name']] }}
                            </span>
                        </td>
                    @endforeach
                    @if (count($actions) > 0)
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            @foreach ($actions as $action)
                                @if (isset($action['method']))
                                    <a href="#">
                                        <button wire:click="{{ $action['method'] . '(' . $object->id . ')' }}"
                                            class="text-{{ isset($action['font']) ? $action['font'] : 'purple' }}-600 hover:text-{{ isset($action['font']) ? $action['font'] : 'purple' }}-900 bg-{{ isset($action['bg']) ? $action['bg'] : 'purple' }}-100 rounded-lg py-1 px-3">
                                            {{ $action['display'] }}
                                        </button>
                                    </a>
                                @else
                                    <a href="{{ route($action['route'], $object) }}"
                                        class="text-{{ isset($action['font']) ? $action['font'] : 'purple' }}-600 hover:text-{{ isset($action['font']) ? $action['font'] : 'purple' }}-900 bg-{{ isset($action['bg']) ? $action['bg'] : 'purple' }}-100 rounded-lg py-1 px-3">{{ $action['display'] }}</a>
                                @endif
                            @endforeach
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    @if ($pages)
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            {{ $objects->links() }}
        </div>
    @endif
    <style>
        @media (min-width: 640px) {
            table {
                display: inline-table !important;
            }
        }

        @media (max-width: 640px) {
            thead tr {
                display: none !important;
            }
        }

    </style>


</div>
