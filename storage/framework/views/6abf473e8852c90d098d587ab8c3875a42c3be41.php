<?php $__env->startSection('title', __('labels.backend.bundles.title').' | '.app_name()); ?>

<?php $__env->startPush('after-styles'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/amigo-sorter/css/theme-default.css')); ?>">
    <style>
        ul.sorter > span {
            display: inline-block;
            width: 100%;
            height: 100%;
            background: #f5f5f5;
            color: #333333;
            border: 1px solid #cccccc;
            border-radius: 6px;
            padding: 0px;
        }

        ul.sorter li > span .title {
            padding-left: 15px;
            width: 70%;
        }

        ul.sorter li > span .btn {
            width: 20%;
        }

        @media  screen and (max-width: 768px) {

            ul.sorter li > span .btn {
                width: 30%;
            }

            ul.sorter li > span .title {
                padding-left: 15px;
                width: 70%;
                float: left;
                margin: 0 !important;
            }

        }


    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="card">

        <div class="card-header">
            <h3 class="page-title mb-0"><?php echo app('translator')->getFromJson('labels.backend.bundles.title'); ?></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th><?php echo app('translator')->getFromJson('labels.backend.bundles.fields.title'); ?></th>
                            <td>
                                <?php if($bundle->published == 1): ?>
                                    <a class="text-decoration-none"  target="_blank"
                                       href="<?php echo e(route('bundles.show', [$bundle->slug])); ?>"><?php echo e($bundle->title); ?></a>
                                <?php else: ?>
                                    <?php echo e($bundle->title); ?>

                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('labels.backend.bundles.fields.slug'); ?></th>
                            <td><?php echo e($bundle->slug); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('labels.backend.bundles.fields.category'); ?></th>
                            <td><?php echo e($bundle->category->name); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('labels.backend.bundles.fields.courses'); ?></th>
                            <td>
                                <ol class="pl-3 mb-0">
                                    <?php $__currentLoopData = $bundle->courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <a target="_blank" class="text-decoration-none" href="<?php echo e(route('courses.show',['slug' => $course->slug])); ?>"><?php echo e($course->title); ?></a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ol>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('labels.backend.bundles.fields.description'); ?></th>
                            <td><?php echo $bundle->description; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('labels.backend.bundles.fields.price'); ?></th>
                            <td><?php echo e(($bundle->free == 1) ? trans('labels.backend.bundles.fields.free') : $bundle->price .' '.$appCurrency['symbol']); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('labels.backend.bundles.fields.course_image'); ?></th>
                            <td><?php if($bundle->course_image): ?><a
                                        href="<?php echo e(asset('storage/uploads/' . $bundle->course_image)); ?>"
                                        target="_blank"><img
                                            src="<?php echo e(asset('storage/uploads/' . $bundle->course_image)); ?>"
                                            height="50px"/></a><?php endif; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('labels.backend.bundles.fields.start_date'); ?></th>
                            <td><?php echo e($bundle->start_date); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('labels.backend.bundles.fields.published'); ?></th>
                            <td><?php echo e(Form::checkbox("published", 1, $bundle->published == 1 ? true : false, ["disabled"])); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('labels.backend.bundles.fields.meta_title'); ?></th>
                            <td><?php echo e($bundle->meta_title); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('labels.backend.bundles.fields.meta_description'); ?></th>
                            <td><?php echo e($bundle->meta_description); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('labels.backend.bundles.fields.meta_keywords'); ?></th>
                            <td><?php echo e($bundle->meta_keywords); ?></td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-scripts'); ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>