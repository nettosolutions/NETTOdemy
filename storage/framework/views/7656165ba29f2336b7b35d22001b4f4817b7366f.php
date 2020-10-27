<?php $__env->startSection('title', __('labels.backend.access.users.management') . ' | ' . __('labels.backend.access.users.view')); ?>

<?php $__env->startSection('breadcrumb-links'); ?>
    <?php echo $__env->make('backend.auth.user.includes.breadcrumb-links', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    <?php echo app('translator')->getFromJson('labels.backend.access.users.management'); ?>
                    <small class="text-muted"><?php echo app('translator')->getFromJson('labels.backend.access.users.view'); ?></small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
            <div class="col">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-expanded="true"><i class="fas fa-user"></i> <?php echo app('translator')->getFromJson('labels.backend.access.users.tabs.titles.overview'); ?></a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="overview" role="tabpanel" aria-expanded="true">
                        <?php echo $__env->make('backend.auth.user.show.tabs.overview', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div><!--tab-->
                </div><!--tab-content-->
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-right text-muted">
                    <strong><?php echo app('translator')->getFromJson('labels.backend.access.users.tabs.content.overview.created_at'); ?>:</strong> <?php echo e(timezone()->convertToLocal($user->created_at)); ?> (<?php echo e($user->created_at->diffForHumans()); ?>),
                    <strong><?php echo app('translator')->getFromJson('labels.backend.access.users.tabs.content.overview.last_updated'); ?>:</strong> <?php echo e(timezone()->convertToLocal($user->updated_at)); ?> (<?php echo e($user->updated_at->diffForHumans()); ?>)
                    <?php if($user->trashed()): ?>
                        <strong><?php echo app('translator')->getFromJson('labels.backend.access.users.tabs.content.overview.deleted_at'); ?>:</strong> <?php echo e(timezone()->convertToLocal($user->deleted_at)); ?> (<?php echo e($user->deleted_at->diffForHumans()); ?>)
                    <?php endif; ?>
                </small>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-footer-->
</div><!--card-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>