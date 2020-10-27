<?php $__env->startSection('content'); ?>

    <!-- Start of breadcrumb section
    
        ============================================= -->

    <section id="breadcrumb" class="breadcrumb-section relative-position backgroud-style">
        <div class="blakish-overlay"></div>
        <div class="container">
            <div class="page-breadcrumb-content text-center">
                <div class="page-breadcrumb-title">
                    <h2 class="breadcrumb-head black bold"><?php echo app('translator')->getFromJson('labels.frontend.faq.title'); ?></h2>
                </div>
            </div>
        </div>
    </section>
    <!-- End of breadcrumb section
    
        ============================================= -->


    <!-- Start FAQ section
    
        ============================================= -->

    <section id="faq-page" class="faq-page-section">
        <div class="container">
            <div class="faq-element">
                <div class="row">
                    <div class="col-md-12">
                        <div class="faq-page-tab">
                            <div class="section-title-2 mb65 headline text-left">
                                <h2><?php echo app('translator')->getFromJson('labels.frontend.faq.find'); ?></h2>
                            </div>
                            <?php if(count($faq_categories) > 0): ?>
                            <div class="faq-tab faq-secound-home-version mb35">
                                <div class="faq-tab-ques  ul-li">
                                    <div class="tab-button text-left mb45">
                                        <ul class="product-tab">
                                            <?php $__currentLoopData = $faq_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li rel="tab<?php echo e($categories->id); ?>"><?php echo e($categories->name); ?></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                    <!-- /tab-head -->

                                    <!-- tab content -->
                                    <div class="tab-container">

                                        <!-- 1st tab -->
                                        <?php $__currentLoopData = $faq_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div id="tab<?php echo e($category->id); ?>" class="tab-content-1 pt35">
                                            <div id="accordion" class="panel-group">
                                                <div class="row ml-0 mr-0">
                                                    <?php if(count($category->faqs) > 0): ?>
                                                        <?php $__currentLoopData = $category->faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="col-md-6">
                                                                <div class="panel">
                                                                    <div class="panel-title" id="heading<?php echo e($category->id.'-'.$item->id); ?>">
                                                                        <h3 class="mb-0">
                                                                            <button class="btn btn-link collapsed" data-toggle="collapse"
                                                                                    data-target="#collapse<?php echo e($category->id.'-'.$item->id); ?>"
                                                                                    aria-expanded="false"
                                                                                    aria-controls="collapse<?php echo e($category->id.'-'.$item->id); ?>">
                                                                               <?php echo e($item->question); ?>

                                                                            </button>
                                                                        </h3>
                                                                    </div>

                                                                    <div id="collapse<?php echo e($category->id.'-'.$item->id); ?>" class="collapse "
                                                                         aria-labelledby="heading<?php echo e($category->id.'-'.$item->id); ?>" data-parent="#accordion">
                                                                        <div class="panel-body">
                                                                            <?php echo e($item->answer); ?>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    <?php endif; ?>

                                                </div>
                                                <!-- end of #accordion -->
                                            </div>
                                        </div>
                                        <!-- #tab1 -->
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </div>
                                </div>
                            </div>
                            <?php else: ?>
                              <h3> <?php echo app('translator')->getFromJson('labels.general.no_data_available'); ?></h3>
                           <?php endif; ?>

                        </div>

                        <div class="about-btn">
                            <div class="genius-btn gradient-bg text-center text-uppercase ul-li-block bold-font">
                                <a href="<?php echo e(asset('forums')); ?>"><?php echo app('translator')->getFromJson('labels.frontend.faq.make_question'); ?> <i class="fas fa-caret-right"></i></a>
                            </div>
                            <div class="genius-btn gradient-bg text-center text-uppercase ul-li-block bold-font">
                                <a href="<?php echo e(route('contact')); ?>"><?php echo app('translator')->getFromJson('labels.frontend.faq.contact_us'); ?> <i class="fas fa-caret-right"></i></a>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-scripts'); ?>
    <script>
        $('ul.product-tab').find('li:first').addClass('active');
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.app'.config('theme_layout'), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>