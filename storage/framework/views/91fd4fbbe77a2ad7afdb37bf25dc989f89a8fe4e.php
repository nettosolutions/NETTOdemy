<?php $__env->startSection('title',  __('labels.backend.update.title').' | '.app_name()); ?>

<?php $__env->startPush('after-styles'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="page-title d-inline"><?php echo app('translator')->getFromJson('labels.backend.update.title'); ?></h3>
                    <h3 class="float-right text-primary"><?php echo app('translator')->getFromJson('labels.backend.update.current_version'); ?> <?php echo e(config('app.version')); ?></h3>

                </div><!--card-header-->
                <div class="card-body">

                        <form method="post" action="<?php echo e(route('admin.list-files')); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <h2><?php echo app('translator')->getFromJson('labels.backend.update.note_before_upload_title'); ?></h2>
                            <?php echo app('translator')->getFromJson('labels.backend.update.note_before_upload'); ?>
                            <h5 class="text-danger"><?php echo app('translator')->getFromJson('labels.backend.update.warning'); ?></h5>

                            <div class="row">
                                <div class="form-group col-md-6 col-12">
                                    <label class="font-weight-bold  "><?php echo app('translator')->getFromJson('labels.backend.update.upload'); ?></label>
                                    <input type="file" id="file" accept="application/zip" class="form-control" name="file">
                                </div>
                                <div class="form-group col-md-6 col-12 d-flex">
                                    <button class="btn btn-primary mt-auto" type="submit"><?php echo app('translator')->getFromJson('labels.general.buttons.update'); ?></button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('after-scripts'); ?>
    <script>
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>