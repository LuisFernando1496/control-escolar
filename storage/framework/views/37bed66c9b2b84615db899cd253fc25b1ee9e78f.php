<?php $__env->startSection('title'); ?>
    Carta de Buena Conducta
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header'); ?>
    <img src="<?php echo e(asset('/images/secretaria.png')); ?>" alt="" class="left logo">
    <span class="right letterhead">
        SECRETARIA DE EDUCACIÓN
        <br>
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
    </span>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="adjust">
        <span class="subject">
            ASUNTO: Carta de conducta.
        </span>
        <br>
        <br>
        <span class="greeting">
            <u>
                A QUIEN CORRESPONDA:
            </u>
        </span>
        <br>
        <p class="message justify">
            EL QUE SUSCRIBE, <?php echo e(strtoupper($school->boss)); ?>, DIRECTOR DE LA ESCUELA TELESECUNDARIA 649 “ JOSÉ VASCONCELOS CALDERÓN ", CLAVE: 07ETV0653N DEL EJIDO CATEDRAL DE CHIAPAS, MUNICIPIO DE OSTUACAN, CHIAPAS:
        </p>
        <div class="center">
            HACE CONSTAR:
        </div>
        <p class="message justify">
            QUE LA ALUMNA:  <?php echo e(strtoupper($student->user->fullname())); ?>, CON NUMERO DE MATRICULA <?php echo e(strtoupper($student->user->key)); ?>, DURANTE SU ESTANCIA EN ESTA INSTITUCION EDUCATIVA OBSERVO:
        </p>
        <div class="center">
            <br><br>
            <u>
                <?php echo e(strtoupper($behaviour)); ?> CONDUCTA.
            </u>
            <br><br>
            <br>
        </div>
        <p class="message">
            PARA LOS FINES LEGALES Y CONDUCENTES QUE LA INTERESADA CONVENGAN, SE EXTIENDE LA PRESENTE CARTA DE CONDUCTA, EN EL EJIDO CATEDRAL DE CHIAPAS, MUNICIPIO DE OSTUACÁN, CHIAPAS A LOS <?php echo e($now->format('j')); ?> DIAS DEL MES DE <?php echo e(strtoupper($month)); ?> DEL <?php echo e($now->format('Y')); ?>.
        </p>
        <br>
        <div class="center sign">
            ATENTAMENTE.
            <br>
            EL DIRECTOR DE LA ESCUELA.
            <br>
            <p class="boss">
                <?php echo e($school->boss); ?>.
            </p>
        </div>
    </div>
    <style>
        .adjust{
            margin-left: 45px;
        }
        .logo{
            padding: 44px 10px;
        }
        .letterhead{
            width: 55%;
            padding: 20px;
            text-align: left;
            font-size: small;
        }
        .right{
            float:right;
        }
        .left{
            float: left;
        }
        .justify{
            text-align: justify;
        }
        .subject{
           position: absolute;
           top: 0;
           right: 0;
        }
        .center{
            text-align: center;
        }
        .sign{
            font-style: italic;
            font-weight: 500;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('documents.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/yamile/Documents/Residencia/FINAL/telesis/resources/views/documents/letter.blade.php ENDPATH**/ ?>