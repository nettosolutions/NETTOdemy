<section id="best-course" class="best-course-section <?php echo e(isset($class) ? $class : ''); ?>">
    <div class="container">
        <div class="section-title mb45 headline text-center ">
            <span class="subtitle text-uppercase"><?php echo app('translator')->getFromJson('labels.frontend.layouts.partials.search_our_courses'); ?></span>
            <h2><?php echo app('translator')->getFromJson('labels.frontend.layouts.partials.browse_featured_course'); ?></h2>
        </div>
        <div class="best-course-area mb45">
            <div class="row">
                <?php if(count($featured_courses) > 0): ?>
                    <?php $__currentLoopData = $featured_courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-3">
                            <div class="best-course-pic-text relative-position ">
                                <div class="best-course-pic relative-position" <?php if($item->course_image != ""): ?>  style="background-image: url(<?php echo e(asset('storage/uploads/'.$item->course_image)); ?>)" <?php endif; ?>>

                                    <?php if($item->trending == 1): ?>
                                        <div class="trend-badge-2 text-center text-uppercase">
                                            <i class="fas fa-bolt"></i>
                                            <span><?php echo app('translator')->getFromJson('labels.frontend.badges.trending'); ?></span>
                                        </div>
                                    <?php endif; ?>
                                        <?php if($item->free == 1): ?>
                                            <div class="trend-badge-3 text-center text-uppercase">
                                                <i class="fas fa-bolt"></i>
                                                <span><?php echo app('translator')->getFromJson('labels.backend.courses.fields.free'); ?></span>
                                            </div>
                                        <?php endif; ?>
                                    <div class="course-price text-center gradient-bg">
                                        <?php if($item->free == 1): ?>
                                            <span> <?php echo e(trans('labels.backend.courses.fields.free')); ?></span>
                                        <?php else: ?>
                                            <span>   <?php echo e($appCurrency['symbol'].' '.$item->price); ?></span>
                                        <?php endif; ?>

                                    </div>
                                    <div class="course-rate ul-li">
                                        <ul>
                                            <?php for($i=1; $i<=(int)$item->rating; $i++): ?>
                                                <li><i class="fas fa-star"></i></li>
                                            <?php endfor; ?>
                                        </ul>
                                    </div>
                                    <div class="course-details-btn">
                                        <a class="text-uppercase" href="<?php echo e(route('courses.show', [$item->slug])); ?>"><?php echo app('translator')->getFromJson('labels.frontend.layouts.partials.course_detail'); ?> <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                    <div class="blakish-overlay"></div>
                                </div>
                                <div class="best-course-text">
                                    <div class="course-title mb20 headline relative-position">
                                        <h3>
                                            <a href="<?php echo e(route('courses.show', [$item->slug])); ?>"><?php echo e($item->title); ?></a>
                                        </h3>
                                    </div>
                                    <div class="course-meta">
                                            <span class="course-category"><a
                                                        href="<?php echo e(route('courses.category',['category'=>$item->category->slug])); ?>"><?php echo e($item->category->name); ?></a></span>
                                        <span class="course-author">
                                                <a href="#">
                                                    <?php echo e($item->students()->count()); ?>

                                                    <?php echo app('translator')->getFromJson('labels.frontend.layouts.partials.students'); ?></a>
                                            </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <h4 class="text-center"><?php echo app('translator')->getFromJson('labels.general.no_data_available'); ?></h4>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>
