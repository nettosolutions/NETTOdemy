<?php
    $path = 'frontend';

    if(session()->has('display_type')){
                if(session('display_type') == 'rtl'){
                    $path = 'frontend-rtl';
                }else{
                    $path = 'frontend';
                }
            }else if(config('app.display_type') == 'rtl'){
                $path = 'frontend-rtl';
            }

?>


<?php $__env->startSection(Config::get('chatter.yields.head')); ?>
    <link href="<?php echo e(url('/vendor/devdojo/chatter/assets/vendor/spectrum/spectrum.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(url('/vendor/devdojo/chatter/assets/css/chatter.css')); ?>" rel="stylesheet">
    <?php if($chatter_editor == 'simplemde'): ?>
        <link href="<?php echo e(url('/vendor/devdojo/chatter/assets/css/simplemde.min.css')); ?>" rel="stylesheet">
    <?php elseif($chatter_editor == 'trumbowyg'): ?>
        <link href="<?php echo e(url('/vendor/devdojo/chatter/assets/vendor/trumbowyg/ui/trumbowyg.css')); ?>" rel="stylesheet">
        <style>
            .trumbowyg-box, .trumbowyg-editor {
                margin: 0px auto;
            }
        </style>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-styles'); ?>
    <style>
        #chatter .chatter_sidebar ul {
            margin-left: 10px;
            display: block;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>

    <div id="chatter" class="chatter_home">
        <section id="chatter_hero" class="breadcrumb-section relative-position backgroud-style">
            <div class="blakish-overlay"></div>
            <div class="container">
                <div class="page-breadcrumb-content text-center">
                <!-- <?php $headline_logo = Config::get('chatter.headline_logo'); ?>
                <?php if( isset( $headline_logo ) && !empty( $headline_logo ) ): ?>
                    <img src="<?php echo e(Config::get('chatter.headline_logo')); ?>">
                    <?php else: ?>
                    <h1><?php echo app('translator')->getFromJson('chatter::intro.headline'); ?></h1>
                        <p><?php echo app('translator')->getFromJson('chatter::intro.description'); ?></p>
                    <?php endif; ?>
                        -->

                    <h1>Welcome to <?php echo e(env('APP_NAME')); ?> Forums</h1>
                </div>
            </div>
        </section>

        <?php if(config('chatter.errors')): ?>
            <?php if(Session::has('chatter_alert')): ?>
                <div class="chatter-alert alert alert-<?php echo e(Session::get('chatter_alert_type')); ?>">
                    <div class="container">
                        <strong><i class="chatter-alert-<?php echo e(Session::get('chatter_alert_type')); ?>"></i> <?php echo e(Config::get('chatter.alert_messages.' . Session::get('chatter_alert_type'))); ?>

                        </strong>
                        <?php echo e(Session::get('chatter_alert')); ?>

                        <i class="chatter-close"></i>
                    </div>
                </div>
                <div class="chatter-alert-spacer"></div>
            <?php endif; ?>

            <?php if(count($errors) > 0): ?>
                <div class="chatter-alert alert alert-danger">
                    <div class="container">
                        <p><strong><i class="chatter-alert-danger"></i> <?php echo app('translator')->getFromJson('chatter::alert.danger.title'); ?>
                            </strong> <?php echo app('translator')->getFromJson('chatter::alert.danger.reason.errors'); ?></p>
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="container chatter_container">

            <div class="row">

                <div class="col-md-3 left-column">
                    <!-- SIDEBAR -->
                    <div class="chatter_sidebar">
                        <button class="btn btn-primary" id="new_discussion_btn"><i
                                    class="chatter-new"></i> <?php echo app('translator')->getFromJson('chatter::messages.discussion.new'); ?></button>
                        <a href="/<?php echo e(Config::get('chatter.routes.home')); ?>"><i
                                    class="chatter-bubble"></i> <?php echo app('translator')->getFromJson('chatter::messages.discussion.all'); ?></a>
                        <?php echo $categoriesMenu; ?>

                    </div>
                    <!-- END SIDEBAR -->
                </div>
                <div class="col-md-9 right-column">
                    <div class="panel">
                        <ul class="discussions">
                            <?php $__currentLoopData = $discussions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $discussion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a class="discussion_list"
                                       href="/<?php echo e(Config::get('chatter.routes.home')); ?>/<?php echo e(Config::get('chatter.routes.discussion')); ?>/<?php echo e($discussion->category->slug); ?>/<?php echo e($discussion->slug); ?>">
                                        <div class="chatter_avatar">
                                        <?php if(Config::get('chatter.user.avatar_image_database_field')): ?>

                                            <?php $db_field = Config::get('chatter.user.avatar_image_database_field'); ?>

                                            <!-- If the user db field contains http:// or https:// we don't need to use the relative path to the image assets -->
                                                <?php if( (substr($discussion->user->{$db_field}, 0, 7) == 'http://') || (substr($discussion->user->{$db_field}, 0, 8) == 'https://') ): ?>
                                                    <img src="<?php echo e($discussion->user->{$db_field}); ?>">
                                                <?php else: ?>
                                                    <img src="<?php echo e(Config::get('chatter.user.relative_url_to_image_assets') . $discussion->user->{$db_field}); ?>">
                                                <?php endif; ?>

                                            <?php else: ?>

                                                <span class="chatter_avatar_circle"
                                                      style="background-color:#<?= \DevDojo\Chatter\Helpers\ChatterHelper::stringToColorCode($discussion->user->{Config::get('chatter.user.database_field_with_user_name')}) ?>">
					        					<?php echo e(strtoupper(substr($discussion->user->{Config::get('chatter.user.database_field_with_user_name')}, 0, 1))); ?>

					        				</span>

                                            <?php endif; ?>
                                        </div>

                                        <div class="chatter_middle">
                                            <h3 class="chatter_middle_title"><?php echo e($discussion->title); ?>

                                                <div class="chatter_cat"
                                                     style="background-color:<?php echo e($discussion->category->color); ?>"><?php echo e($discussion->category->name); ?></div>
                                            </h3>
                                            <span class="chatter_middle_details"><?php echo app('translator')->getFromJson('chatter::messages.discussion.posted_by'); ?>
                                                <span data-href="/user"><?php echo e(ucfirst($discussion->user->{Config::get('chatter.user.database_field_with_user_name')})); ?></span> <?php echo e(\Carbon\Carbon::createFromTimeStamp(strtotime($discussion->created_at))->diffForHumans()); ?></span>
                                            <?php if($discussion->post[0]->markdown): ?>
                                                <?php $discussion_body = GrahamCampbell\Markdown\Facades\Markdown::convertToHtml($discussion->post[0]->body); ?>
                                            <?php else: ?>
                                                <?php $discussion_body = $discussion->post[0]->body; ?>
                                            <?php endif; ?>
                                            <p><?php echo e(substr(strip_tags($discussion_body), 0, 200)); ?><?php if(strlen(strip_tags($discussion_body)) > 200): ?><?php echo e('...'); ?><?php endif; ?></p>
                                        </div>

                                        <div class="chatter_right">

                                            <div class="chatter_count"><i
                                                        class="chatter-bubble"></i> <?php echo e($discussion->postsCount[0]->total); ?>

                                            </div>
                                        </div>

                                        <div class="chatter_clear"></div>
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>

                    <div id="pagination">
                        <?php echo e($discussions->links()); ?>

                    </div>

                </div>
            </div>
        </div>

        <div id="new_discussion">


            <div class="chatter_loader dark" id="new_discussion_loader">
                <div></div>
            </div>

            <form id="chatter_form_editor"
                  action="/<?php echo e(Config::get('chatter.routes.home')); ?>/<?php echo e(Config::get('chatter.routes.discussion')); ?>"
                  method="POST">
                <div class="row">
                    <div class="col-md-7">
                        <!-- TITLE -->
                        <input type="text" class="form-control" id="title" name="title"
                               placeholder="<?php echo app('translator')->getFromJson('chatter::messages.editor.title'); ?>" value="<?php echo e(old('title')); ?>">
                    </div>

                    <div class="col-md-4">
                        <!-- CATEGORY -->
                        <select id="chatter_category_id" class="form-control" name="chatter_category_id">
                            <option value=""><?php echo app('translator')->getFromJson('chatter::messages.editor.select'); ?></option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(old('chatter_category_id') == $category->id): ?>
                                    <option value="<?php echo e($category->id); ?>" selected><?php echo e($category->name); ?></option>
                                <?php elseif(!empty($current_category_id) && $current_category_id == $category->id): ?>
                                    <option value="<?php echo e($category->id); ?>" selected><?php echo e($category->name); ?></option>
                                <?php else: ?>
                                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="col-md-1">
                        <i class="chatter-close"></i>
                    </div>
                </div><!-- .row -->

                <!-- BODY -->
                <div id="editor">
                    <?php if( $chatter_editor == 'tinymce' || empty($chatter_editor) ): ?>
                        <label id="tinymce_placeholder"><?php echo app('translator')->getFromJson('chatter::messages.editor.tinymce_placeholder'); ?></label>
                        <textarea id="body" class="richText" name="body" placeholder=""><?php echo e(old('body')); ?></textarea>
                    <?php elseif($chatter_editor == 'simplemde'): ?>
                        <textarea id="simplemde" name="body" placeholder=""><?php echo e(old('body')); ?></textarea>
                    <?php elseif($chatter_editor == 'trumbowyg'): ?>
                        <textarea class="trumbowyg" name="body"
                                  placeholder="<?php echo app('translator')->getFromJson('chatter::messages.editor.tinymce_placeholder'); ?>"><?php echo e(old('body')); ?></textarea>
                    <?php endif; ?>
                </div>

                <input type="hidden" name="_token" id="csrf_token_field" value="<?php echo e(csrf_token()); ?>">

                <div id="new_discussion_footer">
                    <input type='text' id="color" name="color"/><span
                            class="select_color_text"><?php echo app('translator')->getFromJson('chatter::messages.editor.select_color_text'); ?></span>
                    <button id="submit_discussion" class="btn btn-success pull-right"><i
                                class="chatter-new"></i> <?php echo app('translator')->getFromJson('chatter::messages.discussion.create'); ?></button>
                    <a href="/<?php echo e(Config::get('chatter.routes.home')); ?>" class="btn btn-default pull-right"
                       id="cancel_discussion"><?php echo app('translator')->getFromJson('chatter::messages.words.cancel'); ?></a>
                    <div style="clear:both"></div>
                </div>
            </form>

        </div><!-- #new_discussion -->

    </div>

    <?php if( $chatter_editor == 'tinymce' || empty($chatter_editor) ): ?>
        <input type="hidden" id="chatter_tinymce_toolbar" value="<?php echo e(Config::get('chatter.tinymce.toolbar')); ?>">
        <input type="hidden" id="chatter_tinymce_plugins" value="<?php echo e(Config::get('chatter.tinymce.plugins')); ?>">
    <?php endif; ?>
    <input type="hidden" id="current_path" value="<?php echo e(Request::path()); ?>">

