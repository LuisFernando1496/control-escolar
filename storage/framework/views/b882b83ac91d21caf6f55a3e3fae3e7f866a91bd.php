<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?></title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="<?php echo e(mix('css/app.css')); ?>">

        <?php echo \Livewire\Livewire::styles(); ?>


        <!-- Scripts -->
        <script src="<?php echo e(mix('js/app.js')); ?>" defer></script>
    </head>
    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('shared.toast-notification', [])->html();
} elseif ($_instance->childHasBeenRendered('k7i7RKT')) {
    $componentId = $_instance->getRenderedChildComponentId('k7i7RKT');
    $componentTag = $_instance->getRenderedChildComponentTagName('k7i7RKT');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('k7i7RKT');
} else {
    $response = \Livewire\Livewire::mount('shared.toast-notification', []);
    $html = $response->html();
    $_instance->logRenderedChild('k7i7RKT', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('navigation-dropdown')->html();
} elseif ($_instance->childHasBeenRendered('pvI4H61')) {
    $componentId = $_instance->getRenderedChildComponentId('pvI4H61');
    $componentTag = $_instance->getRenderedChildComponentTagName('pvI4H61');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('pvI4H61');
} else {
    $response = \Livewire\Livewire::mount('navigation-dropdown');
    $html = $response->html();
    $_instance->logRenderedChild('pvI4H61', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <?php echo e($header); ?>

                </div>
            </header>

            <!-- Page Content -->
            <main>
                <?php echo e($slot); ?>

            </main>
        </div>
        <?php echo $__env->yieldPushContent('modals'); ?>

        <?php echo \Livewire\Livewire::scripts(); ?>

    </body>
</html>
<?php /**PATH C:\Users\carlos velazco\Documents\xampp\htdocs\Telesis\resources\views/layouts/app.blade.php ENDPATH**/ ?>