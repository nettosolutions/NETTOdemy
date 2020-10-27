<?php $__env->startSection('title', __('labels.backend.lessons.title').' | '.app_name()); ?>

<?php $__env->startSection('content'); ?>

    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0"><?php echo app('translator')->getFromJson('labels.backend.lessons.title'); ?></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th><?php echo app('translator')->getFromJson('labels.backend.lessons.fields.course'); ?></th>
                            <td><?php echo e($lesson->course->title or ''); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('labels.backend.lessons.fields.title'); ?></th>
                            <td><?php echo e($lesson->title); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('labels.backend.lessons.fields.slug'); ?></th>
                            <td><?php echo e($lesson->slug); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('labels.backend.lessons.fields.lesson_image'); ?></th>
                            <td><?php if($lesson->lesson_image): ?><a href="<?php echo e(asset('storage/uploads/' . $lesson->lesson_image)); ?>" target="_blank"><img
                                            src="<?php echo e(asset('storage/uploads/' . $lesson->lesson_image)); ?>" height="100px"/></a><?php endif; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('labels.backend.lessons.fields.short_text'); ?></th>
                            <td><?php echo $lesson->short_text; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('labels.backend.lessons.fields.full_text'); ?></th>
                            <td><?php echo $lesson->full_text; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('labels.backend.lessons.fields.position'); ?></th>
                            <td><?php echo e($lesson->position); ?></td>
                        </tr>

                        <tr>
                            <th><?php echo app('translator')->getFromJson('labels.backend.lessons.fields.media_pdf'); ?></th>
                            <td>
                                <?php if($lesson->mediaPDF != null ): ?>
                                <p class="form-group">
                                    <a href="<?php echo e($lesson->mediaPDF->url); ?>" target="_blank"><?php echo e($lesson->mediaPDF->url); ?></a>
                                </p>
                                <?php else: ?>
                                    <p>No PDF</p>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('labels.backend.lessons.fields.media_audio'); ?></th>
                            <td>
                                <?php if($lesson->mediaAudio != null ): ?>
                                <p class="form-group">
                                    <a href="<?php echo e($lesson->mediaAudio->url); ?>" target="_blank"><?php echo e($lesson->mediaAudio->url); ?></a>
                                </p>
                                <?php else: ?>
                                    <p>No Audio</p>
                                <?php endif; ?>
                            </td>
                        </tr>

                        <tr>

                            <th><?php echo app('translator')->getFromJson('labels.backend.lessons.fields.downloadable_files'); ?></th>
                            <td>
                                <?php if(count($lesson->downloadableMedia) > 0 ): ?>
                                    <?php $__currentLoopData = $lesson->downloadableMedia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <p class="form-group">
                                            <a href="<?php echo e(asset('storage/uploads/'.$media->name)); ?>"
                                               target="_blank"><?php echo e($media->name); ?>

                                                (<?php echo e($media->size); ?> KB)</a>
                                        </p>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <p>No Files</p>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('labels.backend.lessons.fields.media_video'); ?></th>
                            <td>
                                <?php if($lesson->mediaVideo !=  null ): ?>
                                        <p class="form-group">
                                           <a href="<?php echo e($lesson->mediaVideo->url); ?>" target="_blank"><?php echo e($lesson->mediaVideo->url); ?></a>
                                        </p>
                                <?php else: ?>
                                    <p>No Videos</p>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('labels.backend.lessons.fields.published'); ?></th>
                            <td><?php echo e(Form::checkbox("published", 1, $lesson->published == 1 ? true : false, ["disabled"])); ?></td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->



            <a href="<?php echo e(route('admin.lessons.index')); ?>"
               class="btn btn-default border"><?php echo app('translator')->getFromJson('strings.backend.general.app_back_to_list'); ?></a>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>