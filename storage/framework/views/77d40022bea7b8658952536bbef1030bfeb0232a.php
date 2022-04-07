<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Horarios</title>
</head>
<body>
    
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
              
            </tbody>
        </table>
</body>
</html><?php /**PATH C:\Users\lenovo\Documents\xampp\htdocs\Telesis\resources\views/documents/horarios.blade.php ENDPATH**/ ?>