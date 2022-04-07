<div>
     <?php $__env->slot('header'); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Instrumentación')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="flex flex-col">
                    <div class="bg-white">
                        <div class="flex flex-col sm:flex-row">

                            <?php if($materias->count() > 0): ?>
                                <?php $__currentLoopData = $materias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $materia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($materia->name == $materiaQuery): ?>
                                        <button wire:click="navigate(<?php echo e($materia); ?>)"
                                            class="text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none text-blue-500 border-b-2 font-medium border-blue-500">
                                            <?php echo e($materia->name); ?>

                                        </button>
                                    <?php else: ?>
                                        <button wire:click="navigate(<?php echo e($materia); ?>)"
                                            class="text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none">
                                            <?php echo e($materia->name); ?>

                                        </button>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="grid grid-rows-1 sm:grid-cols-2 gap-4 pt-5 px-2 py-3 bg-gray-100">
                            <?php if($assets->count() > 0): ?>
                                <?php $__currentLoopData = $assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo $__env->make('livewire.asset.student.card-asset', ['asset' => $asset], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <span
                                    class="h-10 rounded-md bg-blue-200 text-blue-900 flex items-center justify-center">No
                                    se encuentra ningun documento para esta materia</span>
                            <?php endif; ?>
                        <?php else: ?>
                            <span class="h-10 rounded-md bg-red-200 text-red-900 flex items-center justify-center">No
                                No cuenta con ninguna materia</span>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
<?php /**PATH /Users/yamile/Documents/Residencia/FINAL/telesis/resources/views/livewire/asset/student/main-component.blade.php ENDPATH**/ ?>