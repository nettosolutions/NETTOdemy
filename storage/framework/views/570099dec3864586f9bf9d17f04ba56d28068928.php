<div class="col-md-3">
    <div class="side-bar">
        <div class="side-bar-search">
            <form action="<?php echo e(route('blogs.search')); ?>" method="get">
                <input type="text" class="" name="q" placeholder="<?php echo app('translator')->getFromJson('labels.frontend.blog.search_blog'); ?>">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <?php if($categories != ""): ?>
        <div class="side-bar-widget">
            <h2 class="widget-title text-capitalize"><?php echo app('translator')->getFromJson('labels.frontend.blog.blog_categories'); ?></h2>
            <div class="post-categori ul-li-block">
                <ul>
                    <?php if(count($categories) > 0): ?>

                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="cat-item <?php if(isset($category) && ($item->slug == $category->slug)): ?>  active <?php endif; ?> "><a href="<?php echo e(route('blogs.category',[
                                                'category' => $item->slug])); ?>"><?php echo e($item->name); ?></a></li>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <?php endif; ?>



        <?php if(count($popular_tags) > 0): ?>
            <div class="side-bar-widget">
                <h2 class="widget-title text-capitalize"><?php echo app('translator')->getFromJson('labels.frontend.blog.popular_tags'); ?></h2>
                <div class="tag-clouds ul-li">
                    <ul>
                        <?php $__currentLoopData = $popular_tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <li <?php if(isset($tag) && ($item->slug == $tag->slug)): ?>  class="active" <?php endif; ?> ><a href="<?php echo e(route('blogs.tag',['tag'=>$item->slug])); ?>"><?php echo e($item->name); ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>


        <?php if($global_featured_course != ""): ?>
            <div class="side-bar-widget">
                <h2 class="widget-title text-capitalize"><?php echo app('translator')->getFromJson('labels.frontend.blog.featured_course'); ?></h2>
                <div class="featured-course">
                    <div class="best-course-pic-text relative-position pt-0">
                        <div class="best-course-pic relative-position " <?php if($global_featured_course->course_image != ""): ?> style="background-image: url(<?php echo e(asset('storage/uploads/'.$global_featured_course->course_image)); ?>)" <?php endif; ?>>

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
