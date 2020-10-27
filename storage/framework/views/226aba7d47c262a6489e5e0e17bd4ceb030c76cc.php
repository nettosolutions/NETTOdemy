<?php $__env->startSection('title', 'Certificate Verification | '.app_name()); ?>
<?php $__env->startSection('meta_description', ''); ?>
<?php $__env->startSection('meta_keywords',''); ?>

<?php $__env->startPush('after-styles'); ?>
    <style>
        .my-alert {
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
                    <h2 class="breadcrumb-head black bold"><?php echo e(env('APP_NAME')); ?>

                        <span> <?php echo app('translator')->getFromJson('labels.frontend.certificate_verification.title'); ?></span></h2>
                </div>
            </div>
        </div>
    </section>
    <!-- End of breadcrumb section
        ============================================= -->



    <!-- Start of contact area form
        ============================================= -->
    <section id="contact-form" class="contact-form-area_3 contact-page-version">
        <div class="container">
            <?php echo $__env->make('includes.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <div class="row">
                <div class="col-md-6 mx-auto col-12">
                    <div class="contact_third_form" style="padding-bottom: 30px">
                        <form class="contact_form" action="<?php echo e(route('frontend.certificates.verify')); ?>" method="POST"
                              enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="contact-info">
                                        <input class="name" value="<?php echo e((session('data')['name']) ? session('data')['name'] : old('name')); ?>" name="name" type="text"
                                               placeholder="<?php echo app('translator')->getFromJson('labels.frontend.certificate_verification.name_on_certificate'); ?>">
                                        <?php if($errors->has('name')): ?>
                                            <span class="help-block text-danger"><?php echo e($errors->first('name')); ?></span>
                                        <?php endif; ?>
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <div class="contact-info">
                                        <input class="date" value="<?php echo e((session('data')['date']) ? session('data')['date'] : old('date')); ?>" name="date"
                                               pattern="\d{4}-\d{2}-\d{2}" type="text"
                                               placeholder="<?php echo app('translator')->getFromJson('labels.frontend.certificate_verification.date_on_certificate'); ?>">
                                        <?php if($errors->has('date')): ?>
                                            <span class="help-block text-danger"><?php echo e($errors->first('date')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            </div>

                            <div class="nws-button mt-5 text-center  gradient-bg text-uppercase">
                                <button class="text-uppercase" type="submit"
                                        value="Submit"><?php echo app('translator')->getFromJson('labels.frontend.certificate_verification.verify_now'); ?> <i
                                            class="fas fa-caret-right"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php if(session()->has('data')): ?>

                    <div class="col-md-10 col-12 mx-auto mt-4">
                        <div class="card">
                            <div class="card-body">
                                <?php if(count(session('data')['certificates']) > 0): ?>
                                    <div class="table-responsive">

                                    <table class="table">
                                        <tr class="bg-dark text-white">
                                            <th>Course Name</th>
                                            <th>Student Name</th>
                                            <th>Certified at</th>
                                            <th>Actions</th>
                                        </tr>
                                        <?php $__currentLoopData = session('data')['certificates']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $certificate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($certificate->course->title); ?></td>
                                                <td><?php echo e($certificate->user->name); ?></td>
                                                <td><?php echo e($certificate->created_at->format('d M, Y')); ?></td>
                                                <td><a href="<?php echo e(asset('storage/certificates/'.$certificate->url)); ?>"
                                                       class="btn btn-success text-white">
                                                        <?php echo app('translator')->getFromJson('labels.backend.certificates.view'); ?> </a>

                                                    <a class="btn btn-primary text-white"
                                                       href="<?php echo e(route('certificates.download',['certificate_id'=>$certificate->id])); ?>">
                                                        <?php echo app('translator')->getFromJson('labels.backend.certificates.download'); ?> </a></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </table>
                                    </div>
                                <?php else: ?>
                                    <h4 class="text-center"><?php echo app('translator')->getFromJson('labels.frontend.certificate_verification.not_found'); ?></h4>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <!-- End of contact area form
        ============================================= -->
<?php $__env->stopSection(); ?>    
<?php echo $__env->make('frontend.layouts.app'.config('theme_layout'), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>