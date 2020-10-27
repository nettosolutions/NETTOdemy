<?php $__env->startSection('title',  __('labels.backend.backup.title').' | '.app_name()); ?>

<?php $__env->startPush('after-styles'); ?>
    <style>
        .form-group label {
            margin-bottom: 0px;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo e(html()->form('POST', route('admin.backup.store'))->id('general-settings-form')->class('form-horizontal')->acceptsFiles()->open()); ?>


    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="page-title d-inline"><?php echo app('translator')->getFromJson('labels.backend.backup.title'); ?></h3>
                </div><!--card-header-->
                <div class="card-body">

                    <!---General Tab--->
                    <div class="col">
                        <div class="form-group row">
                            <h4 class="text-center text-danger"><?php echo app('translator')->getFromJson('labels.backend.backup.backup_notice'); ?></h4>
                            <?php echo e(html()->label(__('labels.backend.backup.title'))->class('col-md-2 form-control-label')); ?>

                            <div class="col-md-10">
                                <p class="d-inline float-left">
                                    <?php echo e(html()->label(html()
                                    ->checkbox('backup__status', config('backup.status') ? true : false,1)
                                          ->class('switch-input status')->value(1)
                                              . '<span class="switch-label"></span><span class="switch-handle"></span>')
                                          ->class('switch switch-sm switch-3d switch-primary')); ?>

                                    <span class="ml-2"><?php echo e(__('labels.backend.backup.enable_disable')); ?></span>
                                </p>
                            </div>
                        </div>
                        <div class="backup-configs d-none">
                            <div class="form-group row">
                                <?php echo e(html()->label(__('labels.backend.backup.email'))->class('col-md-2 form-control-label')->for('app_name')); ?>

                                <div class="col-md-10">
                                    <?php echo e(html()->text('backup__notifications__mail__to')
                                        ->class('form-control')
                                        ->placeholder(__('labels.backend.backup.email'))
                                        ->value(config('backup.notifications.mail.to'))
                                        ->autofocus()); ?>

                                </div><!--col-->
                            </div><!--form-group-->
                            <div class="form-group row">
                                <?php echo e(html()->label(__('labels.backend.backup.backup_type'))->class('col-md-2 form-control-label')); ?>

                                <div class="col-md-10">
                                    <p class="">
                                        <span class="font-weight-bold"><?php echo e(__('labels.backend.backup.dropbox')); ?></span>
                                        <span class="text-muted float-right"><?php echo app('translator')->getFromJson('labels.backend.backup.dropbox_note'); ?></span>
                                    </p>
                                </div>
                            </div>
                            <div class="mail-provider-wrapper dropbox  ">
                                <div class="form-group row">
                                    <?php echo e(html()->label(__('labels.backend.backup.app_token'))->class('col-md-2 form-control-label')->for('api.key')); ?>


                                    <div class="col-md-10">
                                        <?php echo e(html()->text('filesystems__disks__dropbox__token')
                                            ->id('filesystems__disks__dropbox__token')
                                            ->value(config('filesystems.disks.dropbox.token'))
                                            ->class('form-control')
                                            ->placeholder('Ex. d814b5e4xxxxxxxxxxxxxxxxxcc27c-us17 ')); ?>

                                        <p class="help-text sendgrid-error mb-0 text-danger"></p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <?php echo e(html()->label(__('labels.backend.backup.app_secret'))->class('col-md-2 form-control-label')->for('api.key')); ?>


                                    <div class="col-md-10">
                                        <?php echo e(html()->text('filesystems__disks__dropbox__app_secret')
                                            ->id('filesystems__disks__dropbox__app_secret')
                                            ->value(config('filesystems.disks.dropbox.app_secret'))
                                            ->class('form-control')
                                            ->placeholder('Ex. d814b5e4xxxxxxxxxxxxxxxxxcc27c-us17 ')); ?>

                                        <p class="help-text sendgrid-error mb-0 text-danger"></p>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label"><?php echo e(__('labels.backend.backup.backup_files')); ?></label>
                                <div class="col-md-10 col-form-label">
                                    <p class="d-block">
                                        <?php echo e(html()->label(html()
                                        ->radio('backup__content')->checked('true')
                                              ->class('switch-input status')->value('db')
                                                  . '<span class="switch-label"></span><span class="switch-handle"></span>')
                                              ->class('switch switch-sm switch-3d switch-primary')); ?>

                                        <span class="ml-2"><?php echo e(__('labels.backend.backup.db')); ?></span>
                                    </p>

                                    <p class="d-block">
                                        <?php echo e(html()->label(html()
                                        ->radio('backup__content')
                                              ->class('switch-input status')->value('db_storage')
                                                  . '<span class="switch-label"></span><span class="switch-handle"></span>')
                                              ->class('switch switch-sm switch-3d switch-primary')); ?>

                                        <span class="ml-2"><?php echo e(__('labels.backend.backup.db_storage')); ?></span>
                                    </p>

                                    <p class="d-block">
                                        <?php echo e(html()->label(html()
                                        ->radio('backup__content')
                                              ->class('switch-input status')->value('all')
                                                  . '<span class="switch-label"></span><span class="switch-handle"></span>')
                                              ->class('switch switch-sm switch-3d switch-primary')); ?>

                                        <span class="ml-2"><?php echo e(__('labels.backend.backup.db_app')); ?></span>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label"><?php echo e(__('labels.backend.backup.backup_schedule')); ?></label>
                                <div class="col-md-10 col-form-label">
                                    <?php echo e(html()->select('backup_schedule',['1' => __('labels.backend.backup.daily'),'2' => __('labels.backend.backup.weekly'),'3' => __('labels.backend.backup.monthly')])
                         ->id('backup_schedule')
                         ->class('form-control ')); ?>

                                    <span><?php echo app('translator')->getFromJson('labels.backend.backup.backup_note'); ?></span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-footer clearfix">
                    <div class="row">
                        <div class="col">
                            <?php echo e(form_cancel(route('admin.general-settings'), __('buttons.general.cancel'))); ?>

                        </div><!--col-->
                        <div class="col text-right">
                            <?php echo e(form_submit(__('buttons.general.crud.update'))->id('submit')); ?>

                        </div><!--col-->
                    </div><!--row-->
                </div><!--card-footer-->

            </div>

        </div>
    </div>
    <?php echo e(html()->form()->close()); ?>




<?php $__env->stopSection(); ?>


<?php $__env->startPush('after-scripts'); ?>
    <script>

         <?php if(config('backup.content') != ""): ?>
        var backup_content = "<?php echo e(config('backup.content')); ?>";
        $('input[type="radio"][value="' + backup_content + '"]').attr('checked', true);
         <?php endif; ?>

         <?php if(config('backup_schedule') != ""): ?>
        var schedule = "<?php echo e(config('backup_schedule')); ?>";
        $('#backup_schedule option[value="' + schedule + '"]').attr('selected', true);
        <?php endif; ?>


        <?php if(config('backup.status') == 1): ?>
        $('.backup-configs').removeClass('d-none')
        <?php endif; ?>
        $(document).on('change', '#backup__status', function () {
            $('.backup-configs').toggleClass('d-none')
        })

    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>