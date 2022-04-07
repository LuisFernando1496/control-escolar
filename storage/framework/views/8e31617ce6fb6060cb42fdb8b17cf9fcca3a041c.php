<?php $attributes = $attributes->exceptProps(['color', "height"]); ?>
<?php foreach (array_filter((['color', "height"]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<svg class="w-35 h-<?php echo e($height); ?> py-1 text-green-900" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
    <title />
    <g id="Word">
        <g data-name="&lt;Group&gt;" id="_Group_">
            <polygon data-name="&lt;Path&gt;" id="_Path_" points="13.5 0.5 0.5 3 0.5 21 13.5 23.5 13.5 0.5"
                style="fill:none;stroke:#<?php echo e($color); ?>;stroke-linecap:round;stroke-linejoin:round" />
            <polyline data-name="&lt;Path&gt;" id="_Path_2" points="13.5 3.5 23.5 3.5 23.5 20.5 13.5 20.5"
                style="fill:none;stroke:#<?php echo e($color); ?>;stroke-linecap:round;stroke-linejoin:round" />
            <line data-name="&lt;Path&gt;" id="_Path_3"
                style="fill:none;stroke:#<?php echo e($color); ?>;stroke-linecap:round;stroke-linejoin:round" x1="13.5" x2="21.5" y1="6"
                y2="6" />
            <line data-name="&lt;Path&gt;" id="_Path_4"
                style="fill:none;stroke:#<?php echo e($color); ?>;stroke-linecap:round;stroke-linejoin:round" x1="13.5" x2="21.5" y1="9"
                y2="9" />
            <line data-name="&lt;Path&gt;" id="_Path_5"
                style="fill:none;stroke:#<?php echo e($color); ?>;stroke-linecap:round;stroke-linejoin:round" x1="13.5" x2="21.5" y1="12"
                y2="12" />
            <line data-name="&lt;Path&gt;" id="_Path_6"
                style="fill:none;stroke:#<?php echo e($color); ?>;stroke-linecap:round;stroke-linejoin:round" x1="13.5" x2="21.5" y1="15"
                y2="15" />
            <line data-name="&lt;Path&gt;" id="_Path_7"
                style="fill:none;stroke:#<?php echo e($color); ?>;stroke-linecap:round;stroke-linejoin:round" x1="13.5" x2="21.5" y1="18"
                y2="18" />
            <polyline data-name="&lt;Path&gt;" id="_Path_8" points="3 9 4.5 15 6.5 8.5 8.5 15.5 10.5 8"
                style="fill:none;stroke:#<?php echo e($color); ?>;stroke-linecap:round;stroke-linejoin:round" />
        </g>
    </g>
</svg>
<?php /**PATH /Users/yamile/Documents/Residencia/FINAL/telesis/resources/views/components/word-svg.blade.php ENDPATH**/ ?>