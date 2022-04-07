<!-- post card -->
<div class="flex bg-white shadow-lg rounded-lg mx-4 md:mx-auto mt-2 relative">
    <!-- ICONO  de que tipo de archivo es -->
    <div class="flex items-center bg-red-100 rounded-tr-3xl">
        <div>
            <?php if($type == 'pdf'): ?>
                <svg class="w-35 h-12 text-red-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                    </path>
                </svg>
            <?php else: ?>
                <svg width="3rem" class="w-35 h-10 py-1 text-green-900" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <title />
                    <g id="Word">
                        <g data-name="&lt;Group&gt;" id="_Group_">
                            <polygon data-name="&lt;Path&gt;" id="_Path_"
                                points="13.5 0.5 0.5 3 0.5 21 13.5 23.5 13.5 0.5"
                                style="fill:none;stroke:#9C27B0;stroke-linecap:round;stroke-linejoin:round" />
                            <polyline data-name="&lt;Path&gt;" id="_Path_2"
                                points="13.5 3.5 23.5 3.5 23.5 20.5 13.5 20.5"
                                style="fill:none;stroke:#9C27B0;stroke-linecap:round;stroke-linejoin:round" />
                            <line data-name="&lt;Path&gt;" id="_Path_3"
                                style="fill:none;stroke:#9C27B0;stroke-linecap:round;stroke-linejoin:round" x1="13.5"
                                x2="21.5" y1="6" y2="6" />
                            <line data-name="&lt;Path&gt;" id="_Path_4"
                                style="fill:none;stroke:#9C27B0;stroke-linecap:round;stroke-linejoin:round" x1="13.5"
                                x2="21.5" y1="9" y2="9" />
                            <line data-name="&lt;Path&gt;" id="_Path_5"
                                style="fill:none;stroke:#9C27B0;stroke-linecap:round;stroke-linejoin:round" x1="13.5"
                                x2="21.5" y1="12" y2="12" />
                            <line data-name="&lt;Path&gt;" id="_Path_6"
                                style="fill:none;stroke:#9C27B0;stroke-linecap:round;stroke-linejoin:round" x1="13.5"
                                x2="21.5" y1="15" y2="15" />
                            <line data-name="&lt;Path&gt;" id="_Path_7"
                                style="fill:none;stroke:#9C27B0;stroke-linecap:round;stroke-linejoin:round" x1="13.5"
                                x2="21.5" y1="18" y2="18" />
                            <polyline data-name="&lt;Path&gt;" id="_Path_8" points="3 9 4.5 15 6.5 8.5 8.5 15.5 10.5 8"
                                style="fill:none;stroke:#9C27B0;stroke-linecap:round;stroke-linejoin:round" />
                        </g>
                    </g>
                </svg>
            <?php endif; ?>
            
         <img class="w-35 h-12 text-red-900 object-cover" alt="">
        </div>
    </div>
    <div class="flex items-start px-4 py-11 sm:py-6">
        <div class="">
            <div class="flex items-center justify-between ">
                <h3 class="font-semibold mb-2 text-xl leading-tight sm:leading-normal block"> <?php echo e($titulo); ?> </h3>
            </div>
            <p class="mt-3 text-gray-700 text-sm w-full sm:w-5/6">
                <?php echo e($descripcion); ?>

            </p>
            <div class="mt-4 flex items-center">
                <div class="flex mr-2 text-gray-700 bg-blue-100 rounded-md px-2 hover:bg-blue-300 text-sm mr-3">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    
                    <a href="<?php echo e(route('notice.download', $uuid)); ?>">descargar</a>
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
                    
                    <a href="<?php echo e(route('notice.show', $uuid)); ?>" target="_blank">abrir</a>
                </div>
            </div>
        </div>
    </div>
    <div
        class="text-xs sm:text-sm font-bold p-1 sm:p-2 text-red-900 rounded-full bg-red-100 absolute right-0 mr-2 mt-2">
        <span> <?php echo e($date); ?> </span>
    </div>

</div>
<?php /**PATH C:\Users\carlos velazco\Documents\xampp\htdocs\Telesis\resources\views/livewire/notices/feed/card.blade.php ENDPATH**/ ?>