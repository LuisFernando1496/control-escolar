<div class="grid sm:grid-cols-2 gap-3  bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
    
    
    
    <div class="">
        <div class="relative">
            <select wire:model="age" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label"
                class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <span class="flex items-center">
                    <span class="ml-3 block truncate">
                        Año
                    </span>
                </span>
                
                
                <option value='0'>Selecione un año</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
        </div>
    </div>
    <div class="">
        <?php echo $__env->make('livewire.asset.subject-select', [
            'modelSelector' => 'subject',
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div>
<?php /**PATH C:\Users\lenovo\Documents\xampp\htdocs\Telesis\resources\views/livewire/asset/search.blade.php ENDPATH**/ ?>