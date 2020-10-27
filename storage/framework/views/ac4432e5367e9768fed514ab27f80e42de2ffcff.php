<?php $__env->startSection('title', trans('labels.frontend.course.courses').' | '. app_name() ); ?>

<?php $__env->startPush('after-styles'); ?>
    <style>
        .couse-pagination li.active {
            color: #333333 !important;
            font-weight: 700;
        }

        .page-link {
            position: relative;
            display: block;
            padding: .5rem .75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #c7c7c7;
            background-color: white;
            border: none;
        }

        .page-item.active .page-link {
            z-index: 1;
            color: #333333;
            background-color: white;
            border: none;

        }

        ul.pagination {
            display: inline;
            text-align: center;
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
                    <h2 class="breadcrumb-head black bold">
                        <span><?php if(isset($category)): ?> <?php echo e($category->name); ?> <?php else: ?> <?php echo app('translator')->getFromJson('labels.frontend.course.courses'); ?> <?php endif; ?> </span>
                    </h2>
                </div>
            </div>
        </div>
    </section>
    <!-- End of breadcrumb section
        ============================================= -->


    <!-- Start of course section
        ============================================= -->
    <section id="course-page" class="course-page-section">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <?php if(session()->has('success')): ?>
                        <div class="alert alert-dismissable alert-success fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>
                    <div class="short-filter-tab">
                        <div class="shorting-filter w-50 d-inline float-left mr-3">
                            <span><?php echo app('translator')->getFromJson('labels.frontend.course.sort_by'); ?></span>
                            <select id="sortBy" class="form-control d-inline w-50">
                                <option value=""><?php echo app('translator')->getFromJson('labels.frontend.course.none'); ?></option>
                                <option value="popular"><?php echo app('translator')->getFromJson('labels.frontend.course.popular'); ?></option>
                                <option value="trending"><?php echo app('translator')->getFromJson('labels.frontend.course.trending'); ?></option>
                                <option value="featured"><?php echo app('translator')->getFromJson('labels.frontend.course.featured'); ?></option>
                            </select>
                        </div>

                        <div class="tab-button blog-button ul-li text-center float-right">
                            <ul class="product-tab">
                                <li class="active" rel="tab1"><i class="fas fa-th"></i></li>
                                <li rel="tab2"><i class="fas fa-list"></i></li>
                            </ul>
                        </div>

                    </div>

                    <div class="genius-post-item">
                        <div class="tab-container">
                            <div id="tab1" class="tab-content-1 pt35">
                                <div class="best-course-area best-course-v2">
                                    <div class="row">
                                        <?php if($courses->count() > 0): ?>

                                            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <div class="col-md-4">
                                                    <div class="best-course-pic-text relative-position">
                                                        <div class="best-course-pic relative-position"
                                                             <?php if($course->course_image != ""): ?> style="background-image: url('<?php echo e(asset('storage/uploads/'.$course->course_image)); ?>')" <?php endif; ?>>

                                                            <?php if($course->trending == 1): ?>
                                                                <div class="trend-badge-2 text-center text-uppercase">
                                                                    <i class="fas fa-bolt"></i>
                                                                    <span><?php echo app('translator')->getFromJson('labels.frontend.badges.trending'); ?></span>
                                                                </div>
                                                            <?php endif; ?>
                                                                <?php if($course->free == 1): ?>
                                                                    <div class="trend-badge-3 text-center text-uppercase">
                                                                        <i class="fas fa-bolt"></i>
                                                                        <span><?php echo app('translator')->getFromJson('labels.backend.courses.fields.free'); ?></span>
                                                                    </div>
                                                                <?php endif; ?>
                                                            <div class="course-price text-center gradient-bg">
                                                                <?php if($course->free == 1): ?>
                                                                    <span><?php echo e(trans('labels.backend.courses.fields.free')); ?></span>
                                                                <?php else: ?>
                                                                    <span> <?php echo e($appCurrency['symbol'].' '.$course->price); ?></span>
                                                                <?php endif; ?>
                                                            </div>

                                                            <div class="course-rate ul-li">
                                                                <ul>
                                                                    <?php for($i=1; $i<=(int)$course->rating; $i++): ?>
                                                                        <li><i class="fas fa-star"></i></li>
                                                                    <?php endfor; ?>
                                                                </ul>
                                                            </div>
                                                            <div class="course-details-btn">
                                                                <a href="<?php echo e(route('courses.show', [$course->slug])); ?>"><?php echo app('translator')->getFromJson('labels.frontend.course.course_detail'); ?>
                                                                    <i class="fas fa-arrow-right"></i></a>
                                                            </div>
                                                            <div class="blakish-overlay"></div>
                                                        </div>
                                                        <div class="best-course-text">
                                                            <div class="course-title mb20 headline relative-position">
                                                                <h3>
                                                                    <a href="<?php echo e(route('courses.show', [$course->slug])); ?>"><?php echo e($course->title); ?></a>
                                                                </h3>
                                                            </div>
                                                            <div class="course-meta">
                                                                <span class="course-category"><a
                                                                            href="<?php echo e(route('courses.category',['category'=>$course->category->slug])); ?>"><?php echo e($course->category->name); ?></a></span>
                                                                <span class="course-author"><a href="#"><?php echo e($course->students()->count()); ?>

                                                                        <?php echo app('translator')->getFromJson('labels.frontend.course.students'); ?></a></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <h3><?php echo app('translator')->getFromJson('labels.general.no_data_available'); ?></h3>
                                    <?php endif; ?>

                                    <!-- /course -->

                                    </div>
                                </div>
                            </div><!-- /tab-1 -->

                            <div id="tab2" class="tab-content-1">
                                <div class="course-list-view">
                                    <table>
                                        <tr class="list-head">
                                            <th><?php echo app('translator')->getFromJson('labels.frontend.course.course_name'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('labels.frontend.course.course_type'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('labels.frontend.course.starts'); ?></th>
                                        </tr>
                                        <?php if($courses->count() > 0): ?>
                                            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <tr>
                                                    <td>
                                                        <div class="course-list-img-text">
                                                            <div class="course-list-img"
                                                                 <?php if($course->course_image != ""): ?> style="background-image: url(<?php echo e(asset('storage/uploads/'.$course->course_image)); ?>)" <?php endif; ?> >
                                                            </div>
                                                            <div class="course-list-text">
                                                                <h3>
                                                                    <a href="<?php echo e(route('courses.show', [$course->slug])); ?>"><?php echo e($course->title); ?></a>
                                                                </h3>
                                                                <div class="course-meta">
                                                                <span class="course-category bold-font"><a
                                                                            href="<?php echo e(route('courses.show', [$course->slug])); ?>">
                                                                        <?php if($course->free == 1): ?>
                                                                            <?php echo e(trans('labels.backend.courses.fields.free')); ?>

                                                                        <?php else: ?>
                                                                            <?php echo e($appCurrency['symbol'].' '.$course->price); ?>

                                                                        <?php endif; ?>
                                                                    </a></span>

                                                                    <div class="course-rate ul-li">
                                                                        <ul>
                                                                            <?php for($i=1; $i<=(int)$course->rating; $i++): ?>
                                                                                <li><i class="fas fa-star"></i></li>
                                                                            <?php endfor; ?>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="course-type-list">
                                                            <span><a href="<?php echo e(route('courses.category',['category'=>$course->category->slug])); ?>"><?php echo e($course->category->name); ?></a></span>
                                                        </div>
                                                    </td>
                                                    <td><?php echo e(\Carbon\Carbon::parse($course->start_date)->format('d M Y')); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="3">
                                                    <h3><?php echo app('translator')->getFromJson('labels.general.no_data_available'); ?></h3>

                                                </td>
                                            </tr>
                                        <?php endif; ?>

                                    </table>
                                </div>
                            </div><!-- /tab-2 -->
                        </div>
                        <div class="couse-pagination text-center ul-li">
                            <?php echo e($courses->links()); ?>

                        </div>
                    </div>


                </div>

                <div class="col-md-3">
                    <div class="side-bar">

                        <div class="side-bar-widget  first-widget">
                            <h2 class="widget-title text-capitalize"><?php echo app('translator')->getFromJson('labels.frontend.course.find_your_course'); ?></h2>
                            <div class="listing-filter-form pb30">
                                <form action="<?php echo e(route('search')); ?>" method="get">

                                    <div class="filter-search mb20">
                                        <label><?php echo app('translator')->getFromJson('labels.frontend.course.full_text'); ?></label>
                                        <input type="text" class="" name="q" placeholder="<?php echo e(trans('labels.frontend.course.looking_for')); ?>">
                                    </div>
                                    <button class="genius-btn gradient-bg text-center text-uppercase btn-block text-white font-weight-bold"
                                            type="submit"><?php echo app('translator')->getFromJson('labels.frontend.course.find_courses'); ?> <i
                                                class="fas fa-caret-right"></i></button>
                                </form>

                            </div>
                        </div>

                        <?php if($recent_news->count() > 0): ?>
                            <div class="side-bar-widget">
                                <h2 class="widget-title text-capitalize"><?php echo app('translator')->getFromJson('labels.frontend.course.recent_news'); ?></h2>
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
                                            <h3 class="latest-title bold-font"><a
                                                        href="<?php echo e(route('blogs.index',['slug'=>$item->slug.'-'.$item->id])); ?>"><?php echo e($item->title); ?></a>
                                            </h3>
                                        </div>
                                        <!-- /post -->
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                    <div class="view-all-btn bold-font">
                                        <a href="<?php echo e(route('blogs.index')); ?>"><?php echo app('translator')->getFromJson('labels.frontend.course.view_all_news'); ?>
                                            <i class="fas fa-chevron-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>

                        <?php endif; ?>


                        <?php if($global_featured_course != ""): ?>
                            <div class="side-bar-widget">
                                <h2 class="widget-title text-capitalize"><?php echo app('translator')->getFromJson('labels.frontend.course.featured_course'); ?></h2>
                                <div class="featured-course">
                                    <div class="best-course-pic-text relative-position pt-0">
                                        <div class="best-course-pic relative-position "
                                             <?php if($global_featured_course->course_image != ""): ?> style="background-image: url(<?php echo e(asset('storage/uploads/'.$global_featured_course->course_image)); ?>)" <?php endif; ?>>

                                            <?php if($global_featured_course->trending == 1): ?>
                                                <div class="trend-badge-2 text-center text-uppercase">
                                                    <i class="fas fa-bolt"></i>
                                                    <span><?php echo app('translator')->getFromJson('labels.frontend.badges.trending'); ?></span>
                                                </div>
                                            <?php endif; ?>
                                                <?php if($global_featured_course->free == 1): ?>
                                                    <div class="trend-badge-3 text-center text-uppercase">
                                                        <i class="fas fa-bolt"></i>
                                                        <span><?php echo app('translator')->getFromJson('labels.backend.courses.fields.free'); ?></span>
                                                    </div>
                                                <?php endif; ?>

                                        </div>
                                        <div class="best-course-text" style="left: 0;right: 0;">
                                            <div class="course-title mb20 headline relative-position">
                                                <h3>
                                                    <a href="<?php echo e(route('courses.show', [$global_featured_course->slug])); ?>"><?php echo e($global_featured_course->title); ?></a>
                                                </h3>
                                            </div>
                                            <div class="course-meta">
                                                <span class="course-category"><a
                                                            href="<?php echo e(route('courses.category',['category'=>$global_featured_course->category->slug])); ?>"><?php echo e($global_featured_course->category->name); ?></a></span>
                                                <span class="course-author"><?php echo e($global_featured_course->students()->count()); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of course section
        ============================================= -->

    <!-- Start of best course
   =============================================  -->
    <?php echo $__env->make('frontend.layouts.partials.browse_courses', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!-- End of best course
            ============================================= -->


<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-scripts'); ?>
    <script>
        $(document).ready(function () {
            $(document).on('change', '#sortBy', function () {
                if ($(this).val() != "") {
                    location.href = '<?php echo e(url()->current()); ?>?type=' + $(this).val();
                } else {
                    location.href = '<?php echo e(route('courses.all')); ?>';
                }
            })

            <?php if(request('type') != ""): ?>
            $('#sortBy').find('option[value="' + "<?php echo e(request('type')); ?>" + '"]').attr('selected', true);
            <?php endif; ?>
        });

    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.app'.config('theme_layout'), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>