<?php $__env->stopSection(); ?>

<?php $__env->startSection(Config::get('chatter.yields.footer')); ?>


    <?php if( $chatter_editor == 'tinymce' || empty($chatter_editor) ): ?>
        <script src="<?php echo e(url('/vendor/devdojo/chatter/assets/vendor/tinymce/tinymce.min.js')); ?>"></script>
        <script src="<?php echo e(url('/vendor/devdojo/chatter/assets/js/tinymce.js')); ?>"></script>
        <script>
            var my_tinymce = tinyMCE;
            $('document').ready(function () {
                $('#tinymce_placeholder').click(function () {
                    my_tinymce.activeEditor.focus();
                });
            });
        </script>
    <?php elseif($chatter_editor == 'simplemde'): ?>
        <script src="<?php echo e(url('/vendor/devdojo/chatter/assets/js/simplemde.min.js')); ?>"></script>
        <script src="<?php echo e(url('/vendor/devdojo/chatter/assets/js/chatter_simplemde.js')); ?>"></script>
    <?php elseif($chatter_editor == 'trumbowyg'): ?>
        <script src="<?php echo e(url('/vendor/devdojo/chatter/assets/vendor/trumbowyg/trumbowyg.min.js')); ?>"></script>
        <script src="<?php echo e(url('/vendor/devdojo/chatter/assets/vendor/trumbowyg/plugins/preformatted/trumbowyg.preformatted.min.js')); ?>"></script>
        <script src="<?php echo e(url('/vendor/devdojo/chatter/assets/js/trumbowyg.js')); ?>"></script>
    <?php endif; ?>

    <script src="<?php echo e(url('/vendor/devdojo/chatter/assets/vendor/spectrum/spectrum.js')); ?>"></script>
    <script src="<?php echo e(url('/vendor/devdojo/chatter/assets/js/chatter.js')); ?>"></script>
    <script>
        $('document').ready(function () {

            $('.chatter-close, #cancel_discussion').click(function () {
                $('#new_discussion').slideUp();
            });
            $('#new_discussion_btn').click(function () {
                <?php if(Auth::guest()): ?>
                    window.location.href = "<?php echo e(route('frontend.auth.login')); ?>";
                <?php else: ?>
                $('#new_discussion').slideDown();
                $('#title').focus();
                <?php endif; ?>
            });

            $("#color").spectrum({
                color: "#333639",
                preferredFormat: "hex",
                containerClassName: 'chatter-color-picker',
                cancelText: '',
                chooseText: 'close',
                move: function (color) {
                    $("#color").val(color.toHexString());
                }
            });

            <?php if(count($errors) > 0): ?>
            $('#new_discussion').slideDown();
            $('#title').focus();
            <?php endif; ?>


        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($path.'.layouts.app'.config('theme_layout'), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>