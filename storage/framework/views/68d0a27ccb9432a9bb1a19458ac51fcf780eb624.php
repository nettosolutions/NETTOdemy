<?php $__env->startSection('title', __('labels.backend.lessons.title').' | '.app_name()); ?>

<?php $__env->startPush('after-styles'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')); ?>">
    <style>
        .select2-container--default .select2-selection--single {
            height: 35px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 35px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 35px;
        }

        .bootstrap-tagsinput {
            width: 100% !important;
            display: inline-block;
        }

        .bootstrap-tagsinput .tag {
            line-height: 1;
            margin-right: 2px;
            background-color: #2f353a;
            color: white;
            padding: 3px;
            border-radius: 3px;
        }

    </style>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo Form::model($lesson, ['method' => 'PUT', 'route' => ['admin.lessons.update', $lesson->id], 'files' => true,]); ?>


    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0"><?php echo app('translator')->getFromJson('labels.backend.lessons.edit'); ?></h3>
            <div class="float-right">
                <a href="<?php echo e(route('admin.lessons.index')); ?>"
                   class="btn btn-success"><?php echo app('translator')->getFromJson('labels.backend.lessons.view'); ?></a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-6 form-group">
                    <?php echo Form::label('course_id', trans('labels.backend.lessons.fields.course'), ['class' => 'control-label']); ?>

                    <?php echo Form::select('course_id', $courses, old('course_id'), ['class' => 'form-control select2']); ?>

                </div>
                <div class="col-12 col-lg-6 form-group">
                    <?php echo Form::label('title', trans('labels.backend.lessons.fields.title').'*', ['class' => 'control-label']); ?>

                    <?php echo Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.lessons.fields.title'), 'required' => '']); ?>


                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-6 form-group">
                    <?php echo Form::label('slug', trans('labels.backend.lessons.fields.slug'), ['class' => 'control-label']); ?>

                    <?php echo Form::text('slug', old('slug'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.lessons.slug_placeholder')]); ?>

                </div>
                <?php if($lesson->lesson_image): ?>

                    <div class="col-12 col-lg-5 form-group">

                        <?php echo Form::label('lesson_image', trans('labels.backend.lessons.fields.lesson_image').' '.trans('labels.backend.lessons.max_file_size'), ['class' => 'control-label']); ?>

                        <?php echo Form::file('lesson_image', ['class' => 'form-control', 'accept' => 'image/jpeg,image/gif,image/png', 'style' => 'margin-top: 4px;']); ?>

                        <?php echo Form::hidden('lesson_image_max_size', 8); ?>

                        <?php echo Form::hidden('lesson_image_max_width', 4000); ?>

                        <?php echo Form::hidden('lesson_image_max_height', 4000); ?>

                    </div>
                    <div class="col-lg-1 col-12 form-group">
                        <a href="<?php echo e(asset('uploads/'.$lesson->lesson_image)); ?>" target="_blank"><img
                                    src="<?php echo e(asset('uploads/'.$lesson->lesson_image)); ?>" height="65px"
                                    width="65px"></a>
                    </div>
                <?php else: ?>
                    <div class="col-12 col-lg-6 form-group">

                        <?php echo Form::label('lesson_image', trans('labels.backend.lessons.fields.lesson_image').' '.trans('labels.backend.lessons.max_file_size'), ['class' => 'control-label']); ?>

                        <?php echo Form::file('lesson_image', ['class' => 'form-control']); ?>

                        <?php echo Form::hidden('lesson_image_max_size', 8); ?>

                        <?php echo Form::hidden('lesson_image_max_width', 4000); ?>

                        <?php echo Form::hidden('lesson_image_max_height', 4000); ?>

                    </div>
                <?php endif; ?>

            </div>

            <div class="row">
                <div class="col-12 form-group">
                    <?php echo Form::label('short_text', trans('labels.backend.lessons.fields.short_text'), ['class' => 'control-label']); ?>

                    <?php echo Form::textarea('short_text', old('short_text'), ['class' => 'form-control ', 'placeholder' => trans('labels.backend.lessons.short_description_placeholder')]); ?>

                </div>
            </div>
            <div class="row">
                <div class="col-12 form-group">
                    <?php echo Form::label('full_text', trans('labels.backend.lessons.fields.full_text'), ['class' => 'control-label']); ?>

                    <?php echo Form::textarea('full_text', old('full_text'), ['class' => 'form-control editor', 'placeholder' => '']); ?>

                </div>
            </div>
            <div class="row">
                <div class="col-12 form-group">
                    <?php echo Form::label('downloadable_files', trans('labels.backend.lessons.fields.downloadable_files').' '.trans('labels.backend.lessons.max_file_size'), ['class' => 'control-label']); ?>

                    <?php echo Form::file('downloadable_files[]', [
                        'multiple',
                        'class' => 'form-control file-upload',
                         'id' => 'downloadable_files',
                        'accept' => "image/jpeg,image/gif,image/png,application/msword,audio/mpeg,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application,application/vnd.openxmlformats-officedocument.presentationml.presentation,application/vnd.ms-powerpoint,application/pdf,video/mp4"

                        ]); ?>

                    <div class="photo-block mt-3">
                        <div class="files-list">
                            <?php if(count($lesson->downloadableMedia) > 0): ?>
                                <?php $__currentLoopData = $lesson->downloadableMedia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <p class="form-group">
                                        <a href="<?php echo e(asset('storage/uploads/'.$media->name)); ?>"
                                           target="_blank"><?php echo e($media->name); ?>

                                            (<?php echo e($media->size); ?> KB)</a>
                                        <a href="#" data-media-id="<?php echo e($media->id); ?>"
                                           class="btn btn-xs btn-danger delete remove-file"><?php echo app('translator')->getFromJson('labels.backend.lessons.remove'); ?></a>
                                    </p>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 form-group">
                    <?php echo Form::label('pdf_files', trans('labels.backend.lessons.fields.add_pdf'), ['class' => 'control-label']); ?>

                    <?php echo Form::file('add_pdf', [
                        'class' => 'form-control file-upload',
                         'id' => 'add_pdf',
                        'accept' => "application/pdf"
                        ]); ?>

                    <div class="photo-block mt-3">
                        <div class="files-list">
                            <?php if($lesson->mediaPDF): ?>
                                <p class="form-group">
                                    <a href="<?php echo e(asset('storage/uploads/'.$lesson->mediaPDF->name)); ?>"
                                       target="_blank"><?php echo e($lesson->mediaPDF->name); ?>

                                        (<?php echo e($lesson->mediaPDF->size); ?> KB)</a>
                                    <a href="#" data-media-id="<?php echo e($lesson->mediaPDF->id); ?>"
                                       class="btn btn-xs btn-danger delete remove-file"><?php echo app('translator')->getFromJson('labels.backend.lessons.remove'); ?></a>
                                    <iframe src="<?php echo e(asset('storage/uploads/'.$lesson->mediaPDF->name)); ?>" width="100%" height="500px">
                                    </iframe>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 form-group">
                    <?php echo Form::label('pdf_files', trans('labels.backend.lessons.fields.add_audio'), ['class' => 'control-label']); ?>

                    <?php echo Form::file('add_audio', [
                        'class' => 'form-control file-upload',
                         'id' => 'add_audio',
                        'accept' => "audio/mpeg3"
                        ]); ?>

                    <div class="photo-block mt-3">
                        <div class="files-list">
                            <?php if($lesson->mediaAudio): ?>
                                <p class="form-group">
                                    <a href="<?php echo e(asset('storage/uploads/'.$lesson->mediaAudio->name)); ?>"
                                       target="_blank"><?php echo e($lesson->mediaAudio->name); ?>

                                        (<?php echo e($lesson->mediaAudio->size); ?> KB)</a>
                                    <a href="#" data-media-id="<?php echo e($lesson->mediaAudio->id); ?>"
                                       class="btn btn-xs btn-danger delete remove-file"><?php echo app('translator')->getFromJson('labels.backend.lessons.remove'); ?></a>
                                    <audio id="player" controls>
                                        <source src="<?php echo e($lesson->mediaAudio->url); ?>" type="audio/mp3" />
                                    </audio>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <?php echo Form::label('add_video', trans('labels.backend.lessons.fields.add_video'), ['class' => 'control-label']); ?>

                    <?php echo Form::select('media_type', ['youtube' => 'Youtube','vimeo' => 'Vimeo','upload' => 'Upload','embed' => 'Embed'],($lesson->mediavideo) ? $lesson->mediavideo->type : null,['class' => 'form-control', 'placeholder' => 'Select One','id'=>'media_type' ]); ?>



                    <?php echo Form::text('video', ($lesson->mediavideo) ? $lesson->mediavideo->url : null, ['class' => 'form-control mt-3 d-none', 'placeholder' => trans('labels.backend.lessons.enter_video_url'),'id'=>'video'  ]); ?>


                    <?php echo Form::file('video_file', ['class' => 'form-control mt-3 d-none', 'placeholder' => trans('labels.backend.lessons.enter_video_url'),'id'=>'video_file','accept' =>'video/mp4'  ]); ?>

                    <input type="hidden" name="old_video_file"
                           value="<?php echo e(($lesson->mediavideo && $lesson->mediavideo->type == 'upload') ? $lesson->mediavideo->url  : ""); ?>">


                    <?php if($lesson->mediavideo && ($lesson->mediavideo->type == 'upload')): ?>
                        <video width="300" class="mt-2 d-none video-player" controls>
                            <source src="<?php echo e(($lesson->mediavideo && $lesson->mediavideo->type == 'upload') ? $lesson->mediavideo->url  : ""); ?>"
                                    type="video/mp4">
                            Your browser does not support HTML5 video.
                        </video>

                    <?php endif; ?>

                    <?php echo app('translator')->getFromJson('labels.backend.lessons.video_guide'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-3  form-group">
                    <?php echo Form::hidden('published', 0); ?>

                    <?php echo Form::checkbox('published', 1, old('published'), []); ?>

                    <?php echo Form::label('published', trans('labels.backend.lessons.fields.published'), ['class' => 'control-label control-label font-weight-bold']); ?>

                </div>
                <div class="col-12  text-left form-group">
                    <?php echo Form::submit(trans('strings.backend.general.app_update'), ['class' => 'btn  btn-primary']); ?>

                </div>
            </div>
        </div>
    </div>
    <?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-scripts'); ?>
    <script src="<?php echo e(asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')); ?>"></script>

    <script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>
    <script>
        $('.editor').each(function () {
            CKEDITOR.replace($(this).attr('id'), {
                filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=<?php echo e(csrf_token()); ?>',
                filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=<?php echo e(csrf_token()); ?>',
                toolbarGroups: [{
                    "name": "basicstyles",
                    "groups": ["basicstyles"]
                },
                    {
                        "name": "links",
                        "groups": ["links"]
                    },
                    {
                        "name": "paragraph",
                        "groups": ["list", "blocks"]
                    },
                    {
                        "name": "document",
                        "groups": ["mode"]
                    },
                    {
                        "name": "insert",
                        "groups": ["insert"]
                    },
                    {
                        "name": "styles",
                        "groups": ["styles"]
                    },
                    {
                        "name": "about",
                        "groups": ["about"]
                    }
                ],
                // Remove the redundant buttons from toolbar groups defined above.
                removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
            });
        });

        $(document).ready(function () {
            $(document).on('click', '.delete', function (e) {
                e.preventDefault();
                var parent = $(this).parent('.form-group');
                var confirmation = confirm('<?php echo e(trans('strings.backend.general.are_you_sure')); ?>')
                if (confirmation) {
                    var media_id = $(this).data('media-id');
                    $.post('<?php echo e(route('admin.media.destroy')); ?>', {media_id: media_id, _token: '<?php echo e(csrf_token()); ?>'},
                        function (data, status) {
                            if (data.success) {
                                parent.remove();
                            } else {
                                alert('Something Went Wrong')
                            }
                        });
                }
            })
        });

        var uploadField = $('input[type="file"]');


        $(document).on('change', 'input[name="lesson_image"]', function () {
            var $this = $(this);
            $(this.files).each(function (key, value) {
                if (value.size > 5000000) {
                    alert('"' + value.name + '"' + 'exceeds limit of maximum file upload size')
                    $this.val("");
                }
            })
        });

        <?php if($lesson->mediavideo): ?>
        <?php if($lesson->mediavideo->type !=  'upload'): ?>
        $('#video').removeClass('d-none').attr('required', true);
        $('#video_file').addClass('d-none').attr('required', false);
        $('.video-player').addClass('d-none');
        <?php elseif($lesson->mediavideo->type == 'upload'): ?>
        $('#video').addClass('d-none').attr('required', false);
        $('#video_file').removeClass('d-none').attr('required', false);
        $('.video-player').removeClass('d-none');
        <?php else: ?>
        $('.video-player').addClass('d-none');
        $('#video_file').addClass('d-none').attr('required', false);
        $('#video').addClass('d-none').attr('required', false);
        <?php endif; ?>
        <?php endif; ?>

        $(document).on('change', '#media_type', function () {
            if ($(this).val()) {
                if ($(this).val() != 'upload') {
                    $('#video').removeClass('d-none').attr('required', true);
                    $('#video_file').addClass('d-none').attr('required', false);
                    $('.video-player').addClass('d-none')
                } else if ($(this).val() == 'upload') {
                    $('#video').addClass('d-none').attr('required', false);
                    $('#video_file').removeClass('d-none').attr('required', true);
                    $('.video-player').removeClass('d-none')
                }
            } else {
                $('#video_file').addClass('d-none').attr('required', false);
                $('#video').addClass('d-none').attr('required', false)
            }
        })

    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>