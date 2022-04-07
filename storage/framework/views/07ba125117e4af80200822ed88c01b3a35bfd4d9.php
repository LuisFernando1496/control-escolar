<div>
    <?php if(isset($searchBar)): ?>
        <div class="flex bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            <input wire:model="search" class="form-input rounded-md shadow-sm mt-1 block w-full" type="text" placeholder="Buscador">
            <?php if (! ($searchBar == '')): ?>
                <button wire:click="clear()" class="form-input rounded-md shadow-sm mt-1 ml-6 block btn text-red-500">
                    X
                </button>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <table class="min-w-full divide-y divide-gray-200 flex flex-row flex-no-wrap">
        <thead>
            <tr class="flex flex-col flex-no wrap sm:table-row">
                <?php if($headers): ?>
                    <?php $__currentLoopData = $headers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $header): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <?php echo e($header); ?>

                        </th>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if(count($actions)>0): ?>
                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Acciones
                        </th>
                    <?php endif; ?>
                <?php else: ?>
                    <?php echo e($thead); ?>

                <?php endif; ?>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php if($objectProps): ?>
                <?php $__currentLoopData = $objects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $object): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="flex flex-col flex-no wrap sm:table-row">
                        <?php $__currentLoopData = $objectProps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td class="px-6 py-4 whitespace-nowrap text-<?php echo e(isset($prop['color'])?$prop['color']:'gray'); ?>-<?php echo e(isset($prop['w'])?$prop['w']:'500'); ?>">
                                <span class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full">
                                    <?php echo e($object[$prop['name']]); ?>

                                </span>
                            </td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if(count($actions)>0): ?>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(isset($action['method'])): ?>
                                        <a href="#">
                                            <button wire:click="<?php echo e($action['method'].'('.$object->id.')'); ?>" class="shadow my-1 text-<?php echo e(isset($action['font'])?$action['font']:'purple'); ?>-600 hover:text-<?php echo e(isset($action['font'])?$action['font']:'purple'); ?>-900 bg-<?php echo e(isset($action['bg'])?$action['bg']:'purple'); ?>-100 rounded-lg py-1 px-3">
                                                <?php echo e($action['display']); ?>

                                            </button>
                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo e(route($action['route'],$object)); ?>"  <?php echo e($target ? 'target="_bank"' : ''); ?> class="shadow my-1 text-<?php echo e(isset($action['font'])?$action['font']:'purple'); ?>-600 hover:text-<?php echo e(isset($action['font'])?$action['font']:'purple'); ?>-900 bg-<?php echo e(isset($action['bg'])?$action['bg']:'purple'); ?>-100 rounded-lg py-1 px-3"><?php echo e($action['display']); ?></a>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <?php echo e($slot); ?>

            <?php endif; ?>
        </tbody>
    </table>
    <?php if($pages): ?>
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            <?php echo e($objects->links()); ?>

        </div>
    <?php endif; ?>
    <style>
        @media (min-width: 640px) {
            table {
            display: inline-table !important;
            }
        }
        @media (max-width: 640px) {
            thead tr {
                display: none !important;
            }
        }
    </style>
</div>

<?php /**PATH /Users/yamile/Documents/Residencia/FINAL/telesis/resources/views/components/table-index.blade.php ENDPATH**/ ?>