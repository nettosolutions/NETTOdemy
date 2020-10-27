<section id="course-category" class="course-category-section">
    <div class="container">
        <div class="section-title mb45 headline text-center ">
            <span class="subtitle text-uppercase"><?php echo app('translator')->getFromJson('labels.frontend.layouts.partials.courses_categories'); ?></span>
            <h2><?php echo app('translator')->getFromJson('labels.frontend.layouts.partials.browse_course_by_category'); ?></h2>
        </div>
        <?php if($course_categories): ?>
            <div class="category-item">
                <div class="row">
                    <?php $__currentLoopData = $course_categories->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-3">
                            <a href="<?php echo e(route('courses.category',['category'=>$category->slug])); ?>">
                                <div class="category-icon-title text-center ">
                                    <div class="category-icon">
                                        <i class="text-gradiant <?php echo e($category->icon); ?>"></i>
                                    </div>
                                    <div class="category-title">
                                        <h4><?php echo e($category->name); ?></h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <!-- /category -->
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
