<?php
    $max = 5;
?>
<?php $__env->startSection('header'); ?>
    <img src="<?php echo e(asset('/images/secretaria.png')); ?>" alt="logo" class="left logo">
    <span class="right letterhead" style="font-size:11px">
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
            C.C.T.   07ETV0653N
            <br>
            EJIDO CATEDRAL DE CHIAPAS, MPIO. OSTUACAN, CHIAPAS.
            <br>
            <br>
        </b>
    </span>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <span class="right">
        Ciclo Escolar <?php echo e($date->format('Y')); ?> - <?php echo e($date->addYear(1)->format('Y')); ?>

    </span>
    <span class="left">
        Grado: <?php echo e($grade->description); ?>  |  Grupo: <?php echo e($group->name); ?>

    </span>
    <br>
    <div class="center">
        Lista de asistencia del mes de <?php echo e($month); ?>

    </span>
    <table id="table" style="font-size: 11px;">
        <thead>
            <tr>
                <th>No</th>
                <th>Estudiante</th>
                <th>Clave</th>
                <?php for($i = 0; $i < $max; $i++ ): ?>
                <th>L</th>
                <th>M</th>
                <th>M</th>
                <th>J&nbsp;</th>
                <th>V</th>
                <?php endfor; ?>
            </tr>
        </thead>
        <tbody>

            <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($student->user->fullname()); ?></td>
                    <td><?php echo e($student->user->key); ?></td>
                    <?php for($i = 0; $i < $max*5; $i++ ): ?>
                        <td>&nbsp;</td>
                    <?php endfor; ?>
                </tr>
                <?php if($loop->iteration % 15 == 0): ?>
                    <div class="page-break"></div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </tbody>
    </table>
    <br>
    <div class="center margin" style="font-size: 11px;">
        <span class="left">ASESOR DEL GRUPO <br> <?php echo e($user->fullname()); ?> </span>
        <span class="right">VTO. BNO.  <br>EL DIRECTOR DE LA ESCUELA<br><?php echo e($school->boss); ?></span>
    </div>
<style>
    table{
        width: 100%;
        margin-bottom: 10px;
        text-align: center;
        border-collapse: separate;
        border-spacing: 1px;
        border-color: darkolivegreen;
        border-style: solid;
        border-width: 1px;
    }
    table td,
    table th {
        border-left: 0;
        border-right: 0.05em solid darkolivegreen;
        border-top: 0;
        border-bottom: 0.05em solid darkolivegreen;
    }
    .content{
        top: 170px !important;
    }
    .logo{
        padding: 5px 25px;
        width: 170px;
        max-width: 170px;
    }
    .letterhead{
        width: 60%;
        padding: 20px;
        text-align: left;
        font-size: small;
    }
    .margin{
        margin-top: 10px;
        margin-left: 50px;
        margin-right: 50px;
    }
    .page-break {
        page-break-after: always;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('documents.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lenovo\Documents\xampp\htdocs\Telesis\resources\views/documents/list.blade.php ENDPATH**/ ?>