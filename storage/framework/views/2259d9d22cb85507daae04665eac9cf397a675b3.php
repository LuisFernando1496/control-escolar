<div>
     <?php $__env->slot('header'); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Calificaciones')); ?>

        </h2>
     <?php $__env->endSlot(); ?>
    <div>
        <div class="max-w-auto mx-auto sm:px-6 lg:px-8 py-5">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="mt-5 mx-5 flex flex-col">
                    <?php if($isStudent||$isTutor): ?>
                        <button class="bg-indigo-500 text-indigo-100 rounded-lg px-3 py-1 mx-5" wire:click="toggle()"><?php echo e($kardexMode?'Modo Seleccion':'Modo Kardex'); ?></button>
                    <?php endif; ?>
                    
                    <div class="md:flex md:flex-row sm:flex-col border border-solid border-indigo-700 rounded-lg px-5 my-3 py-3">
                        <button class="bg-indigo-500 text-indigo-100 rounded-lg px-3 py-1 mx-5" wire:click="dscargarPdfScore()">Descragar Boleta</button>
                        <label for="group_id" class="px-2">Grupo</label>
                        <?php if($isStudent||$isTutor): ?>
                            <?php echo e(\App\Models\Group::find($group_id)->name); ?>

                        <?php else: ?>
                            <select wire:model="group_id" id="group_id" class="px-2">
                                <option>Seleccione el grado</option>
                                <?php $__currentLoopData = \App\Models\Group::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($group->id); ?>"><?php echo e($group->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        <?php endif; ?>
                        <label for="grade_id" class="px-2">Grado</label>
                        <select wire:model="grade_id" id="grade_id" class="px-2" wire:change="$set('bimester_id',null)">
                            <option>Seleccione el grupo</option>
                            <?php $__currentLoopData = \App\Models\Grade::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($grade->id); ?>"><?php echo e($grade->number); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if(!$kardexMode): ?>
                        
                            <label for="bimester_id" class="px-2">Bimestre</label>
                            <select wire:model="bimester_id" id="bimester_id" class="px-2">
                                <option>Seleccione el bimestre</option>
                                <?php $__currentLoopData = \App\Models\Bimester::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bimester): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(($grade_id - 1) * 6 < ($bimester->number) && $grade_id * 6 >= intval($bimester->number)): ?>
                                        <option value="<?php echo e($bimester->id); ?>"><?php echo e($bimester->number); ?></option>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                
                                <?php if($kardexMode): ?>
                                    <table class="min-w-full divide-y divide-gray-200 flex flex-row flex-no-wrap text-left">
                                        <thead>
                                           
                                            <tr class="flex flex-col flex-no wrap sm:table-row">
                                                <th colspan="11"  class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                                    Estudiante: <?php echo e($student_->user->fullname()); ?>

                                                </th>
                                            </tr>
                                            <tr class="flex flex-col flex-no wrap sm:table-row">
                                                <th scope="col"
                                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bimestre</th>
                                                <?php if($subjects): ?>
                                                    <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <th scope="col"
                                                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            <?php echo e($subject->name); ?>

                                                        </th>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                                <th scope="col"
                                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Promedio</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <?php if($students->count() > 0): ?>
                                                <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php $__currentLoopData = \App\Models\Bimester::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bimester): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if(($grade_id - 1) * 6 < ($bimester->number) && $grade_id * 6 >= intval($bimester->number)): ?>
                                                            <tr class="flex flex-col flex-no wrap sm:table-row <?php echo e($student->banned ? 'bg-red-100': ''); ?>">
                                                                <td class="px-6 py-4 whitespace-nowrap text-left">Bimestre <?php echo e($bimester->number); ?></td>
                                                                <?php if($subjects): ?>
                                                                    <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <td class="px-6 py-4 whitespace-nowrap text-left">
                                                                            <?php
                                                                                $score = $student->scoreBySubject($subject->id,$bimester->id);
                                                                            ?>
                                                                            <?php if($isStudent || $isTutor): ?>
                                                                                <span class="extra-info"><?php echo e($subject->name); ?></span>
                                                                                <label class="text-black text-bold"><?php echo e($score?$score->score:'Sin Captura'); ?></label>
                                                                            <?php else: ?>
                                                                                <?php if($student_ && $student->id == $student_->id): ?>
                                                                                    <input class="boeder border-indigo-500 rounded-lg px-2" wire:model="scoreRow.s<?php echo e($subject->id); ?>" type="number" max="10" min="0" step="0.1" placeholder="0">
                                                                                <?php else: ?>
                                                                                    <label class="text-black text-bold"><?php echo e($score?$score->score:'Sin Captura'); ?></label>
                                                                                <?php endif; ?>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php endif; ?>
                                                                <td class="px-6 py-4 whitespace-nowrap text-left"><?php echo e($student->bimesterAverage($bimester->id)); ?></td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <tr class="flex flex-col flex-no wrap sm:table-row">
                                                    <td colspan="11" class="px-6 py-4 whitespace-nowrap text-right">
                                                        <span class="border border-purple-500 rounded-lg px-3 py-1">
                                                            Promedio Anual: <?php echo e($student_->yearAverage()); ?>

                                                        </span>
                                                        <span class="border border-purple-500 rounded-lg px-3 py-1">
                                                            Promedio General: <?php echo e($student_->average()); ?>

                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php else: ?>
                                                <p class="bg-red-600 w-full px-5 py-5 text-center mx-auto block text-red-200">No hay registros</p>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <?php if($bimester_id && $group_id && $grade_id): ?>
                                        <table class="min-w-full divide-y divide-gray-200 flex flex-row flex-no-wrap text-left">
                                            <thead>
                                                <tr class="flex flex-col flex-no wrap sm:table-row">
                                                    <th scope="col"
                                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Estudiante
                                                    </th>
                                                    <?php if($subjects): ?>
                                                        <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <th scope="col"
                                                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                <?php echo e($subject->name); ?>

                                                            </th>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                    <th>
                                                        Acciones
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <?php if($students->count() > 0): ?>
                                                    <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr class="flex flex-col flex-no wrap sm:table-row <?php echo e($student->banned ? 'bg-red-100': ''); ?>">
                                                            
                                                            <td class="touchable px-6 py-4 whitespace-nowrap text-left hover:bg-indigo-400 <?php if($student_ && $student->id == $student_->id): ?> bg-indigo-600 text-white rounded-lg <?php endif; ?>" wire:click="setStudent('<?php echo e($student->id); ?>')">
                                                                <div style="inline-flex">
                                                                    <?php echo e($student->user->fullname()); ?>

                                                                    <br>
                                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php if($student->user->active && !$student->banned): ?> bg-green-100 text-green-800 <?php else: ?> bg-red-100 text-red-800  <?php endif; ?>">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="1rem">
                                                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                                                        </svg>
                                                                        <b class="px-2"><?php echo e($student->user->key); ?></b>
                                                                        <?php echo e($student->user->active ? 'Activo': 'Inactivo'); ?>

                                                                    </span>
                                                                </div>
                                                            </td>
                                                            <?php if($subjects): ?>
                                                                <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <td class="px-6 py-4 whitespace-nowrap text-left">
                                                                        <?php
                                                                            $score = $student->scoreBySubject($subject->id,$bimester_id);
                                                                        ?>
                                                                        <?php if($isStudent || $isTutor): ?>
                                                                            <span class="extra-info"><?php echo e($subject->name); ?></span>
                                                                            <label class="text-black text-bold"><?php echo e($score?$score->score:'Sin Captura'); ?></label>
                                                                        <?php else: ?>
                                                                            <?php if($student_ && $student->id == $student_->id ): ?>
                                                                              <input class="boeder border-indigo-500 rounded-lg px-2" wire:model="scoreRow.s<?php echo e($subject->id); ?>" type="number" max="10" min="0" step="0.1" placeholder="0">
                                                                            <?php else: ?>
                                                                                <span class="extra-info"><?php echo e($subject->name); ?></span>
                                                                                <label class="text-black text-bold"><?php echo e($score?$score->score:'Sin Captura'); ?></label>
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endif; ?>
                                                            <td>
                                                                <div class=" inline-flex">
                                                                    <?php if($isStudent || $isTutor): ?>
                                                                        📗📘📙
                                                                    <?php else: ?>
                                                                        <button class="mx-1 px-3 py-2 bg-indigo-600 text-white rounded-lg" wire:click="save('<?php echo e($student->id); ?>')">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="1em">
                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                                            </svg>
                                                                        </button>
                                                                        <?php if($student_ && $student->id == $student_->id): ?>
                                                                            <button class="float-right px-3 py-2 bg-red-600 text-white rounded-lg" wire:click="setnull()">
                                                                            X
                                                                            </button>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                    <p class="bg-red-600 w-full px-5 py-5 text-center mx-auto block text-red-200">No hay registros</p>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                                            <?php echo e($students->links()); ?>

                                        </div>
                                    <?php else: ?>
                                        <p class="bg-red-600 w-full px-5 py-5 text-center mx-auto block text-red-200">Seleccione Grado, Grupo y Bimestre</p>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .touchable{
                cursor: pointer;
            }
            @media (min-width: 640px) {
              table {
                display: inline-table !important;
              }
              .extra-info{
                  display: none;
              }
            }
            @media (max-width: 640px) {
                thead tr {
                    display: none !important;
                }
                .extra-info{
                    display: flex;
                }
            }
          </style>
    </div>

</div>
<?php /**PATH D:\Proyectos-T\Telesis\resources\views/livewire/score/main-component.blade.php ENDPATH**/ ?>