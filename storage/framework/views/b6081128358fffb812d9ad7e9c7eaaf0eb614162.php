<?php $__env->startSection('title', __('labels.backend.bundles.title').' | '.app_name()); ?>

<?php $__env->startSection('content'); ?>

    <?php echo Form::model($bundle, ['method' => 'PUT', 'route' => ['admin.bundles.update', $bundle->id], 'files' => true,]); ?>


    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0"><?php echo app('translator')->getFromJson('labels.backend.bundles.edit'); ?></h3>
            <div class="float-right">
                <a href="<?php echo e(route('admin.bundles.index')); ?>"
                   class="btn btn-success"><?php echo app('translator')->getFromJson('labels.backend.bundles.view'); ?></a>
            </div>
        </div>

        <div class="card-body">

            <div class="row">
                <div class="col-10 form-group">
                    <?php echo Form::label('courses',trans('labels.backend.bundles.fields.courses'), ['class' => 'control-label']); ?>

                    <?php echo Form::select('courses[]', $courses, old('teachers') ? old('teachers') : $bundle->courses->pluck('id')->toArray(), ['class' => 'form-control select2 js-example-placeholder-multiple', 'multiple' => 'multiple']); ?>

                </div>
                <div class="col-2 d-flex form-group flex-column">
                    OR <a target="_blank" class="btn btn-primary mt-auto"
                          href="<?php echo e(route('admin.courses.create')); ?>"><?php echo e(trans('labels.backend.bundles.add_courses')); ?></a>
                </div>
            </div>


            <div class="row">
                <div class="col-10 form-group">
                    <?php echo Form::label('category_id',trans('labels.backend.bundles.fields.category'), ['class' => 'control-label']); ?>

                    <?php echo Form::select('category_id', $categories, old('category_id'), ['class' => 'form-control select2 js-example-placeholder-single', 'multiple' => false]); ?>

                </div>
                <div class="col-2 d-flex form-group flex-column">
                    OR <a target="_blank" class="btn btn-primary mt-auto"
                          href="<?php echo e(route('admin.categories.index').'?create'); ?>"><?php echo e(trans('labels.backend.bundles.add_categories')); ?></a>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6 form-group">
                    <?php echo Form::label('title', trans('labels.backend.bundles.fields.title').' *', ['class' => 'control-label']); ?>

                    <?php echo Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']); ?>

                </div>
                <div class="col-12 col-lg-6 form-group">
                    <?php echo Form::label('slug', trans('labels.backend.bundles.fields.slug'), ['class' => 'control-label']); ?>

                    <?php echo Form::text('slug', old('slug'), ['class' => 'form-control', 'placeholder' =>  trans('labels.backend.bundles.slug_placeholder')]); ?>

                </div>

            </div>

            <div class="row">
                <div class="col-12 form-group">
                    <?php echo Form::label('description',trans('labels.backend.bundles.fields.description'), ['class' => 'control-label']); ?>

                    <?php echo Form::textarea('description', old('description'), ['class' => 'form-control ', 'placeholder' => trans('labels.backend.bundles.fields.description')]); ?>

                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-4 form-group">
                    <?php echo Form::label('price', trans('labels.backend.bundles.fields.price').' (in '.$appCurrency["symbol"].')', ['class' => 'control-label']); ?>

                    <?php echo Form::number('price', old('price'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.bundles.fields.price') ,'pattern' => "[0-9]"]); ?>

                </div>
                <div class="col-12 col-lg-4 form-group">

                    <?php echo Form::label('course_image', trans('labels.backend.bundles.fields.course_image'), ['class' => 'control-label','accept' => 'image/jpeg,image/gif,image/png']); ?>

                    <?php echo Form::file('course_image', ['class' => 'form-control']); ?>

                    <?php echo Form::hidden('course_image_max_size', 8); ?>

                    <?php echo Form::hidden('course_image_max_width', 4000); ?>

                    <?php echo Form::hidden('course_image_max_height', 4000); ?>

                    <?php if($bundle->course_image): ?>
                        <a href="<?php echo e(asset('storage/uploads/'.$bundle->course_image)); ?>" target="_blank"><img
                                    height="50px" src="<?php echo e(asset('storage/uploads/'.$bundle->course_image)); ?>" class="mt-1"></a>
                    <?php endif; ?>
                </div>
                <div class="col-12 col-lg-4 form-group">
                    <?php echo Form::label('start_date', trans('labels.backend.bundles.fields.start_date').' (yyyy-mm-dd)', ['class' => 'control-label']); ?>

                    <?php echo Form::text('start_date', old('start_date'), ['class' => 'form-control date', 'pattern' => '(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))', 'placeholder' => trans('labels.backend.bundles.fields.start_date').' (Ex . 2019-01-01)']); ?>

                    <p class="help-block"></p>
                    <?php if($errors->has('start_date')): ?>
                        <p class="help-block">
                            <?php echo e($errors->first('start_date')); ?>

                        </p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12 form-group">
                    <div class="checkbox d-inline mr-4">
                        <?php echo Form::hidden('published', 0); ?>

                        <?php echo Form::checkbox('published', 1, old('published'), []); ?>

                        <?php echo Form::label('published', trans('labels.backend.bundles.fields.published'), ['class' => 'checkbox control-label font-weight-bold']); ?>

                    </div>
                    <div class="checkbox d-inline mr-4">
                        <?php echo Form::hidden('featured', 0); ?>

                        <?php echo Form::checkbox('featured', 1, old('featured'), []); ?>

                        <?php echo Form::label('featured',  trans('labels.backend.bundles.fields.featured'), ['class' => 'checkbox control-label font-weight-bold']); ?>

                    </div>

                    <div class="checkbox d-inline mr-4">
                        <?php echo Form::hidden('trending', 0); ?>

                        <?php echo Form::checkbox('trending', 1, old('trending'), []); ?>

                        <?php echo Form::label('trending',  trans('labels.backend.bundles.fields.trending'), ['class' => 'checkbox control-label font-weight-bold']); ?>

                    </div>

                    <div class="checkbox d-inline mr-4">
                        <?php echo Form::hidden('popular', 0); ?>

                        <?php echo Form::checkbox('popular', 1, old('popular'), []); ?>

                        <?php echo Form::label('popular',  trans('labels.backend.bundles.fields.popular'), ['class' => 'checkbox control-label font-weight-bold']); ?>

                    </div>

                    <div class="checkbox d-inline mr-4">
                        <?php echo Form::hidden('free', 0); ?>

                        <?php echo Form::checkbox('free', 1, old('free'), []); ?>

                        <?php echo Form::label('free',  trans('labels.backend.bundles.fields.free'), ['class' => 'checkbox control-label font-weight-bold']); ?>

                    </div>


                </div>
            </div>

            <div class="row">
                <div class="col-12 form-group">
                    <?php echo Form::label('meta_title',trans('labels.backend.bundles.fields.meta_title'), ['class' => 'control-label']); ?>

                    <?php echo Form::text('meta_title', old('meta_title'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.bundles.fields.meta_title')]); ?>


                </div>
                <div class="col-12 form-group">
                    <?php echo Form::label('meta_description',trans('labels.backend.bundles.fields.meta_description'), ['class' => 'control-label']); ?>

                    <?php echo Form::textarea('meta_description', old('meta_description'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.bundles.fields.meta_description')]); ?>

                </div>
                <div class="col-12 form-group">
                    <?php echo Form::label('meta_keywords',trans('labels.backend.bundles.fields.meta_keywords'), ['class' => 'control-label']); ?>

                    <?php echo Form::textarea('meta_keywords', old('meta_keywords'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.bundles.fields.meta_keywords')]); ?>

                </div>
            </div>

            <div class="row">
                <div class="col-12  text-center form-group">
                    <?php echo Form::submit(trans('strings.backend.general.app_update'), ['class' => 'btn btn-danger']); ?>

                </div>
            </div>
        </div>
    </div>

    <?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-scripts'); ?>
    <script>

        $(document).ready(function () {
            $('#start_date').datepicker({
                autoclose: true,
                dateFormat: "<?php echo e(config('app.date_format_js')); ?>"
            });

            $(".js-example-placeholder-single").select2({
                placeholder: "<?php echo e(trans('labels.backend.bundles.select_category')); ?>",
            });

            $(".js-example-placeholder-multiple").select2({
                placeholder: "<?php echo e(trans('labels.backend.bundles.select_courses')); ?>",
            });
        });
        $(document).on('change', 'input[type="file"]', function () {
            var $this = $(this);
            $(this.files).each(function (key, value) {
                if (value.size > 5000000) {
                    alert('"' + value.name + '"' + 'exceeds limit of maximum file upload size')
                    $this.val("");
                }
            })
        })

    </script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>