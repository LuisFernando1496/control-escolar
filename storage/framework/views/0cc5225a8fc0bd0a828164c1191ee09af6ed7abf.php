<?php $__env->startSection('content'); ?>
    
    <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        
        <div style="float: left;">
            <img style=" width: 9rem;" src="images/educacion.jpeg" alt="logo secretaria">
        </div>
        <div style="float: right;">
            <img class="logo-chis" src="images/chis.png" alt="ass">
        </div>
        <div class="center">
            <h3 class="text-center" style="width: 24rem; padding-left: 16rem;">
                SISTEMA DE EDUCACION NACIONAL BOLETA DE EVALUACION
            </h3>
        </div>
        <div style="margin-left: 10em; padding-top: 5rem;">

            <span
                style="font-size: 15px; text-align: center "><?php echo e($student->current_grade_id == 1 ? '1er' : ($student->current_grade_id == 2 ? '2º' : ($student->current_grade_id == 3 ? '3º' : ''))); ?>

                GRADO DE EDUCACIÓN SECUNDARIA CICLO ESCOLAR</span> <strong>   <?php echo e($student->date->copy()->subYear()->year); ?> - <?php echo e($student->date->year); ?></strong> <br />
            <span style="font-size: 14px bold;  font-weight: bold;">SIN OFICIALIZAR Fecha de impresion:
                <?php echo e(date('Y-m-d H:i:s')); ?>

            </span>
        </div>
        

        <div style="margin-top: 1rem;">
            <span> DATOS DEL ALUMNO
                
            </span>
            <div class="row" style="margin-top: 1rem;">
                <div class="column" style="position: relative;">
                    <span class="bold-text"<?php echo e(strlen($student->user->lastname1) > 8 ?: 'style="font-size: 9px"'); ?>> <?php echo e(strtoupper($student->user->lastname1)); ?> </span>
                    <div style="position: absolute; left:0px; top:0px; margin-top: 20px;">PRIMER APELLIDO</div>
                </div>
                <div class="column" style="position: relative;">
                    <span class="bold-text" style="width 50px; <?php echo e(strlen($student->user->lastname1) < 12 ?: 'font-size: 10px;'); ?>>"> <?php echo e(strtoupper($student->user->lastname2)); ?> </span>
                    <div style="position: relative; left: 0px; margin-top: 0px;">SEGUNDO APELLIDO</div>
                </div>
                <div class="column" style="position: relative;">
                    <span class="bold-text"> <?php echo e(strtoupper($student->user->name)); ?> </span>
                    <div style="position: absolute; left:0px; top:0px; margin-top: 20px;">NOMBRE(S)</div>
                </div>
                <div class="column" style="position: relative;">
                    <span class="bold-text"> <?php echo e($student->user->curp); ?> </span>
                    
                    <div  style="position: absolute; left:0px; top:0px; margin-top: 20px;">CURP</div>
                </div>
                
            </div>
        </div>
        <div style="margin-top: 1rem;" class="row-fluid mt-4">DATOS DE LA ESCUELA</div>
        <div class="row" style="font-size: 14px;">
            <div style="float: left;
                            width: 50%; font-size: 12px;">
                <span class="linea"> TELESECUNDARIA 649 JOSE VASCONCELOS CALDERON </span> <br />
                <span>NOMBRE DE LA ESCUELA</span>
            </div>
            <div style="float: left;
                            width: 15%;">
                <span> <?php echo e($student->currentGroup->name); ?> </span> <br />
                <div class="linea-grupo"></div>
                <span>GRUPO</span>
            </div>
            <div style="float: left;
                            width: 15%;">
                <span class="linea">CONTINUO</span> <br />
                <span>TURNO</span>
            </div>
            <div style="float: left;
                            width: 20%;">
                <span class="linea">07ETV0653N</span> <br />
                <span>CCT</span>
            </div>
        </div>

        
        <div style="clear:both; position:relative;">
            <div style="position:absolute; left:0pt; width:192pt;">
                <table class="tb-cal setPrimera" id="tb-cal">
                    <thead>
                        <tr style="font-size: 13px;">
                            <th colspan="2">Asignaturas/Areas</th>
                            <th colspan="3" style="font-size: 12px;">PERIODOS DE EVALUACIÓN</th>
                            <th>Promedio Final</th>

                        </tr>

                        <!-- created a new row -->
                        <tr>
                            <!-- buffer of five columns to reach your desired column -->
                            <th></th>
                            <th></th>

                            <!-- add columns below -->

                            <th>1</th>
                            <th>2</th>
                            <th>3</th>

                            <!-- add buffer of 2 columns -->
                            <th clospan="1"></th>
                        </tr>
                    </thead>
                    <tbody id="cetrar">
                        <td rowspan="8">
                            <div class="rotate">
                                FORMACIÓN ACADEMICA
                            </div>
                        </td>
                        <tr>
                            <td>LENGUA
                                MATERNA
                                (ESPAÑOL)</td>
                            <td> <?php echo e($student->DGIQ5B70YO); ?> </td>
                            <td> <?php echo e($student->DFVH73TQKX); ?> </td>
                            <td> <?php echo e($student->{'9OFPYCD1RA'}); ?> </td>
                            <td> <?php echo e(!empty($student->{'9OFPYCD1RA'}) ? round(($student->{'9OFPYCD1RA'} + $student->DFVH73TQKX + $student->DGIQ5B70YO) / 3, 2) : '---'); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>MATEMÁTICAS</td>
                            <td> <?php echo e($student->RBVHGUZOKN); ?> </td>
                            <td> <?php echo e($student->R8V5G6LXSI); ?></td>
                            <td> <?php echo e($student->ZT8VG4OXP0); ?></td>
                            <td> <?php echo e(!empty($student->ZT8VG4OXP0) ? round(($student->ZT8VG4OXP0 + $student->R8V5G6LXSI + $student->RBVHGUZOKN) / 3, 2) : '---'); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>LENGUA EXTRANJERA (INGLÉS)</td>
                            <td> <?php echo e($student->VBFXR9LKGZ); ?> </td>
                            <td> <?php echo e($student->EJA208KHIW); ?></td>
                            <td> <?php echo e($student->ZB89KETHAQ); ?></td>
                            <td> <?php echo e(!empty($student->ZB89KETHAQ) ? round(($student->ZB89KETHAQ + $student->EJA208KHIW + $student->VBFXR9LKGZ) / 3, 2) : '---'); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>CIENCIAS (BIOLOGÍA)</td>
                            <td> <?php echo e($student->O8XNPFKZJ2); ?> </td>
                            <td> <?php echo e($student->AFLTZS57CQ); ?></td>
                            <td> <?php echo e($student->LVWUYJE1H6); ?></td>
                            <td> <?php echo e(!empty($student->LVWUYJE1H6) ? round(($student->LVWUYJE1H6 + $student->AFLTZS57CQ + $student->O8XNPFKZJ2) / 3, 2) : '---'); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>HISTORIA</td>
                            <td> -- </td>
                            <td> <?php echo e($student->J72AEBQZ3S); ?></td>
                            <td> <?php echo e($student->A0J8KU3YTZ); ?></td>
                            <td> <?php echo e(!empty($student->A0J8KU3YTZ) ? round(($student->A0J8KU3YTZ + $student->J72AEBQZ3S) / 2, 2) : '---'); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>GEOGRAFÍA</td>
                            <td> <?php echo e($student->M7ODHBWX30); ?> </td>
                            <td> -- </td>
                            <td> -- </td>
                            <td> <?php echo e($student->M7ODHBWX30); ?></td>
                        </tr>
                        <tr>
                            <td>FORMACIÓN CÍVICA Y ÉTICA</td>
                            <td> <?php echo e($student->QIXSZ9NFWV); ?> </td>
                            <td> <?php echo e($student->YH4PL7CZT6); ?></td>
                            <td> <?php echo e($student->HSEMVIT39N); ?></td>
                            <td> <?php echo e(!empty($student->HSEMVIT39N) ? round(($student->HSEMVIT39N + $student->YH4PL7CZT6 + $student->QIXSZ9NFWV) / 3, 2) : '---'); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>TECNOLOGÍA</td>
                            <td> <?php echo e($student->PSXQ0LZ1AT); ?> </td>
                            <td> <?php echo e($student->HBIQ03KYW1); ?></td>
                            <td> <?php echo e($student->D2NGLBPSHC); ?></td>
                            <td> <?php echo e(!empty($student->D2NGLBPSHC) ? round(($student->D2NGLBPSHC + $student->HBIQ03KYW1 + $student->PSXQ0LZ1AT) / 3, 2) : '---'); ?>

                            </td>
                        </tr>

                        <td rowspan="2" style="padding-top: 14px;padding-bottom: 14px;">
                            <div class="rotate">DESARROLLO PERSONAL Y SOCIAL</div>
                        </td>
                        <tr>
                            <td>EDUCACIÓN FÍSICA</td>
                            <td> <?php echo e($student->WJ4S6LH0PV); ?> </td>
                            <td> <?php echo e($student->{'9MGZI8RSXH'}); ?></td>
                            <td> <?php echo e($student->{'4ISL6YXD3M'}); ?></td>
                            <td> <?php echo e(!empty($student->{'4ISL6YXD3M'}) ? round(($student->{'4ISL6YXD3M'} + $student->{'9MGZI8RSXH'} + $student->WJ4S6LH0PV) / 3, 2) : '---'); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>ARTES</td>
                            
                            <td> <?php echo e($student->{'0XLUGHMA8F'}); ?> </td>
                            <td> </td>
                            <td> <?php echo e($student->{'7Y425ONT8K'}); ?></td>
                            <td> <?php echo e(!empty($student->{'7Y425ONT8K'}) ? round(($student->{'7Y425ONT8K'} + $student->{'0XLUGHMA8F'}) / 2, 2) : '---'); ?>

                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="firmas">
                    <div class="centrar-conten" style=" margin-top: 4rem;">
                        <span> <?php echo e($school->boss); ?> </span> <br />
                        <div class="linea-2"></div>
                        <span class="muted">NOMBRE Y FIRMA DEL DIRECTOR</span>
                    </div>
                    <div class="centrar-conten espacio-2">
                        <span>OSTUACÁN,CHIAPAS</span> <br />
                        <div class="linea-2"></div>
                        <span class="muted">LUGAR DE EXPEDICIÓN</span>

                    </div>
                </div>
            </div>
            <div style="margin-left:320pt;">
                
                <div style="width: 20rem;border: 1px solid ">
                    <div class="text-center" style="background-color: grey; color: white;"><span>TECNOLOGÍA</span></div>
                    <div style="">
                        <div class="tec-enfacis">Énfasis de campo:
                        </div>
                        <div class="tec-line"></div> <br />
                    </div>
                    <div>
                        <div class="tec-enfacis">Clave:</div>
                        <div class="tec-line-2"></div>
                    </div>
                </div>
                <table class=" setwith" id="tb-asiste">
                    <thead>
                        <tr class="centrar">
                            <th colspan="2">ASISTENCIA</th>

                        </tr>
                    </thead>
                    <tbody class="centrar">
                        <td rowspan="1">Calendario Escolar</td>
                        <tr>
                            <td>190</td>
                        </tr>
                        <td rowspan="1">Asistencias</td>
                        <tr>
                            <td>--</td>
                        </tr>
                        <td rowspan="1">Asistencia*</td>
                        <tr>
                            <td>---</td>
                        </tr>
                    </tbody>
                </table>
                <span style="font-size: 10px;">* Asistencia mínima para ser promovido: 80%</span>
                <div class="items-center">
                    <table class="centrar setwith2" id="tb-final">
                        <thead>
                            <tr>
                                <th>PROMEDIO FINAL DE GRADO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> <?php echo e($student->final); ?> </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="content">
                    <div class="relleno">
                        <div style="background-color: gray;">
                            <span style="font-size: 11px;color: white;">FIRMA DE LA MADRE, PADRE DE FAMILIA O
                                TUTOR</span>
                        </div>
                        <div>
                            <div class="someshit">
                                <span>1er periodo</span>
                            </div>
                            <div class="someshit">
                                <span>2º periodo</span>
                            </div>
                            <div class="someshit" style="border-width: 0px">
                                <span>3er periodo</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sello-container separar">
                    <div class="centrar-sello-text muted">
                        SELLO
                        SISTEMA
                        EDUCATIVO
                        NACIONAL
                    </div>
                    <div>
                        <strong style="float: left; padding-top: 3em; font-size: 12px">Folio: BE07200140099</strong>
                        <strong  style="float: right; padding-top: 3em; font-size: 12px">Matricula: 11BXP955</strong>
                    </div>
                    <div class="fecha-sello">
                        <span class="sello-fiels"> <?php echo e(date('Y')); ?> </span>
                        <span class="sello-fiels"><?php echo e(date('m')); ?></span>
                        <span class="sello-fiels"><?php echo e(date('d')); ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-break"></div>
        <?php echo $__env->make('documents.report.report-page-two', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<script>
    window.addEventListener('load', function() {
        var rotates = document.getElementsByClassName('rotate');
        for (var i = 0; i < rotates.length; i++) {
            rotates[i].style.height = rotates[i].offsetWidth + 'px';
        }
    });

</script>
<style>
    /* tabla de calificacion  */
    .tb-cal {
        border-collapse: collapse;
    }

    .tb-cal th {
        padding-top: 0px;
        padding-bottom: 0px;
        text-align: center;
        background-color: #666666;
        color: white;
    }
    }

    .tb-cal td {
        border: 1px solid #ddd;
    }

    /* color para que se visualize de manera diferente  */
    #tb-cal tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    }

    /* estilo de la tabla de la asistencia */
    #tb-asiste {
        margin-top: 8px;
        border-collapse: collapse;
    }

    #tb-asiste td,
    th {
        border: 1px solid #ddd;
    }

    #tb-asiste th {
        text-align: center;
        background-color: #666666;
        color: white;
    }

