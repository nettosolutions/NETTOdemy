<?php $__env->startSection('title', ($page->meta_title) ? $page->meta_title : app_name()); ?>
<?php $__env->startSection('meta_description', ($page->meta_description) ? $page->meta_description :'' ); ?>
<?php $__env->startSection('meta_keywords', ($page->meta_keywords) ? $page->meta_keywords : app_name()); ?>

<?php $__env->startPush('after-styles'); ?>
    <style>
        .content img {
            margin: 10px;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <!-- Start of breadcrumb section
        ============================================= -->
    <section id="breadcrumb" class="breadcrumb-section relative-position backgroud-style">
        <div class="blakish-overlay"></div>
        <div class="container">
            <div class="page-breadcrumb-content text-center">
                <div class="page-breadcrumb-title">
                    <h2 class="breadcrumb-head black bold"><?php echo e(env('APP_NAME')); ?> <span><?php echo e($page->title); ?></span></h2>
                </div>
            </div>
        </div>
    </section>
    <!-- End of breadcrumb section
        ============================================= -->

    <section id="about-page" class="about-page-section">
        <div class="container">
            <div class="row">
                <div class="<?php if($page->sidebar == 1): ?> col-md-9 <?php else: ?> col-md-12 <?php endif; ?> ">
                    <div class="about-us-content-item">
                        <?php if($page->image != ""): ?>
                        <div class="about-gallery w-100 text-center">
                            <div class="about-gallery-img d-inline-block float-none">
                                <img src="<?php echo e(asset('storage/uploads/'.$page->image)); ?>" alt="">
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- /gallery -->

                        <div class="about-text-item">
                            <div class="section-title-2  headline text-left">
                                <h2><?php echo e($page->title); ?></h2>
                            </div>
                           <?php echo $page->content; ?>

                        </div>
                        <!-- /about-text -->
                    </div>
                </div>
                <?php if($page->sidebar == 1): ?>
                    <?php echo $__env->make('frontend.layouts.partials.right-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app'.config('theme_layout'), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>