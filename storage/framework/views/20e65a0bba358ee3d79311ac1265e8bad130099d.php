
<div class="flex bg-white shadow-lg rounded-lg  relative"> 
    <!-- Uso del icono para dar a conocer que tipo de archivo es -->
    <div class="flex items-center bg-blue-100 rounded-tr-3xl">
         <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.word-svg','data' => ['color' => '0288D1','height' => '10']]); ?>
<?php $component->withName('word-svg'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['color' => '0288D1','height' => '10']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
    </div>
    <div class="flex items-start px-4 py-11 sm:py-6">
        <div class="">
            <div class="flex items-center justify-between ">
                <h3 class="font-semibold mb-2 text-xl leading-tight sm:leading-normal block"> <?php echo e($asset->title); ?> </h3>
            </div>
            <p class="mt-3 text-gray-700 text-sm w-full sm:w-5/6">
               <?php echo e($asset->description); ?>

            </p>
            <div class="mt-4 flex items-center">
                <div class="flex mr-2 text-gray-700 bg-blue-100 rounded-md px-2 hover:bg-blue-300 text-sm mr-3">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    
                    <a href="<?php echo e(route('asset.download', $asset->path)); ?>">descargar</a>
                </div>
                <div class="flex mr-2 text-gray-700 text-sm mr-4 bg-blue-100 rounded-md px-2 hover:bg-blue-300">
                    <svg class="w-4 h-4 mr-1" style="margin-top: 1px;" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z">
                        </path>
                        <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z">
                        </path>
                    </svg>
                    
                    <a href="<?php echo e(route('asset.show', $asset->path)); ?>" target="_blank">abrir</a>
                </div>
            </div>
        </div>
    </div>
    <div
        class="text-xs sm:text-sm font-bold p-1 sm:p-2 text-red-900 rounded-full bg-red-100 absolute right-0 mr-2 mt-2">
        <span> <?php echo e(date('Y/m/d', strtotime($asset->created_at))); ?> </span>
    </div>
</div>
<?php /**PATH /Users/yamile/Documents/Residencia/FINAL/telesis/resources/views/livewire/asset/student/card-asset.blade.php ENDPATH**/ ?>