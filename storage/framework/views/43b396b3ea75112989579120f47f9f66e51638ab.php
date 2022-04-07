 <?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header'); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Dashboard')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mx-auto text-center">
                <img class="mx-auto py-10" src="<?php echo e(asset('images/landing.png')); ?>" alt="welcome" width="500px">
                <div class="bg-indigo-500 text-indigo-200 w-full hover:text-white py-2">
                    Hola, ¡ Que bueno verte de nuevo <?php echo e(auth()->user()->name); ?> !
                </div>
                <br>
                <div class="inline-flex my-1">
                    <img class="mx-auto my-1" src="<?php echo e(asset('images/logo.png')); ?>" alt="welcome" width="50px">
                    <span class="px-10 my-4 text-lg">
                        Telesis
                    </span>
                </div>
            </div>
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('notices.feed', [])->html();
} elseif ($_instance->childHasBeenRendered('zEEvnTT')) {
    $componentId = $_instance->getRenderedChildComponentId('zEEvnTT');
    $componentTag = $_instance->getRenderedChildComponentTagName('zEEvnTT');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('zEEvnTT');
} else {
    $response = \Livewire\Livewire::mount('notices.feed', []);
    $html = $response->html();
    $_instance->logRenderedChild('zEEvnTT', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        </div>
    </div>
 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
<?php /**PATH /Users/yamile/Documents/Residencia/FINAL/telesis/resources/views/dashboard.blade.php ENDPATH**/ ?>