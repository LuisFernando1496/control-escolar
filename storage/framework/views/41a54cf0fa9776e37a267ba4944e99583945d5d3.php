<div>
    
     <?php $__env->slot('header'); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Generar Horario')); ?>

        </h2>
     <?php $__env->endSlot(); ?>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="grid grid-cols-4">
                    
                    <div>
                        <?php echo $__env->make('livewire.schedule.schedule-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div class="col-span-3">
                        <?php echo $__env->make('livewire.schedule.schedule-horario', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH D:\Proyectos-T\Telesis\resources\views/livewire/schedule/schedule-component.blade.php ENDPATH**/ ?>