<?php $__env->startSection('title', __('labels.backend.general_settings.newsletter.title').' | '.app_name()); ?>

<?php $__env->startPush('after-styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css')); ?>"/>

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/colors/switch.css')); ?>">
    <style>
        .color-list li {
            float: left;
            width: 8%;
        }

        .options {
            line-height: 35px;
        }

        .color-list li a {
            font-size: 20px;
        }

        .color-list li a.active {
            border: 4px solid grey;
        }

        .color-default {
            font-size: 18px !important;
            background: #101010;
            border-radius: 100%;
        }

        .form-control-label {
            line-height: 35px;
        }

        .switch.switch-3d {
            margin-bottom: 0px;
            vertical-align: middle;

        }

        .color-default i {
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .preview {
            background-color: #dcd8d8;
            background-image: url(https://www.transparenttextures.com/patterns/carbon-fibre-v2.png);
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo e(html()->form('POST', route('admin.general-settings'))->id('general-settings-form')->class('form-horizontal')->acceptsFiles()->open()); ?>


    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-5">
                    <h3 class="page-title d-inline"><?php echo app('translator')->getFromJson('labels.backend.general_settings.newsletter.title'); ?></h3>

                </div>
            </div>
        </div>

        <div class="card-body" id="newsletter">
            <h5><?php echo app('translator')->getFromJson('labels.backend.general_settings.mail_configuration_note',['link'=>'<a target="_blank" href="'.route('admin.general-settings',['tab'=>'email']).'">']); ?></h5>
            <div class="form-group row">
                <?php echo e(html()->label(__('labels.backend.general_settings.newsletter.mail_provider'))->class('col-md-2 form-control-label')->for('short_description')); ?>

                <div class="col-md-10">
                    <p class="d-inline" style="line-height: 35px">
                        <?php echo e(html()->label(html()->radio('mail_provider')->checked()
                                         ->class('switch-input status')->value('mailchimp')
                                   . '<span class="switch-label"></span><span class="switch-handle"></span>')
                               ->class('switch switch-sm switch-3d switch-primary')); ?>

                        <span class="ml-2"><?php echo e(__('labels.backend.general_settings.newsletter.mailchimp')); ?></span>
                    </p>

                    <p class="d-inline ml-4" style="line-height: 35px">
                        <?php echo e(html()->label(html()->radio('mail_provider')
                                       ->class('switch-input status')->value('sendgrid')
                                  . '<span class="switch-label"></span><span class="switch-handle"></span>')
                              ->class('switch switch-sm switch-3d switch-primary')); ?>

                        <span class="ml-2"><?php echo e(__('labels.backend.general_settings.newsletter.sendgrid')); ?></span>
                    </p>
                    <p class="font-italic"><?php echo __('labels.backend.general_settings.newsletter.mail_provider_note'); ?></p>
                </div>
            </div>
            <div class="mail-provider-wrapper mailchimp">
                <div class="form-group row">
                    <?php echo e(html()->label(__('labels.backend.general_settings.newsletter.api_key'))->class('col-md-2 form-control-label')->for('api.key')); ?>


                    <div class="col-md-10">
                        <?php echo e(html()->text('newsletter__apiKey')
                            ->id('api_key')
                            ->value(config('newsletter.apiKey'))
                            ->class('form-control')
                            ->placeholder('Ex. d814b5e4xxxxxxxxxxxxxxxxxcc27c-us17 ')); ?>

                        <span class="help-text font-italic mb-0"><?php echo __('labels.backend.general_settings.newsletter.api_key_note'); ?></span>
                        <span class="float-right font-italic font-weight-bold">
                            <a target="_blank"
                               href="https://mailchimp.com/help/about-api-keys/"><?php echo __('labels.backend.general_settings.newsletter.api_key_question'); ?></a> </span>
                    </div>
                </div>
                <div class="form-group row">
                    <?php echo e(html()->label(__('labels.backend.general_settings.newsletter.list_id'))->class('col-md-2 form-control-label')->for('newsletter.subscribers.id')); ?>

                    <div class="col-md-10">
                        <?php echo e(html()->text('newsletter__lists__subscribers__id')
                            ->id('list_id')
                            ->class('form-control')
                            ->value(config('newsletter.lists.subscribers.id'))
                            ->placeholder('Ex. d81dasdw17 ')); ?>

                        <span class="help-text font-italic mb-0"><?php echo __('labels.backend.general_settings.newsletter.list_id_note'); ?></span>
                        <span class="float-right font-italic font-weight-bold">
                            <a target="_blank"
                               href="https://mailchimp.com/help/find-your-list-id/"><?php echo __('labels.backend.general_settings.newsletter.list_id_question'); ?></a> </span>
                    </div>
                </div>
                <div class="form-group row">
                    <?php echo e(html()->label(__('labels.backend.general_settings.newsletter.double_opt_in'))->class('col-md-2 form-control-label')->for('short_description')); ?>

                    <div class="col-md-10">
                        <p class="d-inline" style="line-height: 35px">
                            <?php echo e(html()->label(html()->checkbox('mailchimp_double_opt_in')
                                             ->class('switch-input status')->value(0)
                                       . '<span class="switch-label"></span><span class="switch-handle"></span>')
                                   ->class('switch switch-sm switch-3d switch-primary')); ?>

                        </p>
                        <p class="font-italic"><?php echo __('labels.backend.general_settings.newsletter.double_opt_in_note'); ?></p>
                    </div>
                </div>
            </div>
            <div class="mail-provider-wrapper sendgrid d-none ">
                <div class="form-group row">
                    <?php echo e(html()->label(__('labels.backend.general_settings.newsletter.api_key'))->class('col-md-2 form-control-label')->for('api.key')); ?>


                    <div class="col-md-8">
                        <?php echo e(html()->text('sendgrid_api_key')
                            ->id('sendgrid_api_key')
                            ->value(config('sendgrid_api_key'))
                            ->class('form-control')
                            ->placeholder('Ex. d814b5e4xxxxxxxxxxxxxxxxxcc27c-us17 ')); ?>

                        <p class="help-text sendgrid-error mb-0 text-danger"></p>
                        <span class="help-text font-italic mb-0"><?php echo __('labels.backend.general_settings.newsletter.api_key_note_sendgrid'); ?></span>
                        <span class="float-right font-italic font-weight-bold">
                            <a target="_blank"
                               href="https://app.sendgrid.com/settings/api_keys"><?php echo __('labels.backend.general_settings.newsletter.api_key_question'); ?></a> </span>
                    </div>
                    <div class="col-md-2">
                        <button type="button" id="getLists"
                                class="btn btn-primary"><?php echo e(__('labels.backend.general_settings.newsletter.get_lists')); ?></button>
                    </div>
                </div>
                <div class="form-group sendgrid-list-wrapper d-none row">
                    <?php echo e(html()->label(__('labels.backend.general_settings.newsletter.sendgrid_lists'))->class('col-md-2 form-control-label')->for('')); ?>


                    <div class="col-md-5">
                        <?php echo e(html()->label(html()->radio('list_selection')->checked()
                                             ->class('switch-input status sendgrid-radio')->value(1)
                                       . '<span class="switch-label"></span><span class="switch-handle"></span>')
                                   ->class('switch switch-sm mb-2 switch-3d  switch-primary')); ?> <span
                                class="ml-2"><?php echo e(__('labels.backend.general_settings.newsletter.select_list')); ?></span>
                        <span
                                class="float-right"><a class="font-italic font-weight-bold" target="_blank" href="https://sendgrid.com/marketing_campaigns/ui/contacts"><?php echo e(__('labels.backend.general_settings.newsletter.manage_lists')); ?></a></span>

                        <?php echo e(html()->select('sendgrid_list',['' => 'Select List'])
                            ->id('sendgrid_list')
                            ->class('form-control sendgrid-element')); ?>

                    </div>
                    <div class="col-md-5">
                        <?php echo e(html()->label(html()->radio('list_selection')
                                             ->class('switch-input status sendgrid-radio')->value(2)
                                       . '<span class="switch-label"></span><span class="switch-handle"></span>')
                                   ->class('switch switch-sm mb-2 switch-3d  switch-primary')); ?> <span
                                class="ml-2"><?php echo e(__('labels.backend.general_settings.newsletter.create_new')); ?></span>

                        <?php echo e(html()->text('list_name')
                             ->id('list_name')
                             ->class('form-control sendgrid-element d-none')
                             ->placeholder('Ex. LMS List ')); ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer clearfix">
            <div class="row">
                <div class="col">
                    <?php echo e(form_cancel(route('admin.general-settings'), __('buttons.general.cancel'))); ?>

                </div><!--col-->
                <div class="col text-right">
                    <?php echo e(form_submit(__('buttons.general.crud.update'))->id('submit')); ?>

                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div>
    <?php echo e(html()->form()->close()); ?>


<?php $__env->stopSection(); ?>


<?php $__env->startPush('after-scripts'); ?>
    <script>
        $(document).ready(function () {
            <?php if(config('mail_provider') != ""): ?>
            var provider = "<?php echo e(config('mail_provider')); ?>";
            $('input[type="radio"][value="' + provider + '"]').attr('checked', true);
            <?php endif; ?>

            <?php if(config('mail_provider') == "sendgrid"): ?>
            $('.mailchimp').addClass('d-none')
            $('.sendgrid').removeClass('d-none')
            if ($('#sendgrid_api_key').val() != "") {
                getSendGridList();
            }

            <?php endif; ?>


            <?php if(config('mailchimp_double_opt_in') != ""): ?>
            var opt_in = ("<?php echo e(config('mailchimp_double_opt_in')); ?>" == 1)
            $('#mailchimp_double_opt_in').attr('checked', opt_in).val(1);
            <?php endif; ?>

            $(document).on('change', '#mail_provider', function () {
                if ($(this).is(':checked') == true) {
                    if ($(this).val() == 'mailchimp') {
                        $('.mailchimp').removeClass('d-none')
                        $('.sendgrid').addClass('d-none')
                    } else {
                        $('.mailchimp').addClass('d-none')
                        $('.sendgrid').removeClass('d-none')
                        getSendGridList()
                    }
                }
            })

            $(document).on('click', '#getLists', function () {
                if ($('#sendgrid_api_key').val() == "") {
                    $('.sendgrid-error').text('Please input API key');
                } else {
                    getSendGridList();
                }
            })

            $(document).on('click', '.sendgrid-radio', function () {
                $('.sendgrid-element').addClass('d-none')
                if ($(this).is(':checked')) {
                    if($(this).val() == 2){
                        $(this).parents('.switch').siblings('.sendgrid-element').removeClass('d-none').attr('required',true);
                    }else{
                        $(this).parents('.switch').siblings('.sendgrid-element').removeClass('d-none')
                    }

                }
            })
        });

        function getSendGridList() {
            var apiKey = $('#sendgrid_api_key').val();
            $('.sendgrid-error').empty();
            $.ajax({
                url: '<?php echo e(route('admin.newsletter.getSendGridLists')); ?>',
                type: 'POST',
                dataType: 'JSON',
                data: {'apiKey': apiKey, _token: '<?php echo e(csrf_token()); ?>'},
                success: function (response) {
                    if(response.status == 'success'){
                        $('#sendgrid_list').empty();
                        $(JSON.parse(response.body).lists).each(function (key, object) {
                            $('#sendgrid_list').append($("<option/>", {
                                value: object.id,
                                text: object.name
                            }));
                        });
                        <?php if(config('sendgrid_list') != ""): ?>
                                var value = "<?php echo e(config('sendgrid_list')); ?>";

                        $('#sendgrid_list').find('option[value="'+value+'"]').attr('selected',true)
                        <?php endif; ?>
                        $('.sendgrid-list-wrapper').removeClass('d-none')
                    }else{
                        $('.sendgrid-list-wrapper').addClass('d-none');
                        $('.sendgrid-error').text(response.message);
                    }

                }
            })

        }


    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>