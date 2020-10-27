<?php if(count($section_data['section_content']) > 0): ?>
<div class="footer-menu ml-0 col-md-4">
    <h2 class="widget-title"><?php echo e($section_data['section_title']); ?></h2>
    <ul class="list-inline">
        <?php $__currentLoopData = $section_data['section_content']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><a href="<?php echo e($item['link']); ?>"><i class="fas fa-caret-right"></i><?php echo e($item['label']); ?></a></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php endif; ?>