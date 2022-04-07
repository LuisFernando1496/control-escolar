<div>
     <?php $__env->slot('header'); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Reportes')); ?>

        </h2>
     <?php $__env->endSlot(); ?>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                 <?php if (isset($component)) { $__componentOriginale23df974567224051fb852b6d449ebc8dbd8d859 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Actions\ConfirmDeletion::class, ['title' => 'Reporte','dataToDelete' => $report,'methodDelete' => 'destroy']); ?>
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
                                <?php if($reports->count() > 0): ?>
                                     <?php if (isset($component)) { $__componentOriginala2414dc1a67dbd0125085b7fd2e9e30af9f33a86 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\TableIndex::class, ['pages' => true,'headers' => ['ID','Motivo','Realizado'],'objects' => $reports,'objectProps' => [['name'=>'id'],['name'=>'reason'],['name'=>'created_at']],'actions' => [['method'=>'deleteConfirmationModal','display'=>'Eliminar','bg'=>'red','font'=>'red']]]); ?>
<?php $component->withName('table-index'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginala2414dc1a67dbd0125085b7fd2e9e30af9f33a86)): ?>
<?php $component = $__componentOriginala2414dc1a67dbd0125085b7fd2e9e30af9f33a86; ?>
<?php unset($__componentOriginala2414dc1a67dbd0125085b7fd2e9e30af9f33a86); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
                                <?php else: ?>
                                    <div class="py-10 px-10 flex text-center"><span>Sin Reportes</span></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\lenovo\Documents\xampp\htdocs\Telesis\resources\views/livewire/report/main-component.blade.php ENDPATH**/ ?>