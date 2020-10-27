<?php $__env->startSection('title', trans('labels.frontend.offers.title').' | '.app_name()); ?>

<?php $__env->startPush('after-styles'); ?>
    <style>
        .coupon .kanan {
            display: grid;
            border-left: 1px dashed #ddd;
            width: 70% !important;
            position:relative;
        }

        .coupon .kanan .info::after, .coupon .kanan .info::before {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background: white;
            border-radius: 100%;
        }
        .coupon .kanan .info::before {
            top: -10px;
            left: -10px;
        }
        .coupon{
            background: #eeeff1;
        }

        .coupon .kanan .info::after {
            bottom: -10px;
            left: -10px;
        }
        .coupon .time {
            font-size: 1.6rem;
        }
        .icon-container_box{
            font-size: 50px;
        }

        @media  screen and (max-width: 768px){

            .coupon .kanan {
                border:none;
                width: 100% !important;
                position:relative;
            }
            .coupon{
                display: block!important;
                text-align: center;
            }
            .kiri{
                padding-bottom: 0px!important;
            }
            .tengah{
                padding: 10px!important;
            }
            .kanan .info{
                margin-top: 0px!important;
            }
            .coupon .kanan .info::after, .coupon .kanan .info::before {
                content: '';
                position: absolute;
                width: 20px;
                display: none;
                height: 20px;
                background: white;
                border-radius: 100%;
            }

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
                    <h2 class="breadcrumb-head black bold"><span><?php echo app('translator')->getFromJson('labels.frontend.offers.title'); ?></span></h2>
                </div>
            </div>
        </div>
    </section>
    <!-- End of breadcrumb section
        ============================================= -->
    <section id="about-page" class="about-page-section">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <?php if(count($coupons) > 0): ?>
                        <div class="row">
                            <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-12">
                                    <div class="coupon rounded mb-3 d-flex justify-content-between">
                                        <div class="kiri p-3">
                                            <div class="icon-container ">
                                                <div class="icon-container_box">
                                                    <i class="fa fa-gift" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tengah pl-3 py-3 d-flex w-100 align-self-center justify-content-start">
                                            <div class="d-block w-100">
                                                <h3 class="lead font-weight-bold"><?php echo e($coupon->name); ?> </h3>
                                                <p class="text-muted mb-0"><?php echo e($coupon->description); ?></p>
                                                <p class="mb-0"><?php echo app('translator')->getFromJson('labels.frontend.offers.usage'); ?> : <?php echo app('translator')->getFromJson('labels.frontend.offers.per_user'); ?> <?php echo e($coupon->per_user_limit); ?></p>
                                                <?php if($coupon->min_price && $coupon->min_price > 0): ?>
                                                <p class="mb-0"><?php echo app('translator')->getFromJson('labels.frontend.offers.minimum_order_amount'); ?> <?php echo e($coupon->min_price.''.$appCurrency['symbol']); ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="kanan d-grid">
                                            <div class="info m-3 d-flex text-center align-self-center">
                                                <div class="w-100">
                                                     <span class="badge badge-success"> <?php if($coupon->type == 1): ?>
                                                             <?php echo app('translator')->getFromJson('labels.backend.coupons.discount_rate'); ?>
                                                         <?php else: ?>
                                                             <?php echo app('translator')->getFromJson('labels.backend.coupons.flat_rate'); ?>}})
                                                         <?php endif; ?></span>
                                                    <div class="block">
                                                        <span><?php echo app('translator')->getFromJson('labels.frontend.offers.validity'); ?> :
                                                            <?php if($coupon->expires_at): ?>
                                                                <?php echo e((\Illuminate\Support\Carbon::parse($coupon->expires_at)->diff(\Illuminate\Support\Carbon::now())->days < 1) ? 'today' : \Illuminate\Support\Carbon::parse($coupon->expires_at)->diffInDays(\Illuminate\Support\Carbon::now())); ?> Days
                                                            <?php else: ?>
                                                                <?php echo app('translator')->getFromJson('labels.frontend.offers.unlimited'); ?>
                                                            <?php endif; ?>

                                                           </span>
                                                    </div>
                                                    <h4 class="text-bold"><?php echo e($coupon->code); ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <h2><?php echo app('translator')->getFromJson('labels.frontend.offers.no_offers'); ?></h2>
                    <?php endif; ?>
                </div>
                <?php echo $__env->make('frontend.layouts.partials.right-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app'.config('theme_layout'), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>