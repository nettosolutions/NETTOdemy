<?php $__env->startPush('after-styles'); ?>
    <style>
        .couse-pagination li.active {
            color: #333333!important;
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
            background-color:white;
            border:none;

        }
        ul.pagination{
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
                    <h2 class="breadcrumb-head black bold">"<?php echo e($q); ?>" <span>Courses</span></h2>
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
                            <span><?php echo app('translator')->getFromJson('labels.frontend.search_result.sort_by'); ?></span>
                            <select id="sortBy" class="form-control d-inline w-50">
                                <option value=""><?php echo app('translator')->getFromJson('labels.frontend.search_result.none'); ?></option>
                                <option value="popular"><?php echo app('translator')->getFromJson('labels.frontend.search_result.popular'); ?></option>
                                <option value="trending"><?php echo app('translator')->getFromJson('labels.frontend.search_result.trending'); ?></option>
                                <option value="featured"><?php echo app('translator')->getFromJson('labels.frontend.search_result.featured'); ?></option>
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
                                        <?php if(count($courses) > 0): ?>
                                            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <div class="col-md-4">
                                                    <div class="best-course-pic-text relative-position">
                                                        <div class="best-course-pic relative-position" <?php if($course->course_image != ""): ?>style="background-image: url('<?php echo e(asset('storage/uploads/'.$course->course_image)); ?>')" <?php endif; ?>>

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
                                                                    <span> <?php echo e(trans('labels.backend.courses.fields.free')); ?></span>
                                                                <?php else: ?>
                                                                    <span>   <?php echo e($appCurrency['symbol'].' '.$course->price); ?></span>
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
                                                                <a class="text-uppercase" href="<?php echo e(route('courses.show', [$course->slug])); ?>"><?php echo app('translator')->getFromJson('labels.frontend.search_result.course_detail'); ?> <i class="fas fa-arrow-right"></i></a>
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
                                                                <span class="course-category"><a href="<?php echo e(route('courses.category',['category'=>$course->category->slug])); ?>"><?php echo e($course->category->name); ?></a></span>
                                                                <span class="course-author"><a href="#"><?php echo e($course->students()->count()); ?>

                                                                        <?php echo app('translator')->getFromJson('labels.frontend.search_result.students'); ?></a></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <div class="col-12">
                                                <h4><?php echo app('translator')->getFromJson('labels.general.no_data_available'); ?></h4>
                                            </div>
                                    <?php endif; ?>


                                    <!-- /course -->


                                    </div>
                                </div>
                            </div><!-- /tab-1 -->

                            <div id="tab2" class="tab-content-1">
                                <div class="course-list-view">
                                    <?php if(count($courses) > 0): ?>
                                        <table>
                                            <tr class="list-head text-uppercase">
                                                <th><?php echo app('translator')->getFromJson('labels.frontend.search_result.course_name'); ?></th>
                                                <th><?php echo app('translator')->getFromJson('labels.frontend.search_result.course_type'); ?></th>
                                                <th><?php echo app('translator')->getFromJson('labels.frontend.search_result.starts'); ?></th>
                                            </tr>
                                            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <tr>
                                                    <td>
                                                        <div class="course-list-img-text">
                                                            <div class="course-list-img" <?php if($course->course_image != ""): ?> style="background-image: url(<?php echo e(asset('storage/uploads/'.$course->course_image)); ?>)" <?php endif; ?> >
                                                            </div>
                                                            <div class="course-list-text">
                                                                <h3>
                                                                    <a href="<?php echo e(route('courses.show', [$course->slug])); ?>"><?php echo e($course->title); ?></a>
                                                                </h3>
                                                                <div class="course-meta">
                                                                <span class="course-category bold-font"><a
                                                                            href="<?php echo e(route('courses.show', [$course->slug])); ?>"><?php if($course->free == 1): ?>
                                                                            <?php echo e(trans('labels.backend.courses.fields.free')); ?>

                                                                        <?php else: ?>
                                                                           <?php echo e($appCurrency['symbol'].' '.$course->price); ?>

                                                                        <?php endif; ?></a></span>

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

                                        </table>

                                    <?php else: ?>
                                        <h4><?php echo app('translator')->getFromJson('labels.general.no_data_available'); ?></h4>
                                    <?php endif; ?>
                                </div>
                            </div><!-- /tab-2 -->
                        </div>
                        <div class="couse-pagination text-center ul-li">
                            <?php echo e($courses->links()); ?>

                        </div>
                    </div>
                </div>
                <?php echo $__env->make('frontend.layouts.partials.right-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            </div>
        </div>
    </section>
    <!-- End of course section
        ============================================= -->



<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-scripts'); ?>
    <script>
        $(document).ready(function () {
            $(document).on('change','#sortBy',function () {
                if($(this).val() != ""){
                    location.href = '<?php echo e(url()->current()); ?>?type='+$(this).val();
                }else{
                    location.href = '<?php echo e(route('courses.all')); ?>';
                }
            })

            <?php if(request('type') != ""): ?>
            $('#sortBy').find('option[value="'+"<?php echo e(request('type')); ?>"+'"]').attr('selected',true);
            <?php endif; ?>
        });

    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.app'.config('theme_layout'), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>