<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownLanguageLink">
    
        
            
        
    
    <?php $__currentLoopData = $locales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($lang != app()->getLocale()): ?>
            <small><a href="<?php echo e('/lang/'.$lang); ?>" class="dropdown-item"><?php echo e((trans('menus.language-picker.langs.'.$lang)) ? trans('menus.language-picker.langs.'.$lang) : $lang); ?></a></small>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
