<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{$user->fullname()}}
    </h2>
    <small>{{$user->displayRoles()}}</small>
</x-slot>

{{-- Seccion de usuarios --}}
<div>
    <div class="mt-10 sm:mt-0">
      <div class="md:grid md:grid-cols-3 md:gap-6 mt-5 mx-10">
        <div class="md:col-span-1">
          <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Informacion Personal</h3>
            <p class="mt-1 text-sm text-gray-600">
              Verifica que tus datos personales sean correctos
            </p>
          </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
            {{-- Asignando la funcion save cuando se actualiza el formulario --}}
          <form wire:submit.prevent="save">
            <div class="shadow overflow-hidden sm:rounded-md">
              <div class="px-4 py-5 bg-white sm:p-6">
                <div class="grid grid-cols-6 gap-6">
                  <div class="col-span-6 sm:col-span-2">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" name="name" id="name" autocomplete="name" wire:model="user.name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                  </div>
                  <div class="col-span-6 sm:col-span-2">
                    <label for="lastname1" class="block text-sm font-medium text-gray-700">Apellido Paterno</label>
                    <input type="text" name="lastname1" id="lastname1" autocomplete="lastname1" wire:model="user.lastname1" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                  </div>
                  <div class="col-span-6 sm:col-span-2">
                    <label for="lastname2" class="block text-sm font-medium text-gray-700">Apellido Materno</label>
                    <input type="text" name="lastname2" id="lastname2" autocomplete="lastname2" wire:model="user.lastname2" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                  </div>

                  @if(!Auth::user()->findRole('alumno'))
                      <div class="col-span-6 sm:col-span-2">
                      <label for="rfc" class="block text-sm font-medium text-gray-700">RFC</label>
                      <input type="text" name="rfc" id="rfc" minlength="13" maxlength="13" autocomplete="rfc" wire:model="user.rfc" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                      </div>
                  @endif

                  <div class="col-span-6 sm:col-span-2">
                      <label for="phone" class="block text-sm font-medium text-gray-700">Telefono</label>
                      <input type="tel" name="phone" id="phone" autocomplete="phone" wire:model="user.phone" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" maxlength="10" minlength="10">
                  </div>
                  <div class="col-span-6 sm:col-span-2">
                      <label for="birthday" class="block text-sm font-medium text-gray-700">Fecha de nacimiento</label>
                      <input type="date" name="birthday" id="birthday" autocomplete="birthday" wire:model="user.birthday" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                  </div>
                  <div class="col-span-6 sm:col-span-2">
                      <label for="sex" class="block text-sm font-medium text-gray-700">Genero</label>
                      <select name="sex" id="sex" autocomplete="sex" wire:model="user.sex" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                          <option value="0">Femenino</option>
                          <option value="1">Masculino</option>
                      </select>
                  </div>
                  @if(Auth::user()->findRole('admin'))
                      <div class="col-span-6 sm:col-span-2">
                          <label for="active" class="block text-sm font-medium text-gray-700">Activo</label>
                          <select name="active" id="active" autocomplete="active" wire:model="user.active" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                              <option value="0">No</option>
                              <option value="1">Si</option>
                          </select>
                      </div>
                  @endif
              </div>
              <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                  <small class="text-red-400">
                      @if($errors->count()>0)
                          {{$errors->first()}}
                      @endif
                  </small>
                  <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white @if($errors->count()>0) bg-red-600 hover:bg-red-700 @else  bg-indigo-600 hover:bg-indigo-700 @endif focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                      Guardar
                  </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="hidden sm:block" aria-hidden="true">
      <div class="py-5">
        <div class="border-t border-gray-200"></div>
      </div>
    </div>
      <ul>
          @foreach ($errors as $error)
          <li>{{$error}}</li>
          @endforeach
      </ul>
    {{-- Seccion de estudiante --}}
    @if($user->findRole('alumno'))
      <div class="mt-10 sm:mt-0">
          <div class="md:grid md:grid-cols-3 md:gap-6 mt-5 mx-10">
          <div class="md:col-span-1">
              <div class="px-4 sm:px-0">
              <h3 class="text-lg font-medium leading-6 text-gray-900">Estudiante</h3>
              <p class="mt-1 text-sm text-gray-600">
                  Informacion del estudiante
              </p>
              </div>
          </div>
          <div class="mt-5 md:mt-0 md:col-span-2">
              <div class="shadow overflow-hidden sm:rounded-md">
                  <div class="px-4 py-5 bg-white sm:p-6">
                      <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-2">
                          <label for="address" class="block text-sm font-medium text-gray-700">Direccion</label>
                          <input type="text" disabled name="address" id="address" value="{{$user->student->address}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="col-span-6 sm:col-span-2">
                          <label for="strikes" class="block text-sm font-medium text-gray-700">Numero de reportes</label>
                          <input type="text" disabled name="strikes" id="strikes" value="{{$user->student->strikes}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="col-span-6 sm:col-span-2">
                          <label for="tutor" class="block text-sm font-medium text-gray-700">Tutor</label>
                          <input type="text" disabled name="tutor" id="tutor" value="{{$user->student->tutor->name}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="col-span-6 sm:col-span-2">
                          <label for="blood_id" class="block text-sm font-medium text-gray-700">Tipo de sangre</label>
                          <input type="text" disabled name="blood_id" id="blood_id" value="{{$user->student->blood->name}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="col-span-6 sm:col-span-2">
                          <label for="behaviour" class="block text-sm font-medium text-gray-700">Comportamiento</label>
                          <input type="text" disabled name="behaviour" id="behaviour" value="{{$user->student->behaviour}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        {{-- si es docente o admin --}}
                            <div class="col-span-6 sm:col-span-2">
                                <label for="banned" class="block text-sm font-medium text-gray-700">Expulsado</label>
                                <input type="text" disabled name="banned" id="banned" value="{{$user->student->banned? 'Si':'No'}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                            @if($user->student->banned)
                                <div class="col-span-6 sm:col-span-2">
                                    <label for="banned_time" class="block text-sm font-medium text-gray-700">Expulsión Finaliza</label>
                                    <input type="text" disabled name="banned_time" id="banned_time" value="{{\Carbon\Carbon::create($user->student->banned_time)->diffForHumans()}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                </div>
                            @endif
                        {{-- si es administrador --}}
                            <div class="col-span-6 sm:col-span-2">
                                <label for="paid" class="block text-sm font-medium text-gray-700">Pago realizado</label>
                                <input type="text" disabled name="paid" id="paid" value="{{$user->student->paid ? 'Si':'No'}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>

                      </div>
                  </div>
              </div>
          </div>
          </div>
      </div>
    @endif
</div>
