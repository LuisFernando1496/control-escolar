<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cartas de Conducta') }}
        </h2>
    </x-slot>
    @if ($record)
    {{-- Modal de delete --}}
        <x-confirm-deletion title="Carta de Conducta" :dataToDelete="'El registro de '.$record->student->user->fullname()" methodDelete="destroy"/>
    {{-- ----------- --}}
    {{-- Modal de edicion --}}
        @include('livewire.history.edit-modal')
    @endif
    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 my-5">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <x-table-index :searchBar="$isStudent ? null : $search " :pages="$pages" :objects="$records" :objectProps="$props" :headers="$headers" :actions="$actions">
                                @foreach ($records as $record)
                                <tr class="flex flex-col flex-no wrap sm:table-row">
                                    <td class="px-6 py-4 whitespace-nowrap text-{{isset($prop['color'])?$prop['color']:'gray'}}-{{isset($prop['w'])?$prop['w']:'500'}}">
                                        <span class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full">
                                            {{$record->student->user->fullname()}} - {{$record->student->user->key}}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-{{isset($prop['color'])?$prop['color']:'gray'}}-{{isset($prop['w'])?$prop['w']:'500'}}">
                                        <span class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full">
                                            {{$record->grade->description}}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-{{isset($prop['color'])?$prop['color']:'gray'}}-{{isset($prop['w'])?$prop['w']:'500'}}">
                                        <span class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full">
                                            {{$record->group->name}}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-{{isset($prop['color'])?$prop['color']:'gray'}}-{{isset($prop['w'])?$prop['w']:'500'}}">
                                        <span class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full">
                                            {{$record->score==-1 ? 'No Capturado': $record->score}}
                                        </span>
                                    </td>
                                    @if(count($actions)>0)
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            @foreach ($actions as $action)
                                                @if(isset($action['method']))
                                                    <a href="#">
                                                        <button wire:click="{{ $action['method'].'('.$record->id.')' }}" class="shadow my-1 text-{{isset($action['font'])?$action['font']:'purple'}}-600 hover:text-{{isset($action['font'])?$action['font']:'purple'}}-900 bg-{{isset($action['bg'])?$action['bg']:'purple'}}-100 rounded-lg py-1 px-3">
                                                            {{$action['display']}}
                                                        </button>
                                                    </a>
                                                @else
                                                    <a href="{{route($action['route'],$record)}}"  {{ $target ? 'target="_bank"' : ''}} class="shadow my-1 text-{{isset($action['font'])?$action['font']:'purple'}}-600 hover:text-{{isset($action['font'])?$action['font']:'purple'}}-900 bg-{{isset($action['bg'])?$action['bg']:'purple'}}-100 rounded-lg py-1 px-3">{{$action['display']}}</a>
                                                @endif
                                            @endforeach
                                        </td>
                                    @endif
                                    </tr>
                                @endforeach
                            </x-table-index>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
