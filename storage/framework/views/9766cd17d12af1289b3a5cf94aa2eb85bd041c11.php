<div>
    
    <?php echo $__env->make('livewire.access-control.form-modal' , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('livewire.access-control.privilegios-modal' , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
     <?php $__env->slot('header'); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Control de acceso')); ?>

        </h2>
     <?php $__env->endSlot(); ?>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="flex flex-col">
                    <div class="flex flex-row-reverse">
                        <button wire:click="showModalNew" class="text-white bg-purple-500 hover:bg-purple-700 py-3 px-4">
                            Nuevo Rol </button>
                    </div>
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <?php if(isset($roles)): ?>
                                    <table
                                        class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden  my-5">
                                        <thead class="text-white">

                                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr
                                                    class="bg-purple-400 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                                                    <th class=" p-3 text-left">Nombre</th>
                                                    <th class="p-3 text-left">Descripcion</th>
                                                    <th class="p-3 text-left">Acceso total</th>
                                                    <th class="p-3 text-left">Estado</th>
                                                    <th class="p-5 text-left">Acciones</th>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </thead>

                                        <tbody class="flex-1 sm:flex-none">
                                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">
                                                    <td class="border-grey-light border hover:bg-gray-100 p-3">
                                                        <?php echo e($role->name); ?>

                                                    </td>
                                                    <td class="border-grey-light border hover:bg-gray-100 p-3">
                                                        <?php echo e($role->description); ?>

                                                    </td>
                                                    <td class="border-grey-light border hover:bg-gray-100 p-3 ">
                                                        <div class="flex justify-start sm:justify-center m-2">
                                                            <?php if($role->full_access == 'yes'): ?>
                                                                <div
                                                                    class="text-green-700 text-sm mr-4 bg-green-100 rounded-md px-2">
                                                                    activado
                                                                </div>
                                                            <?php else: ?>
                                                                <div
                                                                    class=" text-red-700 text-sm mr-4 bg-red-100 rounded-md px-2">
                                                                    Acesso limitado
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </td>
                                                    <td class="border-grey-light border p-2">
                                                        <div class="flex justify-start sm:justify-center m-2">
                                                            <?php if($role->active): ?>
                                                                <div
                                                                    class="text-green-700 text-sm mr-4 bg-green-100 rounded-md px-2">
                                                                    activado
                                                                </div>
                                                            <?php else: ?>
                                                                <div
                                                                    class=" text-red-700 text-sm mr-4 bg-red-100 rounded-md px-2">
                                                                    Desactivado
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </td>
                                                    <td class="border-grey-light border py-1">
                                                        <div class="flex justify-start  m-2 ">
                                                            <button
                                                            wire:click="showModalEdit(<?php echo e($role->id); ?>)"
                                                                class="text-blue-900 bg-blue-100 px-2 rounded-lg ">Editar</button>
                                                            <button
                                                            wire:click="privilegiosShowModal(<?php echo e($role->id); ?>)"
                                                                class="text-blue-900 bg-blue-100 px-2 rounded-lg ml-1">Privilegios</button>
                                                        </div>

                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>

                                    </table>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <style>
        @media (min-width: 640px) {
            table {
                display: inline-table !important;
            }

            thead tr:not(:first-child) {
                display: none;
            }
        }

        td:not(:last-child) {
            border-bottom: 0;
        }

        th:not(:last-child) {
            border-bottom: 2px solid rgba(0, 0, 0, .1);
        }

    </style>
<?php /**PATH D:\Proyectos-T\Telesis\resources\views/livewire/access-control/main-component.blade.php ENDPATH**/ ?>