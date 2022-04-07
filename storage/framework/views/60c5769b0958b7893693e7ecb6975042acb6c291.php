<div>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.dialog-modal','data' => ['wire:model' => 'list']]); ?>
<?php $component->withName('jet-dialog-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['wire:model' => 'list']); ?>
         <?php $__env->slot('title'); ?> 
            Reportar al alumno <?php echo e($student?$student->user->fullname():''); ?>

         <?php $__env->endSlot(); ?>

         <?php $__env->slot('content'); ?> 
            <div class="container">
                <div class="flex flex-col ">
                    <div>
                       <table class="min-w-full divide-y divide-gray-200 flex flex-row flex-no-wrap text-left">
                           <thead>
                               <tr>
                                   <th>Realizado Por</th>
                                   <th>Motivo</th>
                                   <th>Fecha</th>
                                   
                                   <th>Acciones</th>
                               </tr>
                           </thead>
                           <tbody>
                               <?php $__currentLoopData = $student->reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <tr>
                                    <td>
                                        <?php echo e($report->user->fullname()); ?>

                                    </td>
                                    <td>
                                        <?php echo e($report->reason); ?>

                                    </td>
                                    <td>
                                        <?php echo e($report->created_at->diffForHumans()); ?>

                                    </td>
                                    <td>

                                    </td>
                               </tr>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           </tbody>
                       </table>
                    </div>
                </div>
            </div>
         <?php $__env->endSlot(); ?>
         <?php $__env->slot('footer'); ?> 
            <div class="sm:px-6 sm:flex sm:flex-row-reverse sm:space-y-0 space-y-2">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.danger-button','data' => ['wire:click' => '$toggle(\'list\')','wire:loading.attr' => 'disabled','class' => 'w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm']]); ?>
<?php $component->withName('jet-danger-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['wire:click' => '$toggle(\'list\')','wire:loading.attr' => 'disabled','class' => 'w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm']); ?>
                    <?php echo e(__('Cerrar')); ?>

                 <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
            </div>
         <?php $__env->endSlot(); ?>
     <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
</div>
<?php /**PATH D:\Proyectos-T\Telesis\resources\views/livewire/student/report-index-component.blade.php ENDPATH**/ ?>