<?php $__env->startSection('title', app_name() . ' | ' . __('labels.frontend.passwords.reset_password_box_title')); ?>

<?php $__env->startSection('content'); ?>
    <section id="breadcrumb" class="breadcrumb-section relative-position backgroud-style">
        <div class="blakish-overlay"></div>
        <div class="container">
            <div class="page-breadcrumb-content text-center">
                <div class="page-breadcrumb-title">
                    <h2 class="breadcrumb-head black bold"><?php echo e(__('labels.frontend.passwords.reset_password_box_title')); ?></h2>
                </div>
            </div>
        </div>
    </section>
    <section id="about-page" class="about-page-section pb-0">
        <div class="row justify-content-center align-items-center">
            <div class="col col-md-4 align-self-center">
                <div class="card border-0">

                    <div class="card-body">

                        <?php if(session('status')): ?>
                            <div class="alert alert-success">
                                <?php echo e(session('status')); ?>

                            </div>
                        <?php endif; ?>

                        <?php echo e(html()->form('POST', route('frontend.auth.password.email.post'))->open()); ?>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <?php echo e(html()->email('email')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.email'))
                                        ->attribute('maxlength', 191)
                                        ->required()
                                        ->autofocus()); ?>

                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-0 clearfix">
                                    <div class="text-center  text-capitalize">
                                        <button type="submit" class="nws-button btn-info btn "
                                                value="Submit"><?php echo e(__('labels.frontend.passwords.send_password_reset_link_button')); ?></button>
                                    </div>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->
                        <?php echo e(html()->form()->close()); ?>

                    </div><!-- card-body -->
                </div><!-- card -->
            </div><!-- col-6 -->
        </div><!-- row -->
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app'.config('theme_layout'), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>