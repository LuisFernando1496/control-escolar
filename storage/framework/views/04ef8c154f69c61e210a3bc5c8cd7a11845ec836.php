<div>
    <div class="flex flex-col shadow-md px-2 ml-2 mr-2">
        <h1 class="flex justify-center">Seleccion</h1>
        <?php if($whoIs == 'admin'): ?>
                <div class="flex flex-col mb-3" >
                     <button
                     wire:click="$toggle('isEditing')"
                        class="w-100 bg-blue-200 tracking-wide text-gray-800 font-bold rounded border-b-2 border-blue-500 hover:border-blue-600 hover:bg-blue-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center">
                    <span class="px-3"> <?php echo e($isEditing ? 'Buscar horario' :  'crear horario'); ?> </span>
            </button>
                    
            </div>
        <?php endif; ?>
        <div class="flex flex-row">
<?php if($whoIs == 'admin' || $whoIs == 'docente'): ?>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Grado
                </label>
                <select wire:model="grado" class="block mt-1 w-full block font-medium text-gray-500" required autofocus>
                    <option value="0">Seleccione el grado</option>
                    <?php $__currentLoopData = \App\Models\Grade::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($grade->id); ?>"><?php echo e($grade->number); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Grupo
                </label>
                <select wire:model="grupo" class="block mt-1 w-full block font-medium text-gray-500" required autofocus>
                    <option>Seleccione un grupo</option>
                    <?php $__currentLoopData = \App\Models\Group::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($group->id); ?>"><?php echo e($group->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
               <?php endif; ?>
        </div>

        <div>
            
                <?php if($grado != 0 && $grupo != 0 && $whoIs == 'admin' && !$isEditing): ?>
                    <select wire:model="materia" class="block mt-1 w-full block font-medium text-gray-500" required
                        autofocus>
                        <option value="">Seleccione una materia</option>
                        <?php $__currentLoopData = $materias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $materia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($materia->id); ?>"><?php echo e($materia->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                <?php endif; ?>
        </div>

    </div>
    

    <div class="flex flex-col pt-10 ">
        <?php switch($whoIs):
            case ('admin'): ?>

                    <div class="shadow-md px-2 ml-2 mr-2">
                    <h1 class="flex justify-center">Definir Docente</h1>
                    <select wire:model="maestro" class="block mt-1 w-full block font-medium text-gray-500" required autofocus>
                        <option>Docente para la clase</option>
                        <?php $__currentLoopData = $teaches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($teacher->id); ?>"><?php echo e($teacher->fullName()); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['maestro'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-700"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <?php if(!$isEditing): ?>
                    <button
                        class="bg-blue-500 hover:bg-blue-700 disabled:opacity-50 text-white font-bold py-1 px-2 rounded float-right mx-2 my-2"
                        wire:click="store" <?php echo e($isComplete ? 'disabled' : ''); ?> "> crear horario</button>
                <?php endif; ?>
                </div>      
            <?php break; ?>
            <?php case ('alumno'): ?>
                    
            <?php break; ?>
            <?php default: ?>  
        <?php endswitch; ?>
            </div>


            
            <div class="flex flex-col">
                <?php $__errorArgs = ['materia'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <?php echo e(Log::alert($materia)); ?>

                    
                    <div class=" pt-10 mx-4" >
                    <div class="text-white px-2 py-1 border-0 rounded relative mb-4 bg-red-500">
                        <span class="inline-block align-middle mr-8">
                            
                            <?php echo e($message); ?>

                        </span>
                    </div>
            </div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        
            </div>

        <div class="flex flex-col justify-items-end py-4 px-1">
            <button <?php echo e($canGenerate ? 'disabled' : ''); ?> wire:click="generatePDF"  class="btn-primary transition disabled:opacity-25  duration-300 ease-in-out focus:outline-none focus:shadow-outline bg-purple-700 hover:bg-purple-900 text-white font-normal py-2 px-4 mr-1 rounded">
             generar PDF
            </button>
            
            <?php if($whoIs === 'admin' && $isEditing): ?> 
                <button  <?php echo e($onPeriod ? '' : 'disabled'); ?> wire:click="fuckingSubscription"  class="mt-4 btn-primary transition disabled:opacity-25  duration-300 ease-in-out focus:outline-none focus:shadow-outline bg-purple-700 hover:bg-purple-900 text-white font-normal py-2 px-4 mr-1 rounded">
             Incribir alumnos 
            </button>
            <?php endif; ?>
        </div>
    </div>
<?php /**PATH C:\Users\lenovo\Documents\xampp\htdocs\Telesis\resources\views/livewire/schedule/schedule-form.blade.php ENDPATH**/ ?>