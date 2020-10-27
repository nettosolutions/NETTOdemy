<div class="col-md-3">
    <div class="side-bar">


        <?php if($recent_news->count() > 0): ?>
            <div class="side-bar-widget first-widget">
                <h2 class="widget-title text-capitalize"><?php echo app('translator')->getFromJson('labels.frontend.layouts.partials.recent_news'); ?></h2>
                <div class="latest-news-posts">
                    <?php $__currentLoopData = $recent_news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="latest-news-area">

                            <?php if($item->image != ""): ?>
                                <div class="latest-news-thumbnile relative-position"
                                     style="background-image: url(<?php echo e(asset('storage/uploads/'.$item->image)); ?>)">
                                    <div class="blakish-overlay"></div>
                                </div>
                            <?php endif; ?>
                            <div class="date-meta">
                                <i class="fas fa-calendar-alt"></i> <?php echo e($item->created_at->format('d M Y')); ?>

                            </div>
                            <h3 class="latest-title bold-font"><a href="<?php echo e(route('blogs.index',['slug'=>$item->slug.'-'.$item->id])); ?>"><?php echo e($item->title); ?></a></h3>
                        </div>
                        <!-- /post -->
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                    <div class="view-all-btn bold-font">
                        <a href="<?php echo e(route('blogs.index')); ?>"><?php echo app('translator')->getFromJson('labels.frontend.layouts.partials.view_all_news'); ?> <i class="fas fa-chevron-circle-right"></i></a>
                    </div>
                </div>
            </div>

        <?php endif; ?>


        <?php if($global_featured_course != ""): ?>
            <div class="side-bar-widget">
                <h2 class="widget-title text-capitalize"><?php echo app('translator')->getFromJson('labels.frontend.layouts.partials.featured_course'); ?></h2>
                <div class="featured-course">
                    <div class="best-course-pic-text relative-position pt-0">
                        <div class="best-course-pic relative-position " style="background-image: url(<?php echo e(asset('storage/uploads/'.$global_featured_course->course_image)); ?>)">

                            <?php if($global_featured_course->trending == 1): ?>
                                <div class="trend-badge-2 text-center text-uppercase">
                                    <i class="fas fa-bolt"></i>
                                    <span><?php echo app('translator')->getFromJson('labels.frontend.badges.trending'); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="best-course-text" style="left: 0;right: 0;">
                            <div class="course-title mb20 headline relative-position">
                                <h3><a href="<?php echo e(route('courses.show', [$global_featured_course->slug])); ?>"><?php echo e($global_featured_course->title); ?></a></h3>
                            </div>
                            <div class="course-meta">
                                <span class="course-category"><a href="<?php echo e(route('courses.category',['category'=>$global_featured_course->category->slug])); ?>"><?php echo e($global_featured_course->category->name); ?></a></span>
                                <span class="course-author"><?php echo e($global_featured_course->students()->count()); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>