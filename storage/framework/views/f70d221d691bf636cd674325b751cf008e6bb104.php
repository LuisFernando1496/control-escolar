 <?php if (isset($component)) { $__componentOriginale23df974567224051fb852b6d449ebc8dbd8d859 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Actions\ConfirmDeletion::class, ['title' => 'Instrumentacion','dataToDelete' => $toDelete,'methodDelete' => 'destroy']); ?>
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
<table class="w-full flex flex-row flex-no-wrap sm:bg-white   my-5">
    <thead class="text-white">


        <tr class="bg-purple-400 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
            <th class="p-3 text-left">Titulo</th>
            <th class="p-3 text-left">Descripcion</th>
            <th class="p-3 text-left">Docente</th>
            <th class="p-3 text-left">Materia</th>
            <th class="p-5 text-left">Acciones</th>
        </tr>
    </thead>

    <tbody class="flex-1 sm:flex-none">
        <?php $__currentLoopData = $assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">
                <td class="border-grey-light border hover:bg-gray-100 p-3">
                    <?php echo e($asset->title); ?>

                </td>
                <td class="border-grey-light border hover:bg-gray-100 p-3">
                    <?php echo e($asset->description); ?>

                </td>
                <td class="border-grey-light border hover:bg-gray-100 p-3">
                    <?php echo e($asset->teacher['name']); ?>

                </td>
                <td class="border-grey-light border hover:bg-gray-100 p-3">
                    <?php echo e($asset->subject['name']); ?>

                </td>
                <td class="border-grey-light border p-3">
                    <div class="flex  justify-start  m-2 ">
                        <button wire:click="showEdit(<?php echo e($asset->id); ?>)"
                            class="text-blue-900 bg-blue-100 hover:bg-blue-300 px-2 rounded-lg ">editar</button>
                        <button wire:click="deleteConfirmationModal(<?php echo e($asset->id); ?>)"
                            class="text-red-900 bg-red-100 hover:bg-red-300 px-2 rounded-lg ml-1">eliminar</button>
                        <a href="<?php echo e(route('asset.show', $asset->path )); ?>" target="_blank">
                            <button
                            class="block text-blue-900 bg-blue-100 hover:bg-blue-300 px-2 rounded-lg ml-1">ver</button>
                        </a>
                    </div>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>

</table>

<style>
    @media (min-width: 640px) {
        table {
            display: inline-table !important;
        }

        thead tr:not(:first-child) {
            display: none;
        }
    }

    td:not(:last-child) {
        border-bottom: 0;
    }

    th:not(:last-child) {
        border-bottom: 2px solid rgba(0, 0, 0, .1);
    }

</style>
<?php /**PATH /Users/yamile/Documents/Residencia/FINAL/telesis/resources/views/livewire/asset/table.blade.php ENDPATH**/ ?>