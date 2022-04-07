<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title'); ?></title>
</head>
<body>
    <div class="header">
        <?php echo $__env->yieldContent('header'); ?>
    </div>
    <div class="content">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <style>
        .header{
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            padding-top: 0;
            margin: 20px auto;
            display:block;
            height:300px;
        }
        .content{
            position: absolute;
            top:350px;
            left: 0;
            display: block;
            text-align: justify;
        }
        body {
            position: relative;
            height: 100vh;
            width: 98%;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        body::before{
            content: "";
            position: absolute;
            top: 0px;
            right: 0px;
            bottom: 0px;
            left: 0px;
            opacity: 0.35;
            background-size: contain;
            background-repeat: no-repeat;
            background-image: url('images/logo.png');
            background-position: center;
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
        .center{
            text-align: center;
        }
    </style>
</body>
</html>
<?php /**PATH /Users/yamile/Documents/Residencia/FINAL/telesis/resources/views/documents/template.blade.php ENDPATH**/ ?>