/* estilos para la calificacion final table */
#tb-final {
    border-collapse: collapse;
}
    #tb-final th {
        text-align: center;
        background-color: #666666;
        color: white;
    }
     #tb-final td,
    th {
        border: 1px solid #ddd;
    }
    /* estilos para la parte de tecnologia  */
    .tec {
        border: 1px solid #000;
        height: 7em;
        margin-bottom: 1em;
    }

    .tec-enfacis {
        padding-left: 3px;
        margin-top: 1em;
        display: inline;
    }

    .tec-line {
        margin-left: 40%;
        border-bottom: 1px solid black;
        /* width: 5vh; */
    }

    .tec-line-2 {
        margin-left: 15%;
        border-bottom: 1px solid black;
    }

    /* estilos para el apartado de sellos  */
    .sello-fiels {
        border-style: solid;
        border-width: 0px 1px 1px 1px;

    }

    .fecha-sello {
        padding-top: 5rem;
        margin: auto;
        text-align: center;
    }

    .separar {
        margin-top: 2rem;
    }

    .sello-container {
        height: 1rem;
    }

    .centrar-sello-text {
        font-size: 8px;
        margin: auto;
        text-align: center;
        width: 25%
    }

    /* estilos para el nombre del director y el lugar de expedicion */
    .espacio-2 {
        margin-top: 2rem;
    }

    .firmas {
        position: relative;
        margin-top: 2rem;
        height: 12rem;
        border: 2px solid gray;
        width: 25rem;
    }

    .centrar-conten {
        text-align: center;
        /* margin: auto;
            width: 30%; */
    }

    .linea-2 {
        margin: auto;
        width: 95%;
        border-bottom: 2px solid grey;
    }

    /* estilos para donde va la firma  */
    .someshit {
        padding-top: 12px;
        border-bottom: 1px solid black;
        height: 4rem;
    }

    .content {
        border: 1px solid black;
        height: 16rem;
    }

    .relleno {
        height: 1.5rem;
    }

    .items-center {
        margin: auto;
        width: 80%;
        padding: 10px;
    }

    .setwith2 td {
        height: 10px;
        width: 2em;
    }

    .setwith td {
        height: 10px;
        width: 155px;
    }

    .centrar td {
        text-align: center;
        vertical-align: middle;
    }

    .setPrimera td {
        height: 20px;
        width: 30px;
    }

    #cetrar td {
        text-align: center;
        vertical-align: middle;
    }

    tr:nth-of-type(0) td:nth-of-type(1) {
        visibility: hidden;
    }

    .rotate {
        /* FF3.5+ */
        -moz-transform: rotate(-90.0deg);
        /* Opera 10.5 */
        -o-transform: rotate(-90.0deg);
        /* Saf3.1+, Chrome */
        -webkit-transform: rotate(-90.0deg);
        /* IE6,IE7 */
        filter: progid: DXImageTransform.Microsoft.BasicImage(rotation=0.083);
        /* IE8 */
        -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083)";
        /* Standard */
        transform: rotate(-90.0deg);
    }

    .logo {
        height: 4rem;
    }

    .logo-chis {
        height: 5rem;
        pad
    }

    .linea {
        width: 100vh;
        margin-bottom: 3em;
        border-bottom: 1px solid black;
    }

    .relative {
        position: relative;
    }

    .absolute {
        position: absolute;
    }

    .top {
        top: 0
    }

    .mb-5 {
        margin-top: 5rem
    }

    .mt-4 {
        margin-top: 2rem
    }

    .fixVerti {
        transform: rotate(-90deg);
    }

    td {
        height: 50px;
        width: 90px;
    }

    #cetrar td {
        text-align: center;
    }

    .carta {
        border: cornflowerblue;
    }

    .line-name {
        position: relative;
        left: 0px;
        border-bottom: 3px solid black;
        width: 10em;
    }

    .linea-a {
        border-bottom: 1px solid black;
        width: 7em;
    }

    .linea-grupo {
        border-bottom: 1px solid black;
        width: 4em;
    }

</style>

<?php echo $__env->make('documents.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/yamile/Documents/Residencia/FINAL/telesis/resources/views/documents/report/report-card.blade.php ENDPATH**/ ?>