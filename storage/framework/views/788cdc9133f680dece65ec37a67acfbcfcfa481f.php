<?php $__env->startSection('title', __('labels.backend.teachers.title').' | '.app_name()); ?>

<?php $__env->startSection('content'); ?>
    <?php echo e(html()->modelForm($teacher, 'PATCH', route('admin.teachers.update', $teacher->id))->class('form-horizontal')->acceptsFiles()->open()); ?>


    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline"><?php echo app('translator')->getFromJson('labels.backend.teachers.edit'); ?></h3>
            <div class="float-right">
                <a href="<?php echo e(route('admin.teachers.index')); ?>"
                   class="btn btn-success"><?php echo app('translator')->getFromJson('labels.backend.teachers.view'); ?></a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group row">
                        <?php echo e(html()->label(__('labels.backend.teachers.fields.first_name'))->class('col-md-2 form-control-label')->for('first_name')); ?>


                        <div class="col-md-10">
                            <?php echo e(html()->text('first_name')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.teachers.fields.first_name'))
                                ->attribute('maxlength', 191)
                                ->required()
                                ->autofocus()); ?>

                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <?php echo e(html()->label(__('labels.backend.teachers.fields.last_name'))->class('col-md-2 form-control-label')->for('last_name')); ?>


                        <div class="col-md-10">
                            <?php echo e(html()->text('last_name')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.teachers.fields.last_name'))
                                ->attribute('maxlength', 191)
                                ->required()); ?>

                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <?php echo e(html()->label(__('labels.backend.teachers.fields.email'))->class('col-md-2 form-control-label')->for('email')); ?>


                        <div class="col-md-10">
                            <?php echo e(html()->email('email')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.teachers.fields.email'))
                                ->attributes(['maxlength'=> 191,'readonly'=>true])
                                ->required()); ?>

                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <?php echo e(html()->label(__('labels.backend.teachers.fields.password'))->class('col-md-2 form-control-label')->for('password')); ?>


                        <div class="col-md-10">
                            <?php echo e(html()->password('password')
                                ->class('form-control')
                                ->value('')
                                ->placeholder(__('labels.backend.teachers.fields.password'))); ?>

                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <?php echo e(html()->label(__('labels.backend.teachers.fields.image'))->class('col-md-2 form-control-label')->for('image')); ?>


                        <div class="col-md-10">
                            <?php echo Form::file('image', ['class' => 'form-control d-inline-block', 'placeholder' => '']); ?>

                        </div><!--col-->
                    </div>

                    <div class="form-group row justify-content-center">
                        <div class="col-4">
                            <?php echo e(form_cancel(route('admin.teachers.index'), __('buttons.general.cancel'))); ?>

                            <?php echo e(form_submit(__('buttons.general.crud.update'))); ?>

                        </div>
                    </div><!--col-->
                </div>
            </div>
        </div>

    </div>
    <?php echo e(html()->closeModelForm()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>