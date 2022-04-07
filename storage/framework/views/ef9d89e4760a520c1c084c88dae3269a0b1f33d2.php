
<?php $__env->startSection('content'); ?>
<style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    th {
        text-align: center;
    }
    td {
        text-align: center;
    }

</style>
    <img src="images/secretaria.png">
    <div style="margin-left: auto;
                        margin-right: auto; width: 30em;">
        <span style="
                                font-size:11px; 
                                width: 60%;
                                padding: 20px;
                                text-align: justify;
                                font-size: small;
                                margin-left: auto;
                                margin-right: auto;
                                ">
            <b>
                SUBSECRETARIA DE EDUCACION ESTATAL
                <br>
                DIRECCION DE EDUCACION BASICA
                <br>
                DEPARTAMENTO DE EDUCACION TELESECUNDARIA
                <br>
                JEFATURA DE SECTOR 02 ZONA ESCOLAR 029
                <br>
                <?php echo e(strtoupper($school->name)); ?>

                <br>
                C.C.T. 07ETV0653N
                <br>
                EJIDO CATEDRAL DE CHIAPAS, MPIO. OSTUACAN, CHIAPAS.
                <br>
                <br>
            </b>
        </span>
    </div>
    <div class="row-fluid">
        <span style="float:right;">
            Ciclo Escolar <?php echo e($date->format('Y')); ?> - <?php echo e($date->addYear(1)->format('Y')); ?>

        </span>
        <span style="float: left;">
        
        </span>
        <br>
        <div style="text-align: center;">
            Boleta de calificaciones: <?php echo e($student->user->fullname()); ?> <br>
            Tutor: <?php echo e($user->fullname()); ?>

            </span>
        </div>

        
        <table style="width: 100%;"> 
            <thead>
               
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
                                              
                                                    
                                                    <label class="text-black text-bold"><?php echo e($score?$score->score:'Sin Captura'); ?></label>
                                               
                                                   
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
                                Promedio Anual: <?php echo e($student->yearAverage()); ?>

                            </span>
                            <span class="border border-purple-500 rounded-lg px-3 py-1">
                                Promedio General: <?php echo e($student->average()); ?>

                            </span>
                        </td>
                    </tr>
                <?php else: ?>
                    <p class="bg-red-600 w-full px-5 py-5 text-center mx-auto block text-red-200">No hay registros</p>
                <?php endif; ?>
            </tbody>
        </table>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('documents.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lenovo\Documents\xampp\htdocs\Telesis\resources\views/documents/calificaciones.blade.php ENDPATH**/ ?>