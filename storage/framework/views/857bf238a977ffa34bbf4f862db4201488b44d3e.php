<?php $__env->startSection('title', __('labels.backend.categories.title').' | '.app_name()); ?>

<?php $__env->startPush('after-styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css')); ?>"/>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo Form::model($category, ['method' => 'PUT', 'route' => ['admin.categories.update', $category->id], 'files' => true,]); ?>


    <div class="alert alert-danger d-none" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <div class="error-list">
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline"><?php echo app('translator')->getFromJson('labels.backend.categories.edit'); ?></h3>
            <div class="float-right">
                <a href="<?php echo e(route('admin.categories.index')); ?>"
                   class="btn btn-success"><?php echo app('translator')->getFromJson('labels.backend.categories.view'); ?></a>
            </div>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
            <div class="col-12 col-lg-4 form-group">
                <?php echo Form::label('title', trans('labels.backend.categories.fields.name').' *', ['class' => 'control-label']); ?>

                <?php echo Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Enter Category Name', 'required' => false]); ?>


            </div>


            <div class="col-12 col-lg-2  form-group">

                <?php echo Form::label('icon',  trans('labels.backend.categories.fields.select_icon'), ['class' => 'control-label  d-block']); ?>

                <button class="btn  btn-block btn-default border" id="icon" name="icon"></button>

            </div>

            <div class="col-12 form-group text-center">

                <?php echo Form::submit(trans('strings.backend.general.app_save'), ['class' => 'btn mt-auto  btn-danger']); ?>

            </div>
        </div>
        </div>
    </div>
    <?php echo e(html()->form()->close()); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-scripts'); ?>
    <script src="<?php echo e(asset('plugins/bootstrap-iconpicker/js/bootstrap-iconpicker.bundle.min.js')); ?>"></script>

    <script>
        var icon = 'fas fa-bomb';
        <?php if($category->icon != ""): ?>
                icon = "<?php echo e($category->icon); ?>";
        <?php endif; ?>
        $('#icon').iconpicker({
            cols: 10,
            icon: icon,
            iconset: 'fontawesome5',
            labelHeader: '{0} of {1} pages',
            labelFooter: '{0} - {1} of {2} icons',
            placement: 'bottom', // Only in button tag
            rows: 5,
            search: true,
            searchText: 'Search',
            selectedClass: 'btn-success',
            unselectedClass: ''
        });

        $(document).on('change', '#icon_type', function () {

            if ($(this).val() == 1) {
                $('.upload-image-wrapper').parent('.col-12').removeClass('d-none')

                $('.upload-image-wrapper').removeClass('d-none');
                $('.select-icon-wrapper').addClass('d-none')
            } else if ($(this).val() == 2) {
                $('.upload-image-wrapper').parent('.col-12').removeClass('d-none')

                $('.upload-image-wrapper').addClass('d-none');
                $('.select-icon-wrapper').removeClass('d-none')
            } else {
                $('.upload-image-wrapper').parent('.col-12').addClass('d-none')
                $('.upload-image-wrapper').addClass('d-none');
                $('.select-icon-wrapper').addClass('d-none');


            }
        })

    </script>
<?php $__env->stopPush(); ?>



<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>