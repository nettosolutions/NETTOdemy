<?php $__env->startSection('title', app_name() . ' | '. __('labels.backend.access.roles.management')); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    <?php echo app('translator')->getFromJson('labels.backend.access.roles.management'); ?>
                </h4>
            </div><!--col-->

            <div class="col-sm-7 pull-right">
                <?php echo $__env->make('backend.auth.role.includes.header-buttons', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('labels.backend.access.roles.table.role'); ?></th>
                            <th><?php echo app('translator')->getFromJson('labels.backend.access.roles.table.permissions'); ?></th>
                            <th><?php echo app('translator')->getFromJson('labels.backend.access.roles.table.number_of_users'); ?></th>
                            <th><?php echo app('translator')->getFromJson('labels.general.actions'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(ucwords($role->name)); ?></td>
                                <td>
                                    <?php if($role->id == 1): ?>
                                        <?php echo app('translator')->getFromJson('labels.general.all'); ?>
                                    <?php else: ?>
                                        <?php if($role->permissions->count()): ?>
                                            <?php $__currentLoopData = $role->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php echo e(ucwords($permission->name)); ?>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <?php echo app('translator')->getFromJson('labels.general.none'); ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($role->users->count()); ?></td>
                                <td><?php echo $role->action_buttons; ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    <?php echo $roles->total(); ?> <?php echo e(trans_choice('labels.backend.access.roles.table.total', $roles->total())); ?>

                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    <?php echo $roles->render(); ?>

                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>