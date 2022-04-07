<div>
     <?php $__env->slot('header'); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Cartas de Conducta')); ?>

        </h2>
     <?php $__env->endSlot(); ?>
    <?php if($record): ?>
    
         <?php if (isset($component)) { $__componentOriginale23df974567224051fb852b6d449ebc8dbd8d859 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Actions\ConfirmDeletion::class, ['title' => 'Carta de Conducta','dataToDelete' => 'El registro de '.$record->student->user->fullname(),'methodDelete' => 'destroy']); ?>
<?php $component->withName('confirm-deletion'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginale23df974567224051fb852b6d449ebc8dbd8d859)): ?>
<?php $component = $__componentOriginale23df974567224051fb852b6d449ebc8dbd8d859; ?>
<?php unset($__componentOriginale23df974567224051fb852b6d449ebc8dbd8d859); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
    
    
        <?php echo $__env->make('livewire.history.edit-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 my-5">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                             <?php if (isset($component)) { $__componentOriginala2414dc1a67dbd0125085b7fd2e9e30af9f33a86 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\TableIndex::class, ['searchBar' => $isStudent ? null : $search ,'pages' => $pages,'objects' => $records,'objectProps' => $props,'headers' => $headers,'actions' => $actions]); ?>
<?php $component->withName('table-index'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                                <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="flex flex-col flex-no wrap sm:table-row">
                                    <td class="px-6 py-4 whitespace-nowrap text-<?php echo e(isset($prop['color'])?$prop['color']:'gray'); ?>-<?php echo e(isset($prop['w'])?$prop['w']:'500'); ?>">
                                        <span class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full">
                                            <?php echo e($record->student->user->fullname()); ?> - <?php echo e($record->student->user->key); ?>

                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-<?php echo e(isset($prop['color'])?$prop['color']:'gray'); ?>-<?php echo e(isset($prop['w'])?$prop['w']:'500'); ?>">
                                        <span class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full">
                                            <?php echo e($record->grade->description); ?>

                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-<?php echo e(isset($prop['color'])?$prop['color']:'gray'); ?>-<?php echo e(isset($prop['w'])?$prop['w']:'500'); ?>">
                                        <span class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full">
                                            <?php echo e($record->group->name); ?>

                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-<?php echo e(isset($prop['color'])?$prop['color']:'gray'); ?>-<?php echo e(isset($prop['w'])?$prop['w']:'500'); ?>">
                                        <span class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full">
                                            <?php echo e($record->score==-1 ? 'No Capturado': $record->score); ?>

                                        </span>
                                    </td>
                                    <?php if(count($actions)>0): ?>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(isset($action['method'])): ?>
                                                    <a href="#">
                                                        <button wire:click="<?php echo e($action['method'].'('.$record->id.')'); ?>" class="shadow my-1 text-<?php echo e(isset($action['font'])?$action['font']:'purple'); ?>-600 hover:text-<?php echo e(isset($action['font'])?$action['font']:'purple'); ?>-900 bg-<?php echo e(isset($action['bg'])?$action['bg']:'purple'); ?>-100 rounded-lg py-1 px-3">
                                                            <?php echo e($action['display']); ?>

                                                        </button>
                                                    </a>
                                                <?php else: ?>
                                                    <a href="<?php echo e(route($action['route'],$record)); ?>"  <?php echo e($target ? 'target="_bank"' : ''); ?> class="shadow my-1 text-<?php echo e(isset($action['font'])?$action['font']:'purple'); ?>-600 hover:text-<?php echo e(isset($action['font'])?$action['font']:'purple'); ?>-900 bg-<?php echo e(isset($action['bg'])?$action['bg']:'purple'); ?>-100 rounded-lg py-1 px-3"><?php echo e($action['display']); ?></a>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </td>
                                    <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             <?php if (isset($__componentOriginala2414dc1a67dbd0125085b7fd2e9e30af9f33a86)): ?>
<?php $component = $__componentOriginala2414dc1a67dbd0125085b7fd2e9e30af9f33a86; ?>
<?php unset($__componentOriginala2414dc1a67dbd0125085b7fd2e9e30af9f33a86); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\carlos velazco\Documents\xampp\htdocs\Telesis\resources\views/livewire/history/main-component.blade.php ENDPATH**/ ?>