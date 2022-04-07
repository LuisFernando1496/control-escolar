 
<div class="
    fixed  top-0 right-0 
    px-10
    mt-6 mx-6 py-4 sm:py-5 rounded-lg pointer-events-auto 
    z-10
    <?php echo e($alertTypeClasses[$alertType]); ?>" role="alert" x-data=" { show : false}"
    @toast-message-show.window="show = true; setTimeout(() => show = false, 5000);" x-show="show" x-cloak>
    <p class="font-bold"><?php echo e($title); ?></p>
    <?php echo e($message); ?>

</div>
<?php /**PATH /Users/yamile/Documents/Residencia/FINAL/telesis/resources/views/livewire/shared/toast.blade.php ENDPATH**/ ?>