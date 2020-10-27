<section id="latest-area" class="latest-area-section <?php echo e(isset($pt) ? $pt : ''); ?>">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="latest-area-content  ">
                    <div class="section-title-2 mb65 headline text-left">
                        <h2><?php echo app('translator')->getFromJson('labels.frontend.layouts.partials.latest_news_blog'); ?></h2>
                    </div>
                    <div class="latest-news-posts">
                        <?php if(count($news) > 0): ?>
                            <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="latest-news-area">
                                    <?php if($item->image != null): ?>
                                        <div class="latest-news-thumbnile relative-position"
                                             style="background-image: url('<?php echo e(asset("storage/uploads/".$item->image)); ?>');">
                                            <div class="hover-search">
                                                
                                            </div>
                                            <div class="blakish-overlay"></div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="date-meta">
                                        <i class="fas fa-calendar-alt"></i> <?php echo e($item->created_at->format('d M Y')); ?>

                                    </div>
                                    <h3 class="latest-title bold-font"><a
                                                href="<?php echo e(route('blogs.index',['slug' => $item->slug.'-'.$item->id])); ?>"><?php echo e($item->title); ?></a>
                                    </h3>
                                    <h3 class="latest-title text-primary"><a
                                                href="<?php echo e(route('blogs.category',['category' => $item->category->slug])); ?>"><?php echo e($item->category->name); ?></a>
                                    </h3>
                                    <div class="course-viewer ul-li">
                                        <ul>
                                            
                                            <?php if($item->comments->count() > 1): ?>
                                                <li><a href=""><i
                                                                class="fas fa-comment-dots"></i><?php echo e($item->comments->count()); ?>

                                                    </a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                    <!-- /post -->

                        <div class="view-all-btn bold-font">
                            <a href="<?php echo e(route('blogs.index')); ?>"><?php echo app('translator')->getFromJson('labels.frontend.layouts.partials.view_all_news'); ?> <i class="fas fa-chevron-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="latest-area-content  ">
                    <div class="section-title-2 mb65 headline text-left">
                        <h2><?php echo app('translator')->getFromJson('labels.frontend.layouts.partials.trending_courses'); ?></h2>
                    </div>
                    <div class="latest-news-posts">
                        <?php if(count($trending_courses) > 0): ?>
                            <?php $__currentLoopData = $trending_courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="latest-news-area">
                                    <?php if($item->course_image != null): ?>
                                        <div class="latest-news-thumbnile relative-position"
                                             style="background-image: url('<?php echo e(asset("storage/uploads/".$item->course_image)); ?>');">
                                            <div class="hover-search">
                                                
                                            </div>
                                            <div class="blakish-overlay"></div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="date-meta">
                                        <i class="fas fa-calendar-alt"></i> <?php echo e($item->created_at->format('d M Y')); ?>

                                    </div>
                                    <h3 class="latest-title bold-font"><a
                                                href="<?php echo e(route('courses.show',['slug'=>$item->slug])); ?>"><?php echo e($item->title); ?></a>
                                    </h3>
                                    <h3 class="latest-title text-primary"><a
                                                href="<?php echo e(route('courses.category',['category'=>$item->category->slug])); ?>"><?php echo e($item->category->name); ?></a>
                                    </h3>
                                    <div class="course-viewer ul-li">
                                        <ul>
                                            <li><a href=""><i
                                                            class="fas fa-user"></i> <?php echo e($item->students->count()); ?>

                                                </a></li>

                                        </ul>
                                    </div>
                                </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                    <!-- /post -->

                        <div class="view-all-btn bold-font">
                            <a href="<?php echo e(route('courses.all',['type'=>'trending'])); ?>"><?php echo app('translator')->getFromJson('labels.frontend.layouts.partials.view_all_trending_courses'); ?>  <i
                                        class="fas fa-chevron-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="latest-area-content  ">
                    <div class="section-title-2 mb65 headline text-left">
                        <h2><?php echo app('translator')->getFromJson('labels.frontend.layouts.partials.popular_courses'); ?></h2>
                    </div>
                    <div class="latest-news-posts">
                        <?php if(count($popular_courses) > 0): ?>
                            <?php $__currentLoopData = $popular_courses->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="latest-news-area">
                                    <?php if($item->image != null): ?>
                                        <div class="latest-news-thumbnile relative-position"
                                             style="background-image: url('<?php echo e(asset("storage/uploads/".$item->course_image)); ?>');">
                                            <div class="hover-search">
                                                
                                            </div>
                                            <div class="blakish-overlay"></div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="date-meta">
                                        <i class="fas fa-calendar-alt"></i> <?php echo e($item->created_at->format('d M Y')); ?>

                                    </div>
                                    <h3 class="latest-title bold-font"><a
                                                href="<?php echo e(route('courses.show',['slug'=>$item->slug])); ?>"><?php echo e($item->title); ?></a>
                                    </h3>
                                    <h3 class="latest-title text-primary"><a
                                                href="<?php echo e(route('courses.category',['category'=>$item->category->slug])); ?>"><?php echo e($item->category->name); ?></a>
                                    </h3>
                                    <div class="course-viewer ul-li">
                                        <ul>
                                            <li><a href=""><i
                                                            class="fas fa-user"></i> <?php echo e($item->students->count()); ?>

                                                </a></li>

                                        </ul>
                                    </div>
                                </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                    <!-- /post -->
                        <div class="view-all-btn bold-font">
                            <a href="<?php echo e(route('courses.all',['type'=>'popular'])); ?>"><?php echo app('translator')->getFromJson('labels.frontend.layouts.partials.view_all_popular_courses'); ?> <i
                                        class="fas fa-chevron-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>