<div>
    <?php $__currentLoopData = $notices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php echo $__env->make('livewire.notices.feed.card', 
    [
        "titulo" => $notice->title,
        "descripcion" => $notice->body,
        "date" => date('Y/m/d', strtotime($notice->created_at)),
        "uuid" => $notice->uuid,
        "type" => $notice->type
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>    
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH C:\Users\carlos velazco\Documents\xampp\htdocs\Telesis\resources\views/livewire/notices/feed/index.blade.php ENDPATH**/ ?>