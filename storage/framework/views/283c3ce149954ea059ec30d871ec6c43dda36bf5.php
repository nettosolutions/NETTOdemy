<?php $__env->startSection('title', __('labels.backend.pages.title').' | '.app_name()); ?>

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
        .bootstrap-tagsinput{
            width: 100%!important;
            display: inline-block;
        }
        .bootstrap-tagsinput .tag{
            line-height: 1;
            margin-right: 2px;
            background-color: #2f353a ;
            color: white;
            padding: 3px;
            border-radius: 3px;
        }

    </style>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo Form::model($page, ['method' => 'PUT', 'route' => ['admin.pages.update', $page->id], 'files' => true,]); ?>


    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0"><?php echo app('translator')->getFromJson('labels.backend.pages.edit'); ?></h3>
            <div class="float-right">
                <a href="<?php echo e(route('admin.pages.index')); ?>"
                   class="btn btn-success"><?php echo app('translator')->getFromJson('labels.backend.pages.view'); ?></a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 form-group">
                    <?php echo Form::label('title', trans('labels.backend.pages.fields.title'), ['class' => 'control-label']); ?>

                    <?php echo Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.pages.fields.title'), ]); ?>

                </div>
            </div>


            <div class="row">
                <div class="col-12 col-lg-6 form-group">
                    <?php echo Form::label('slug', trans('labels.backend.pages.fields.slug'), ['class' => 'control-label']); ?>

                    <?php echo Form::text('slug', old('slug'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.pages.slug_placeholder')]); ?>

                </div>
                <?php if($page->image): ?>
                    <div class="col-12 col-lg-5 form-group">
                        <?php echo Form::label('featured_image', trans('labels.backend.pages.fields.featured_image').' '.trans('labels.backend.pages.max_file_size'), ['class' => 'control-label']); ?>

                        <?php echo Form::file('featured_image', ['class' => 'form-control', 'accept' => 'image/jpeg,image/gif,image/png']); ?>

                        <?php echo Form::hidden('featured_image_max_size', 8); ?>

                        <?php echo Form::hidden('featured_image_max_width', 4000); ?>

                        <?php echo Form::hidden('featured_image_max_height', 4000); ?>

                    </div>
                    <div class="col-lg-1 col-12 form-group">
                        <a href="<?php echo e(asset('storage/uploads/'.$page->image)); ?>" target="_blank"><img
                                    src="<?php echo e(asset('storage/uploads/'.$page->image)); ?>" height="65px"
                                    width="65px"></a>
                    </div>
                <?php else: ?>
                    <div class="col-12 col-lg-6 form-group">

                        <?php echo Form::label('featured_image', trans('labels.backend.pages.fields.featured_image').' '.trans('labels.backend.pages.max_file_size'), ['class' => 'control-label']); ?>

                        <?php echo Form::file('featured_image', ['class' => 'form-control']); ?>

                        <?php echo Form::hidden('featured_image_max_size', 8); ?>

                        <?php echo Form::hidden('featured_image_max_width', 4000); ?>

                        <?php echo Form::hidden('featured_image_max_height', 4000); ?>

                    </div>
                <?php endif; ?>

            </div>


            <div class="row">
                <div class="col-12 form-group">
                    <?php echo Form::label('content', trans('labels.backend.pages.fields.content'), ['class' => 'control-label']); ?>

                    <?php echo Form::textarea('content', old('content'), ['class' => 'form-control editor', 'placeholder' => '']); ?>

                </div>
            </div>

            <div class="row">
                <div class="col-12 form-group">
                    <?php echo Form::label('meta_title',trans('labels.backend.pages.fields.meta_title'), ['class' => 'control-label']); ?>

                    <?php echo Form::text('meta_title', old('meta_title'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.pages.fields.meta_title')]); ?>


                </div>
                <div class="col-12 form-group">
                    <?php echo Form::label('meta_description',trans('labels.backend.pages.fields.meta_description'), ['class' => 'control-label']); ?>

                    <?php echo Form::textarea('meta_description', old('meta_description'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.pages.fields.meta_description')]); ?>

                </div>
                <div class="col-12 form-group">
                    <?php echo Form::label('meta_keywords',trans('labels.backend.pages.fields.meta_keywords'), ['class' => 'control-label']); ?>

                    <?php echo Form::textarea('meta_keywords', old('meta_keywords'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.pages.fields.meta_keywords')]); ?>

                </div>
                <div class="col-12 form-group">
                    <div class="checkbox d-inline mr-4">
                        <?php echo Form::hidden('published', 0); ?>

                        <?php echo Form::checkbox('published', 1, old('published'), []); ?>

                        <?php echo Form::label('published', trans('labels.backend.pages.fields.published'), ['class' => 'checkbox control-label font-weight-bold']); ?>

                    </div>
                    <div class="checkbox d-inline mr-3">
                        <?php echo Form::hidden('sidebar', 0); ?>

                        <?php echo Form::checkbox('sidebar', 1, old('sidebar'), []); ?>

                        <?php echo Form::label('sidebar',  trans('labels.backend.courses.fields.sidebar'), ['class' => 'checkbox control-label font-weight-bold']); ?>

                    </div>
                </div>

            </div>

            <div class="row">


                <div class="col-md-12 text-center form-group">
                    <button type="submit" class="btn btn-info waves-effect waves-light ">
                        <?php echo e(trans('labels.general.buttons.update')); ?>

                    </button>
                    <a href="<?php echo e(route('admin.pages.index')); ?>" class="btn btn-danger waves-effect waves-light ">
                        <?php echo e(trans('strings.backend.general.app_back_to_list')); ?>

                    </a>
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
            CKEDITOR.plugins.addExternal( 'bidi', '<?php echo e(asset('plugins/bidi')); ?>', 'plugin.js' );

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
                            }else{
                                alert('Something Went Wrong')
                            }
                        });
                }
            })
        })
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>