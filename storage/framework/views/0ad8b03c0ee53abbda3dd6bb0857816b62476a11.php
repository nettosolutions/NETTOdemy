<?php $__env->startSection('title', 'Contact | '.app_name()); ?>
<?php $__env->startSection('meta_description', ''); ?>
<?php $__env->startSection('meta_keywords',''); ?>

<?php $__env->startPush('after-styles'); ?>
    <style>
        .my-alert{
            position: absolute;
            z-index: 10;
            left: 0;
            right: 0;
            top: 25%;
            width: 50%;
            margin: auto;
            display: inline-block;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php
        $footer_data = json_decode(config('footer_data'));
    ?>
    <?php if(session()->has('alert')): ?>
        <div class="alert alert-light alert-dismissible fade my-alert show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong><?php echo e(session('alert')); ?></strong>
        </div>
    <?php endif; ?>

    <!-- Start of breadcrumb section
        ============================================= -->
    <section id="breadcrumb" class="breadcrumb-section relative-position backgroud-style">
        <div class="blakish-overlay"></div>
        <div class="container">
            <div class="page-breadcrumb-content text-center">
                <div class="page-breadcrumb-title">
                    <h2 class="breadcrumb-head black bold"><?php echo e(env('APP_NAME')); ?> <span> <?php echo app('translator')->getFromJson('labels.frontend.contact.title'); ?></span></h2>
                </div>
            </div>
        </div>
    </section>
    <!-- End of breadcrumb section
        ============================================= -->


    <!-- Start of contact section
        ============================================= -->
    <section id="contact-page" class="contact-page-section">
        <div class="container">
            <div class="section-title mb45 headline text-center">
                <h2><?php echo app('translator')->getFromJson('labels.frontend.contact.keep_in_touch'); ?></h2>
            </div>
            <?php if(($footer_data->social_links->status == 1) && (count($footer_data->social_links->links) > 0)): ?>
                <div class="social-contact text-center d-inline-block w-100">
                    <?php $__currentLoopData = $footer_data->social_links->links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="category-icon-title text-center">
                        <a href="<?php echo e($item->link); ?>" target="_blank">
                            <div class="category-icon">
                                <i class="text-gradiant <?php echo e($item->icon); ?>"></i>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <!-- End of contact section
        ============================================= -->

    <!-- Start of contact area form
        ============================================= -->
    <section id="contact-form" class="contact-form-area_3 contact-page-version">
        <div class="container">
            <div class="section-title mb45 headline text-center">
                <h2><?php echo app('translator')->getFromJson('labels.frontend.contact.send_us_a_message'); ?></h2>
            </div>

            <div class="contact_third_form">
                <form class="contact_form" action="<?php echo e(route('contact.send')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="contact-info">
                                <input class="name" name="name" type="text" placeholder="<?php echo app('translator')->getFromJson('labels.frontend.contact.your_name'); ?>">
                                <?php if($errors->has('name')): ?>
                                    <span class="help-block text-danger"><?php echo e($errors->first('name')); ?></span>
                                <?php endif; ?>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="contact-info">
                                <input class="email" name="email" type="email" placeholder="<?php echo app('translator')->getFromJson('labels.frontend.contact.your_email'); ?>">
                                <?php if($errors->has('email')): ?>
                                    <span class="help-block text-danger"><?php echo e($errors->first('email')); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="contact-info">
                                <input class="number" name="phone" type="number" placeholder="<?php echo app('translator')->getFromJson('labels.frontend.contact.phone_number'); ?>">
                                <?php if($errors->has('phone')): ?>
                                    <span class="help-block text-danger"><?php echo e($errors->first('phone')); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <textarea name="message" placeholder="<?php echo app('translator')->getFromJson('labels.frontend.contact.message'); ?>"></textarea>
                    <?php if($errors->has('message')): ?>
                        <span class="help-block text-danger"><?php echo e($errors->first('message')); ?></span>
                    <?php endif; ?>
                    <div class="nws-button text-center  gradient-bg text-uppercase">
                        <button class="text-uppercase" type="submit" value="Submit"><?php echo app('translator')->getFromJson('labels.frontend.contact.send_email'); ?> <i class="fas fa-caret-right"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- End of contact area form
        ============================================= -->


    <!-- Start of contact area
        ============================================= -->
    <?php echo $__env->make('frontend.layouts.partials.contact_area', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!-- End of contact area
        ============================================= -->


<?php $__env->stopSection(); ?>    
<?php echo $__env->make('frontend.layouts.app'.config('theme_layout'), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>