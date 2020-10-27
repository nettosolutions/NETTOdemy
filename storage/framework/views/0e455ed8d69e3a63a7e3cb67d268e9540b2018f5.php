 <?php if($errors->any()): ?>
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>

        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo e($error); ?><br/>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php elseif(session()->get('flash_success')): ?>
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>

        <?php if(is_array(json_decode(session()->get('flash_success'), true))): ?>
            <?php echo e(implode('', session()->get('flash_success')->all(':message<br/>'))); ?>

        <?php else: ?>
            <?php echo e(session()->get('flash_success')); ?>

        <?php endif; ?>
    </div>
<?php elseif(session()->get('flash_warning')): ?>
    <div class="alert alert-warning" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>

        <?php if(is_array(json_decode(session()->get('flash_warning'), true))): ?>
            <?php echo e(implode('', session()->get('flash_warning')->all(':message<br/>'))); ?>

        <?php else: ?>
            <?php echo e(session()->get('flash_warning')); ?>

        <?php endif; ?>
    </div>
<?php elseif(session()->get('flash_info')): ?>
    <div class="alert alert-info" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>

        <?php if(is_array(json_decode(session()->get('flash_info'), true))): ?>
            <?php echo e(implode('', session()->get('flash_info')->all(':message<br/>'))); ?>

        <?php else: ?>
            <?php echo e(session()->get('flash_info')); ?>

        <?php endif; ?>
    </div>
<?php elseif(session()->get('flash_danger')): ?>
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>

        <?php if(is_array(json_decode(session()->get('flash_danger'), true))): ?>
            <?php echo e(implode('', session()->get('flash_danger')->all(':message<br/>'))); ?>

        <?php else: ?>
            <?php echo e(session()->get('flash_danger')); ?>

        <?php endif; ?>
    </div>
<?php elseif(session()->get('flash_message')): ?>
    <div class="alert alert-info" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>

        <?php if(is_array(json_decode(session()->get('flash_message'), true))): ?>
            <?php echo e(implode('', session()->get('flash_message')->all(':message<br/>'))); ?>

        <?php else: ?>
            <?php echo e(session()->get('flash_message')); ?>

        <?php endif; ?>
    </div>
<?php endif; ?>
