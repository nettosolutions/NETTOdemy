<?php $__env->startSection('title', __('labels.backend.social_settings.management').' | '.app_name()); ?>

<?php $__env->startSection('content'); ?>
    <?php echo e(html()->form('POST', route('admin.social-settings'))->class('form-horizontal')->open()); ?>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        <?php echo e(__('labels.backend.social_settings.management')); ?>

                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr/>

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        <?php echo e(html()->label(__('validation.attributes.backend.settings.social_settings.facebook.label'))->class('col-md-2 form-control-label')->for('services.facebook.active')); ?>

                        <div class="col-md-10">
                            <div class="checkbox">
                                <?php echo e(html()->label(
                                        html()->checkbox('services__facebook__active', config('services.facebook.active') ? true : false,1)
                                              ->class('switch-input')->value(1)
                                        . '<span class="switch-label"></span><span class="switch-handle"></span>')

                                    ->class('switch switch-sm switch-3d switch-primary')); ?>

                                <a class="float-right font-weight-bold font-italic" target="_blank" href="https://developers.facebook.com/apps/"><?php echo e(__('labels.backend.social_settings.fb_api_note')); ?></a>
                            </div>
                            <small><i> <?php echo e(__('labels.backend.social_settings.fb_note')); ?></i></small>
                            <div class="switch-content <?php if(config('services.facebook.active') == 0 || config('services.facebook.active') == false): ?> d-none <?php endif; ?>">
                                <br>
                                <div class="form-group row">
                                    <?php echo e(html()->label(__('validation.attributes.backend.settings.social_settings.facebook.client_id'))->class('col-md-2 form-control-label')->for('servicesfacebook.client_id')); ?>

                                    <div class="col-md-6 col-xs-12">
                                        <?php echo e(html()->text('services__facebook__client_id')
                                             ->class('form-control')
                                             ->value(config('services.facebook.client_id'))); ?>

                                    </div><!--col-->
                                </div><!--form-group-->

                                <div class="form-group row">
                                    <?php echo e(html()->label(__('validation.attributes.backend.settings.social_settings.facebook.client_secret'))->class('col-md-2 form-control-label')->for('services.facebook.client_secret')); ?>

                                    <div class="col-md-6 col-xs-12">
                                        <?php echo e(html()->text('services__facebook__client_secret')
                                             ->class('form-control')
                                             ->value(config('services.facebook.client_secret'))); ?>

                                    </div><!--col-->
                                </div><!--form-group-->

                                <div class="form-group row">
                                    <?php echo e(html()->label(__('validation.attributes.backend.settings.social_settings.facebook.redirect'))->class('col-md-2 form-control-label')->for('services.facebook.redirect')); ?>

                                    <div class="col-md-6 col-xs-12">
                                        <?php echo e(html()->text('services__facebook__redirect')
                                             ->class('form-control')
                                             ->attribute('disabled')
                                             ->value(config('services.facebook.redirect'))); ?>

                                    </div><!--col-->
                                </div><!--form-group-->
                            </div>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <?php echo e(html()->label(__('validation.attributes.backend.settings.social_settings.google.label'))->class('col-md-2 form-control-label')->for('services.google.active')); ?>

                        <div class="col-md-10">
                            <div class="checkbox">
                                <?php echo e(html()->label(
                                        html()->checkbox('services__google__active', config('services.google.active') ? true : false,1)
                                              ->class('switch-input')->value(1)
                                        . '<span class="switch-label"></span><span class="switch-handle"></span>')

                                    ->class('switch switch-sm switch-3d switch-primary')); ?>

                                <a class="float-right font-weight-bold font-italic" target="_blank" href="https://console.developers.google.com/apis"><?php echo e(__('labels.backend.social_settings.google_api_note')); ?></a>
                            </div>
                            <small><i> <?php echo e(__('labels.backend.social_settings.google_note')); ?></i></small>
                            <div class="switch-content <?php if(config('services.google.active') == 0 || config('services.google.active') == false): ?> d-none <?php endif; ?>">
                                <br>
                                <div class="form-group row">
                                    <?php echo e(html()->label(__('validation.attributes.backend.settings.social_settings.google.client_id'))->class('col-md-2 form-control-label')->for('services.google.client_id')); ?>

                                    <div class="col-md-6 col-xs-12">
                                        <?php echo e(html()->text('services__google__client_id')
                                             ->class('form-control')
                                             ->value(config('services.google.client_id'))); ?>

                                    </div><!--col-->
                                </div><!--form-group-->

                                <div class="form-group row">
                                    <?php echo e(html()->label(__('validation.attributes.backend.settings.social_settings.google.client_secret'))->class('col-md-2 form-control-label')->for('services.google.client_secret')); ?>

                                    <div class="col-md-6 col-xs-12">
                                        <?php echo e(html()->text('services__google__client_secret')
                                             ->class('form-control')
                                             ->value(config('services.google.client_secret'))); ?>

                                    </div><!--col-->
                                </div><!--form-group-->

                                <div class="form-group row">
                                    <?php echo e(html()->label(__('validation.attributes.backend.settings.social_settings.google.redirect'))->class('col-md-2 form-control-label')->for('services.google.redirect')); ?>

                                    <div class="col-md-6 col-xs-12">
                                        <?php echo e(html()->text('services__google__redirect')
                                             ->class('form-control')
                                             ->attribute('disabled')
                                             ->value(config('services.google.redirect'))); ?>

                                    </div><!--col-->
                                </div><!--form-group-->
                            </div>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <?php echo e(html()->label(__('validation.attributes.backend.settings.social_settings.twitter.label'))->class('col-md-2 form-control-label')->for('services.twitter.active')); ?>

                        <div class="col-md-10">
                            <div class="checkbox">
                                <?php echo e(html()->label(
                                        html()->checkbox('services__twitter__active', config('services.twitter.active') ? true : false,1)
                                              ->class('switch-input')->value(1)
                                        . '<span class="switch-label"></span><span class="switch-handle"></span>')

                                    ->class('switch switch-sm switch-3d switch-primary')); ?>

                                <a class="float-right font-weight-bold font-italic" target="_blank" href="https://developer.twitter.com/en/apps"><?php echo e(__('labels.backend.social_settings.twitter_api_note')); ?></a>

                            </div>
                            <small><i><?php echo e(__('labels.backend.social_settings.twitter_note')); ?></i></small>
                            <div class="switch-content <?php if(config('services.twitter.active') == 0 || config('services.twitter.active') == false): ?> d-none <?php endif; ?>">
                                <br>
                                <div class="form-group row">
                                    <?php echo e(html()->label(__('validation.attributes.backend.settings.social_settings.twitter.client_id'))->class('col-md-2 form-control-label')->for('services.twitter.client_id')); ?>

                                    <div class="col-md-6 col-xs-12">
                                        <?php echo e(html()->text('services__twitter__client_id')
                                             ->class('form-control')
                                             ->value(config('services.twitter.client_id'))); ?>

                                    </div><!--col-->
                                </div><!--form-group-->

                                <div class="form-group row">
                                    <?php echo e(html()->label(__('validation.attributes.backend.settings.social_settings.twitter.client_secret'))->class('col-md-2 form-control-label')->for('services.twitter.client_secret')); ?>

                                    <div class="col-md-6 col-xs-12">
                                        <?php echo e(html()->text('services__twitter__client_secret')
                                             ->class('form-control')
                                             ->value(config('services.twitter.client_secret'))); ?>

                                    </div><!--col-->
                                </div><!--form-group-->

                                <div class="form-group row">
                                    <?php echo e(html()->label(__('validation.attributes.backend.settings.social_settings.twitter.redirect'))->class('col-md-2 form-control-label')->for('services.twitter.redirect')); ?>

                                    <div class="col-md-6 col-xs-12">
                                        <?php echo e(html()->text('services__twitter__redirect')
                                             ->class('form-control')
                                             ->attribute('disabled')
                                             ->value(config('services.twitter.redirect'))); ?>

                                    </div><!--col-->
                                </div><!--form-group-->
                            </div>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <?php echo e(html()->label(__('validation.attributes.backend.settings.social_settings.linkedin.label'))->class('col-md-2 form-control-label')->for('services.linkedin.active')); ?>

                        <div class="col-md-10">
                            <div class="checkbox">
                                <?php echo e(html()->label(
                                        html()->checkbox('services__linkedin__active', config('services.linkedin.active') ? true : false,1)
                                              ->class('switch-input')->value(1)
                                        . '<span class="switch-label"></span><span class="switch-handle"></span>')

                                    ->class('switch switch-sm switch-3d switch-primary')); ?>

                                <a class="float-right font-weight-bold font-italic" target="_blank" href="https://www.linkedin.com/developers/apps"><?php echo e(__('labels.backend.social_settings.linkedin_api_note')); ?></a>
                            </div>
                            <small><i><?php echo e(__('labels.backend.social_settings.linkedin_note')); ?></i></small>
                            <div class="switch-content <?php if(config('services.linkedin.active') == 0 || config('services.linkedin.active') == false): ?> d-none <?php endif; ?>">
                                <br>
                                <div class="form-group row">
                                    <?php echo e(html()->label(__('validation.attributes.backend.settings.social_settings.linkedin.client_id'))->class('col-md-2 form-control-label')->for('services.linkedin.client_id')); ?>

                                    <div class="col-md-6 col-xs-12">
                                        <?php echo e(html()->text('services__linkedin__client_id')
                                             ->class('form-control')
                                             ->value(config('services.linkedin.client_id'))); ?>

                                    </div><!--col-->
                                </div><!--form-group-->

                                <div class="form-group row">
                                    <?php echo e(html()->label(__('validation.attributes.backend.settings.social_settings.linkedin.client_secret'))->class('col-md-2 form-control-label')->for('services.linkedin.client_secret')); ?>

                                    <div class="col-md-6 col-xs-12">
                                        <?php echo e(html()->text('services__linkedin__client_secret')
                                             ->class('form-control')
                                             ->value(config('services.linkedin.client_secret'))); ?>

                                    </div><!--col-->
                                </div><!--form-group-->

                                <div class="form-group row">
                                    <?php echo e(html()->label(__('validation.attributes.backend.settings.social_settings.linkedin.redirect'))->class('col-md-2 form-control-label')->for('services.linkedin.redirect')); ?>

                                    <div class="col-md-6 col-xs-12">
                                        <?php echo e(html()->text('services__linkedin__redirect')
                                             ->class('form-control')
                                             ->attribute('disabled')
                                             ->value(config('services.linkedin.redirect'))); ?>

                                    </div><!--col-->
                                </div><!--form-group-->
                            </div>
                        </div><!--col-->
                    </div><!--form-group-->

                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer clearfix">
            <div class="row">
                <div class="col">
                    <?php echo e(form_cancel(route('admin.social-settings'), __('buttons.general.cancel'))); ?>

                </div><!--col-->

                <div class="col text-right">
                    <?php echo e(form_submit(__('buttons.general.crud.update'))); ?>

                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
    <?php echo e(html()->form()->close()); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('after-scripts'); ?>
    <script>
        $(document).ready(function () {
            $(document).on('click', '.switch-input', function (e) {
//              e.preventDefault();
              var content = $(this).parents('.checkbox').siblings('.switch-content');
                if (content.hasClass('d-none')) {
                    $(this).attr('checked', 'checked');
                    content.find('input').attr('required', true);
                    content.removeClass('d-none');
                } else {
                    content.addClass('d-none');
                    content.find('input').attr('required', false);
                }
            })
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>