<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('students.store') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Nombre') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="lastname1" value="{{ __('Apellido Paterno') }}" />
                <x-jet-input id="lastname1" class="block mt-1 w-full" type="text" name="lastname1" :value="old('lastname1')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="lastname2" value="{{ __('Apellido Materno') }}" />
                <x-jet-input id="lastname2" class="block mt-1 w-full" type="text" name="lastname2" :value="old('lastname2')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Correo') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="key" value="{{ __('Clave') }}" />
                <x-jet-input id="key" class="block mt-1 w-full" type="text" name="key" :value="old('key')" required maxlength="8" minlength="8"/>
            </div>

            <div class="mt-4">
                <x-jet-label for="rfc" value="{{ __('RFC') }}" />
                <x-jet-input id="rfc" class="block mt-1 w-full" placeholder="(Opcional)" type="text" name="rfc" :value="old('rfc')" maxlength="13" minlength="13"/>
            </div>

            <div class="mt-4">
                <x-jet-label for="phone" value="{{ __('Telefono') }}" />
                <x-jet-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" onkeyup="validateTel(this.value)" required minlength="10" maxlength="10"/>
            </div>

            <div class="mt-4">
                <x-jet-label for="sex" value="{{ __('Genero') }}" />
                <select id="sex" class="block mt-1 w-full block font-medium text-gray-500" type="text" name="sex" :value="old('sex')" required>
                    <option value="0">Femenino</option>
                    <option value="1">Masculino</option>
                </select>
            </div>

            <div class="mt-4">
                <x-jet-label for="birthday" value="{{ __('Fecha de nacimiento') }}" />
                <x-jet-input id="birthday" class="block mt-1 w-full" type="date" name="birthday" :value="old('birthday')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirmar Contraseña') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>
            {{-- Estudiantes --}}
            <input id="isStudent" hidden type="number" name="isStudent" value="0"/>
            <div id="students" style="display: none">
                <br>
                <hr class="py-3">
                <div class="mt-4">
                    <x-jet-label for="address" value="{{ __('Direccion') }}" />
                    <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')"/>
                </div>

                <div class="mt-4">
                    <x-jet-label for="tutor" value="{{ __('Tutor del alumno') }}" />
                    <select id="tutor" class="block mt-1 w-full block font-medium text-gray-500" name="tutor" :value="old('tutor')">
                    @foreach ($tutors as $tutor)
                      @foreach($tutor->users as $nombre)
                        <option value="{{$nombre->id}}">{{$nombre->name}}</option>
                        @endforeach
                    @endforeach
                </select>
                
                </div>
                <x-jet-label for="blood_id" value="{{ __('Tipo de Sangre') }}" />
                <select id="blood_id" class="block mt-1 w-full block font-medium text-gray-500" name="blood_id" :value="old('blood_id')">
                    @foreach ( \App\Models\Blood::all() as $blood)
                        <option value="{{$blood->id}}">{{$blood->name}}</option>
                    @endforeach
                </select>
                <x-jet-label for="paid" class="text-purple-500" value="{{ __('¿Pago realizado?') }}" />
                <select id="paid" class="block mt-1 w-full block font-medium text-gray-500" type="text" name="paid" :value="old('paid')">
                    <option value="1">Si</option>
                    <option value="0">No</option>
                </select>
                <x-jet-label for="grade_id" class="text-purple-500" value="{{ __('Grado') }}" />
                <select id="grade_id" class="block mt-1 w-full block font-medium text-gray-500" type="text" name="grade_id" :value="old('grade_id')">
                    @foreach (\App\Models\Grade::all() as $grade)
                        <option value="{{$grade->id}}">{{$grade->number}} - {{$grade->description}}</option>
                    @endforeach
                </select>
                <x-jet-label for="group_id" class="text-purple-500" value="{{ __('Grupo') }}" />
                <select id="group_id" class="block mt-1 w-full block font-medium text-gray-500" type="text" name="group_id" :value="old('group_id')">
                    @foreach (\App\Models\Group::all() as $group)
                        <option value="{{$group->id}}">{{$group->name}}</option>
                    @endforeach
                </select>
            </div>
            {{-- End Estudiantes --}}
            {{--Tutores--}}
            <input id="isTutor" hidden type="number" name="isTutor" value="0"/> 
            <div id="tutors" style="display: none">
                <br>
                <hr class="py-3">
                <div class="mt-4">
                    <x-jet-label for="direccion" value="{{ __('Direccion') }}" />
                    <x-jet-input id="direccion" class="block mt-1 w-full" type="text" name="direccion" :value="old('address')"/>
                </div>
                </div>
            {{--End Tutores--}}
            <br>
            <hr class="py-3">
            <p class="text-purple-500 font-medium text-lg mt-4">Cuenta</p>

            <div class="mt-4 border rounded border-purple-400 p-2">
                <x-jet-label for="active" class="text-purple-500" value="{{ __('Activa') }}" />
                <select id="active" class="block mt-1 w-full block font-medium text-gray-500" type="text" name="active" :value="old('active')" required>
                    <option value="1">Si</option>
                    <option value="0">No</option>
                </select>

                <x-jet-label for="roles" class="text-purple-500" value="{{ __('Roles') }}" />
                <select id="roles" multiple class="block mt-1 w-full block font-medium text-gray-500" type="text" name="roles[]" :value="old('roles')" required>
                    @forelse (\App\Models\Role::all() as $role)
                        <option onclick="studentForm(this.value)" value="{{$role->id}}">{{$role->slug}}</option>
                    @empty
                        <option>Sin Roles</option>
                    @endforelse
                </select>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a href="{{ url()->previous() }}" class="bg-red-500 text-red-100 px-3 py-2 rounded-lg" >Regresar</a>
                <x-jet-button class="ml-4">
                    {{ __('Registrar') }}
                </x-jet-button>
            </div>
        </form>
        {{-- Funciones para la vista --}}
        <script>
            var isStudent = 0;
            var isTutor = 0;
            function validateTel(value){
                if(value.length >= 10){
                    document.querySelector("#phone").value = /[0-9]{10}/.test(value) ? value:'';
                }
            }
            // function  genKey() {
            //     let name = document.querySelector('#name').value;
            //     let lastname1 = document.querySelector('#lastname1').value;
            //     let lastname2 = document.querySelector('#lastname2').value;
            //     let year = new Date().getFullYear();
            //     let id = `000${Math.floor(Math.random()*1000)}`.slice(-3);
            //     document.querySelector('#feedback-key').innerText = "";
            //     if ((name+lastname1+lastname2).length >= 6) {
            //         document.querySelector('#key').value =  `${name.slice(0,2)}${lastname1.slice(0,2)}${lastname2.slice(0,2)}-${year}-${id}`.toLocaleUpperCase();
            //     } else {
            //         document.querySelector('#feedback-key').innerText = "Ingresa el Nombre y Apellido";
            //         document.querySelector('#key').value = '';
            //     }

            // }
            function studentForm(option){
               if (option == 3){
                    document.querySelector('#tutors').style.display='none';
                    document.querySelector('#students').style.display='block';
                    isStudent = 1;   
                }
               else if (option == 4){
                    document.querySelector('#students').style.display='none';
                    document.querySelector('#tutors').style.display='block';
                    isTutor = 1;
                    
                }
                 else {
                    document.querySelector('#students').style.display='none';
                    isStudent = 0;
                    document.querySelector('#tutors').style.display='none';
                    isTutor = 0;
                }
                document.querySelector('#isStudent').value = isStudent;
                document.querySelector('#isTutor').value =isTutor;
            }
        </script>
    </x-jet-authentication-card>
</x-guest-layout>
