<section id="faq" class="faq-section <?php echo e(isset($classes) ? $classes : ''); ?>">
    <div class="container">
        <div class="section-title mb45 headline text-center ">
            <span class="subtitle text-uppercase"><?php echo e(env('APP_NAME')); ?> <?php echo app('translator')->getFromJson('labels.frontend.layouts.partials.faq'); ?></span>
            <h2><?php echo app('translator')->getFromJson('labels.frontend.layouts.partials.faq_full'); ?></h2>
        </div>
        <?php if(count($faqs)> 0): ?>

            <div class="faq-tab">
                <div class="faq-tab-ques ul-li">
                    <div class="tab-button text-center mb65 ">
                        <ul class="product-tab">
                            <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li rel="tab<?php echo e($faq->id); ?>"><?php echo e($faq->name); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <!-- /tab-head -->

                    <!-- tab content -->
                    <div class="tab-container">
                    <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <!-- 1st tab -->
                            <div id="tab<?php echo e($faq->id); ?>" class="tab-content-1 pt35">
                                <div class="row">
                                    <?php $__currentLoopData = $faq->faqs->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-6">
                                            <div class="ques-ans mb45 headline">
                                                <h3> <?php echo e($item->question); ?></h3>
                                                <p><?php echo e($item->answer); ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <!-- #tab1 -->
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                    <div class="view-all-btn bold-font <?php echo e(isset($classes) ? 'text-white' : ''); ?>">
                        <a href="<?php echo e(route('faqs')); ?>"><?php echo e(trans('labels.frontend.layouts.partials.more_faqs')); ?> <i class="fas fa-chevron-circle-right"></i></a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <h4><?php echo app('translator')->getFromJson('labels.general.no_data_available'); ?></h4>
        <?php endif; ?>
    </div>
</section>