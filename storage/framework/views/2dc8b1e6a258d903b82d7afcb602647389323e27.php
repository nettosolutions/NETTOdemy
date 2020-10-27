
<!-- Start popular course
       ============================================= -->
<?php if(count($popular_courses) > 0): ?>
    <section id="popular-course" class="popular-course-section <?php echo e(isset($class) ? $class : ''); ?>">
        <div class="container">
            <div class="section-title mb20 headline text-left ">
                <span class="subtitle text-uppercase"><?php echo app('translator')->getFromJson('labels.frontend.layouts.partials.learn_new_skills'); ?></span>
                <h2><?php echo app('translator')->getFromJson('labels.frontend.layouts.partials.popular_courses'); ?></h2>
            </div>
            <div id="course-slide-item" class="course-slide">
                <?php $__currentLoopData = $popular_courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="course-item-pic-text ">
                        <div class="course-pic relative-position mb25" <?php if($item->course_image != ""): ?>  style="background-image: url(<?php echo e(asset('storage/uploads/'.$item->course_image)); ?>)" <?php endif; ?>>

                            <div class="course-price text-center gradient-bg">
                                <?php if($item->free == 1): ?>
                                    <span> <?php echo e(trans('labels.backend.courses.fields.free')); ?></span>
                                <?php else: ?>
                                   <span>   <?php echo e($appCurrency['symbol'].' '.$item->price); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="course-details-btn">
                                <a class="text-uppercase" href="<?php echo e(route('courses.show', [$item->slug])); ?>"><?php echo app('translator')->getFromJson('labels.frontend.layouts.partials.course_detail'); ?> <i
                                            class="fas fa-arrow-right"></i></a>
                            </div>

                        </div>
                        <div class="course-item-text">
                            <div class="course-meta">
                                    <span class="course-category bold-font"><a
                                                href="<?php echo e(route('courses.category',['category'=>$item->category->slug])); ?>"><?php echo e($item->category->name); ?></a></span>
                                <span class="course-author bold-font">
                                <?php $__currentLoopData = $item->teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="#"><?php echo e($teacher->first_name); ?></a></span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <div class="course-rate ul-li">
                                    <ul>
                                        <?php for($i=1; $i<=(int)$item->rating; $i++): ?>
                                            <li><i class="fas fa-star"></i></li>
                                        <?php endfor; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="course-title mt10 headline pb45 relative-position">
                                <h3><a href="<?php echo e(route('courses.show', [$item->slug])); ?>"><?php echo e($item->title); ?></a>
                                    <?php if($item->trending == 1): ?>
                                        <span
                                                class="trend-badge text-uppercase bold-font"><i
                                                    class="fas fa-bolt"></i> <?php echo app('translator')->getFromJson('labels.frontend.badges.trending'); ?></span>
                                    <?php endif; ?>

                                </h3>
                            </div>
                            <div class="course-viewer ul-li">
                                <ul>
                                    <li><a href=""><i class="fas fa-user"></i> <?php echo e($item->students()->count()); ?>

                                        </a>
                                    </li>
                                    <li><a href=""><i class="fas fa-comment-dots"></i> <?php echo e(count($item->reviews)); ?></a></li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /item -->
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
    <!-- End popular course
        ============================================= -->
<?php endif; ?>