<div class="flex flex-row w-full">
    <table class="w-full">
        
        <thead>
            <tr>
                <th>Hora</th>
                <th>Lunes</th>
                <th>Martes</th>
                <th>Miercoles</th>
                <th>Jueves</th>
                <th>Viernes</th>
            </tr> 
        </thead>
        <tbody>
            <?php $__currentLoopData = $schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyOne => $sch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('livewire.schedule.horario', [$keyOne], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <tr>
                    <?php $__currentLoopData = $sch; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <td class="bg-blue-100 hover:bg-red-300 w-36 py-3">
                            <div class="flex flex-col">
                                
                                <?php if($whoIs == 'admin' && !$isEditing): ?> 
                                    <button
                                        class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1 px-4 border border-blue-500 hover:border-transparent rounded"
                                        wire:click="materiaSelect(<?php echo e($keyOne); ?> , '<?php echo e($key); ?>')">Poner Aquí</button>
                                <?php endif; ?>
                                <?php echo e(empty($item['materia']) ? 'Sin Materia ' : $item['materia']); ?>

                            </div>
                        </td>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php /**PATH D:\Proyectos-T\Telesis\resources\views/livewire/schedule/schedule-horario.blade.php ENDPATH**/ ?>