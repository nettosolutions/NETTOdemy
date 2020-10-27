<?php $__env->startSection('title', __('labels.backend.sitemap.title').' | '.app_name()); ?>

<?php $__env->startPush('after-styles'); ?>
    <style>
        .form-control-label {
            line-height: 35px;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo e(html()->form('POST', route('admin.sitemap.config'))->id('general-settings-form')->class('form-horizontal')->acceptsFiles()->open()); ?>


    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-12">
                    <h3 class="page-title d-inline"><?php echo app('translator')->getFromJson('labels.backend.sitemap.title'); ?></h3>
                    <a class="btn btn-primary pull-right" href="<?php echo e(route('admin.sitemap.generate')); ?>"><?php echo app('translator')->getFromJson('labels.backend.sitemap.generate'); ?></a>

                </div>
            </div>
        </div>

        <div class="card-body" id="newsletter">
            <h5><?php echo app('translator')->getFromJson('labels.backend.sitemap.sitemap_note'); ?></h5>
            <a class="mb-2 d-block" target="_blank"
               href="<?php echo e(asset('sitemap-'.str_slug(config('app.name')).'/sitemap-index.xml')); ?>"><h6>Click here to see
                    Sitemap Index File</h6></a>

            <div class="form-group row">
                <?php echo e(html()->label(__('labels.backend.sitemap.records_per_file'))->class('col-md-2 form-control-label')->for('short_description')); ?>

                <div class="col-md-10">
                    <?php echo e(html()->input('number','sitemap__chunk')
                  ->id('list_id')
                  ->class('form-control')
                  ->value(config('sitemap.chunk'))
                  ->placeholder('Ex. 100 ')); ?>

                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label"><?php echo e(__('labels.backend.sitemap.generate')); ?></label>
                <div class="col-md-10 col-form-label">
                    <?php echo e(html()->select('sitemap__schedule',['1' => __('labels.backend.sitemap.daily'),'2' => __('labels.backend.sitemap.weekly'),'3' => __('labels.backend.sitemap.monthly')])
         ->id('sitemap_schedule')
         ->class('form-control ')); ?>

                    <span><?php echo app('translator')->getFromJson('labels.backend.backup.backup_note'); ?></span>
                </div>
            </div>
            <div class="form-group text-center row">
                <div class="col text-center">
                    <button type="submit" class="btn btn-success "><?php echo e(__('buttons.general.crud.update')); ?></button>
                </div><!--col-->
            </div><!--row-->
        </div>

    </div>
    <?php echo e(html()->form()->close()); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-scripts'); ?>
    <script>
                <?php if(config('sitemap.schedule') != ""): ?>
        var schedule = "<?php echo e(config('sitemap.schedule')); ?>";
        $('#sitemap_schedule option[value="' + schedule + '"]').attr('selected', true);
        <?php endif; ?>


    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>