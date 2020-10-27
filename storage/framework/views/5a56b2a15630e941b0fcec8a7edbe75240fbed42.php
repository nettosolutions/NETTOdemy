<div class="table-responsive">
    <table class="table table-striped table-hover table-bordered">
        <tr>
            <th><?php echo app('translator')->getFromJson('labels.frontend.user.profile.avatar'); ?></th>
            <td><img src="<?php echo e($logged_in_user->picture); ?>" height="100px" class="user-profile-image" /></td>
        </tr>
        <tr>
            <th><?php echo app('translator')->getFromJson('labels.frontend.user.profile.name'); ?></th>
            <td><?php echo e($logged_in_user->name); ?></td>
        </tr>
        <tr>
            <th><?php echo app('translator')->getFromJson('labels.frontend.user.profile.email'); ?></th>
            <td><?php echo e($logged_in_user->email); ?></td>
        </tr>
        <tr>
            <th><?php echo app('translator')->getFromJson('labels.frontend.user.profile.created_at'); ?></th>
            <td><?php echo e(timezone()->convertToLocal($logged_in_user->created_at)); ?> (<?php echo e($logged_in_user->created_at->diffForHumans()); ?>)</td>
        </tr>
        <tr>
            <th><?php echo app('translator')->getFromJson('labels.frontend.user.profile.last_updated'); ?></th>
            <td><?php echo e(timezone()->convertToLocal($logged_in_user->updated_at)); ?> (<?php echo e($logged_in_user->updated_at->diffForHumans()); ?>)</td>
        </tr>
        <?php if(config('registration_fields') != NULL): ?>
            <?php
                $fields = json_decode(config('registration_fields'));
            ?>
            <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th><?php echo e(__('labels.backend.general_settings.user_registration_settings.fields.'.$item->name)); ?></th>
                    <td><?php echo e($logged_in_user[$item->name]); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </table>
</div>
