<div>
     <?php $__env->slot('header'); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Users')); ?>

        </h2>
     <?php $__env->endSlot(); ?>
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-5">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="flex-col flex">
                    <div class="block">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('hasPermission', 'user.teacher.create')): ?>
                            <a class="px-3 py-2 bg-indigo-700 text-indigo-400 hover:text-white float-right" href="<?php echo e(route('students.register')); ?>">
                                Crear Usuario
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <div class="flex bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                                    <input wire:model='search' class="form-input rounded-md shadow-sm mt-1 block w-full" type="text" placeholder="Ingrese la Clave de usuario o Correo">
                                    <div class="form-input rounded-md shadow-sm mt-1 ml-6 block">
                                        <select wire:model="perPage" name="range" class="outline-none text-gray-500 text-sm">
                                            <?php $__currentLoopData = [5,10,15,20,50,100]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($option); ?>"><?php echo e($option); ?> por página</option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <?php if (! ($search == '')): ?>
                                        <button wire:click="clear" class="form-input rounded-md shadow-sm mt-1 ml-6 block btn text-red-500">
                                            X
                                        </button>
                                    <?php endif; ?>
                                </div>
                                 <?php if (isset($component)) { $__componentOriginale23df974567224051fb852b6d449ebc8dbd8d859 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Actions\ConfirmDeletion::class, ['title' => 'Eliminar Usuario','dataToDelete' => $userFullname,'methodDelete' => 'destroy']); ?>
<?php $component->withName('confirm-deletion'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginale23df974567224051fb852b6d449ebc8dbd8d859)): ?>
<?php $component = $__componentOriginale23df974567224051fb852b6d449ebc8dbd8d859; ?>
<?php unset($__componentOriginale23df974567224051fb852b6d449ebc8dbd8d859); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
                                <?php if($users->count()): ?>
                                    <table class="min-w-full divide-y divide-gray-200 flex flex-row flex-no-wrap">
                                        <thead>
                                            <tr class="flex flex-col flex-no wrap sm:table-row">
                                                <th scope="col"
                                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Nombre
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Informacion
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Status
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Role
                                                </th>
                                                <th scope="col" class="px-6 py-3 bg-gray-50">
                                                    <span class="sr-only">Edit</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr class="flex flex-col flex-no wrap sm:table-row">
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-10 w-10">
                                                                <img class="h-10 w-10 rounded-full"
                                                                    src="<?php echo e($user->profile_photo_url); ?>"
                                                                    alt="<?php echo e($user->fullname()); ?>">
                                                            </div>
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    <?php echo e($user->fullname()); ?>

                                                                </div>
                                                                <div class="text-sm text-gray-500">
                                                                    <?php echo e($user->email); ?> <?php if(!$user->findRole('alumno')): ?> | RFC <?php echo e($user->rfc); ?><?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900 font-medium flex">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="1rem">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                            </svg>
                                                            <span class="pl-5">
                                                                <?php echo e($user->phone); ?>

                                                            </span>
                                                        </div>
                                                        <div class="text-sm text-gray-500 font-medium flex">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="1rem">
                                                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                                            </svg>
                                                            <span class="pl-5">
                                                                <?php echo e($user->key); ?>

                                                            </span>
                                                        </div>
                                                        <div class="text-sm text-gray-500 font-medium">
                                                            <span>
                                                                <?php echo e($user->birthday); ?> | <?php echo e($user->sex? 'F':'M'); ?>

                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <span
                                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php if($user->active): ?> bg-green-100 text-green-800 <?php else: ?> bg-red-100 text-red-800  <?php endif; ?>">
                                                            <?php echo e($user->active ? 'Activo': 'Inactivo'); ?>

                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <?php echo e($user->displayRoles()); ?>

                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <button wire:click="edit(<?php echo e($user); ?>)"  class="text-indigo-600 hover:text-indigo-900 bg-purple-100 rounded-lg py-1 px-3">Editar</button>
                                                        <button wire:click="deleteConfirmationModal(<?php echo e($user); ?>)" class="text-red-600 hover:text-red-900 bg-red-100 rounded-lg py-1 px-3">Eliminar</button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                                        <?php echo e($users->links()); ?>

                                    </div>
                                <?php else: ?>
                                <div class="bg-white px-4 py-3 border-t border-gray-500 sm:px-6">
                                    Sin resultados para: <?php echo e($search); ?>

                                </div>
                                <?php endif; ?>
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
            }
            @media (max-width: 640px) {
                thead tr {
                    display: none !important;
                }
            }
          </style>
    </div>
</div>
<?php /**PATH C:\Users\carlos velazco\Documents\xampp\htdocs\Telesis\resources\views/livewire/user/main-component.blade.php ENDPATH**/ ?>