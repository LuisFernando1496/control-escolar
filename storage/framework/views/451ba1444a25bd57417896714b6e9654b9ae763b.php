<?php $__env->startSection('content'); ?>

    <img src="<?php echo e(asset('/images/secretaria.png')); ?>" alt="logo" style="float: left;">
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
            Grado: <?php echo e($grade->description); ?> | Grupo: <?php echo e($group->name); ?>

        </span>
        <br>
        <div style="text-align: center;">
            Horario de clases
            </span>
        </div>

        
        <table style="width: 100%;">
            
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
                <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyOne => $dias): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <?php echo $__env->make('documents.shedule-horas', [$keyOne], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php $__currentLoopData = $dias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyDay => $materia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td style="width: 10em;">
                                <?php echo e($materia['materia']); ?>

                            </td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php $__env->stopSection(); ?>

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

<?php echo $__env->make('documents.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/yamile/Documents/Residencia/FINAL/telesis/resources/views/documents/schedule.blade.php ENDPATH**/ ?>