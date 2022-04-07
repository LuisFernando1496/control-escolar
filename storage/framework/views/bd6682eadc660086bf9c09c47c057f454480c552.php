<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    
    <?php echo $__env->yieldContent('head'); ?>
    <style>
        .page-break {
            page-break-after: always;
        }

        .center {
            margin-left: auto;
            margin-right: auto;
        }

        .bold-text {
            font-weight: bold;
        }

        .column {
            float: left;
            width: 25%;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

    </style>
</head>

<body>
    <?php echo $__env->yieldContent('content'); ?>
</body>

</html>
<?php /**PATH D:\Proyectos-T\Telesis\resources\views/documents/base.blade.php ENDPATH**/ ?>