<?php $__env->startSection('title', ($course->meta_title) ? $course->meta_title : app_name() ); ?>
<?php $__env->startSection('meta_description', $course->meta_description); ?>
<?php $__env->startSection('meta_keywords', $course->meta_keywords); ?>

<?php $__env->startPush('after-styles'); ?>
    <style>
        .leanth-course.go {
            right: 0;
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
                    <h2 class="breadcrumb-head black bold"><span><?php echo e($course->title); ?></span></h2>
                </div>
            </div>
        </div>
    </section>
    <!-- End of breadcrumb section
        ============================================= -->

    <!-- Start of course details section
        ============================================= -->
    <section id="course-details" class="course-details-section">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <?php if(session()->has('success')): ?>
                        <div class="alert alert-dismissable alert-success fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>
                    <div class="course-details-item border-bottom-0 mb-0">
                        <div class="course-single-pic mb30">
                            <?php if($course->course_image != ""): ?>
                                <img src="<?php echo e(asset('storage/uploads/'.$course->course_image)); ?>"
                                     alt="">
                            <?php endif; ?>
                        </div>
                        <div class="course-single-text">
                            <div class="course-title mt10 headline relative-position">
                                <h3><a href="<?php echo e(route('courses.show', [$course->slug])); ?>"><b><?php echo e($course->title); ?></b></a>
                                    <?php if($course->trending == 1): ?>
                                        <span class="trend-badge text-uppercase bold-font"><i
                                                    class="fas fa-bolt"></i> <?php echo app('translator')->getFromJson('labels.frontend.badges.trending'); ?></span>
                                    <?php endif; ?>

                                </h3>
                            </div>
                            <div class="course-details-content">
                                <p>
                                    <?php echo $course->description; ?>

                                </p>
                            </div>

                            <?php if(count($lessons)  > 0): ?>

                                <div class="course-details-category ul-li">
                                    <span class="float-none"><?php echo app('translator')->getFromJson('labels.frontend.course.course_timeline'); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- /course-details -->

                    <div class="affiliate-market-guide mb65">

                        <div class="affiliate-market-accordion">
                            <div id="accordion" class="panel-group">
                                <?php if(count($lessons)  > 0): ?>
                                    <?php $count = 0; ?>
                                    <?php $__currentLoopData = $lessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $lesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($lesson->model && $lesson->model->published == 1): ?>
                                            <?php $count++ ?>

                                            <div class="panel position-relative">
                                                <?php if(auth()->check()): ?>
                                                    <?php if(in_array($lesson->model->id,$completed_lessons)): ?>
                                                        <div class="position-absolute" style="right: 0;top:0px">
                                                            <span class="gradient-bg p-1 text-white font-weight-bold completed"><?php echo app('translator')->getFromJson('labels.frontend.course.completed'); ?></span>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <div class="panel-title" id="headingOne">
                                                    <div class="ac-head">
                                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                                                data-target="#collapse<?php echo e($count); ?>" aria-expanded="false"
                                                                aria-controls="collapse<?php echo e($count); ?>">
                                                            <span><?php echo e(sprintf("%02d", $count)); ?></span>
                                                            <?php echo e($lesson->model->title); ?>

                                                        </button>
                                                        <?php if($lesson->model_type == 'App\Models\Test'): ?>
                                                            <div class="leanth-course">
                                                                <span><?php echo app('translator')->getFromJson('labels.frontend.course.test'); ?></span>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div id="collapse<?php echo e($count); ?>" class="collapse" aria-labelledby="headingOne"
                                                     data-parent="#accordion">
                                                    <div class="panel-body">
                                                        <?php if($lesson->model_type == 'App\Models\Test'): ?>
                                                            <?php echo e(mb_substr($lesson->model->description,0,20).'...'); ?>

                                                        <?php else: ?>
                                                            <?php echo e($lesson->model->short_text); ?>


                                                        <?php endif; ?>
                                                        <?php if(auth()->check()): ?>

                                                            <?php if(in_array($lesson->model->id,$completed_lessons)): ?>
                                                                <div>
                                                                    <a class="btn btn-warning mt-3"
                                                                       href="<?php echo e(route('lessons.show',['id' => $lesson->course->id,'slug'=>$lesson->model->slug])); ?>">
                                                                        <span class=" text-white font-weight-bold "><?php echo app('translator')->getFromJson('labels.frontend.course.go'); ?>
                                                                            ></span>
                                                                    </a>
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <!-- /market guide -->

                    <div class="course-review">
                        <div class="section-title-2 mb20 headline text-left">
                            <h2><?php echo app('translator')->getFromJson('labels.frontend.course.course_reviews'); ?></h2>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="ratting-preview">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="avrg-rating ul-li">
                                                <b><?php echo app('translator')->getFromJson('labels.frontend.course.average_rating'); ?></b>
                                                <span class="avrg-rate"><?php echo e($course_rating); ?></span>
                                                <ul>
                                                    <?php for($r=1; $r<=$course_rating; $r++): ?>
                                                        <li><i class="fas fa-star"></i></li>
                                                    <?php endfor; ?>
                                                </ul>
                                                <b><?php echo e($total_ratings); ?> <?php echo app('translator')->getFromJson('labels.frontend.course.ratings'); ?></b>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="avrg-rating ul-li">
                                                <span><b><?php echo app('translator')->getFromJson('labels.frontend.course.details'); ?></b></span>
                                                <?php for($r=5; $r>=1; $r--): ?>
                                                    <div class="rating-overview">
                                                        <span class="start-item"><?php echo e($r); ?> <?php echo app('translator')->getFromJson('labels.frontend.course.stars'); ?></span>
                                                        <span class="start-bar"></span>
                                                        <span class="start-count"><?php echo e($course->reviews()->where('rating','=',$r)->get()->count()); ?></span>
                                                    </div>
                                                <?php endfor; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /review overview -->

                    <div class="couse-comment">
                        <div class="blog-comment-area ul-li about-teacher-2">
                            <?php if(count($course->reviews) > 0): ?>
                                <ul class="comment-list">
                                    <?php $__currentLoopData = $course->reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="d-block">
                                            <div class="comment-avater">
                                                <img src="<?php echo e($item->user->picture); ?>" alt="">
                                            </div>

                                            <div class="author-name-rate">
                                                <div class="author-name float-left">
                                                    <?php echo app('translator')->getFromJson('labels.frontend.course.by'); ?>:
                                                    <span><?php echo e($item->user->full_name); ?></span>
                                                </div>
                                                <div class="comment-ratting float-right ul-li">
                                                    <ul>
                                                        <?php for($i=1; $i<=(int)$item->rating; $i++): ?>
                                                            <li><i class="fas fa-star"></i></li>
                                                        <?php endfor; ?>
                                                    </ul>
                                                    <?php if(auth()->check() && ($item->user_id == auth()->user()->id)): ?>
                                                        <div>
                                                            <a href="<?php echo e(route('courses.review.edit',['id'=>$item->id])); ?>"
                                                               class="mr-2"><?php echo app('translator')->getFromJson('labels.general.edit'); ?></a>
                                                            <a href="<?php echo e(route('courses.review.delete',['id'=>$item->id])); ?>"
                                                               class="text-danger"><?php echo app('translator')->getFromJson('labels.general.delete'); ?></a>
                                                        </div>

                                                    <?php endif; ?>
                                                </div>
                                                <div class="time-comment float-right"><?php echo e($item->created_at->diffforhumans()); ?></div>
                                            </div>
                                            <div class="author-designation-comment">
                                                <p><?php echo e($item->content); ?></p>
                                            </div>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php else: ?>
                                <h4> <?php echo app('translator')->getFromJson('labels.frontend.course.no_reviews_yet'); ?></h4>
                            <?php endif; ?>

                            <?php if($purchased_course): ?>
                                <?php if(isset($review) || ($is_reviewed == false)): ?>
                                    <div class="reply-comment-box">
                                        <div class="review-option">
                                            <div class="section-title-2  headline text-left float-left">
                                                <h2><?php echo app('translator')->getFromJson('labels.frontend.course.add_reviews'); ?></h2>
                                            </div>
                                            <div class="review-stars-item float-right mt15">
                                                <span><?php echo app('translator')->getFromJson('labels.frontend.course.your_rating'); ?>: </span>
                                                <div class="rating">
                                                    <label>
                                                        <input type="radio" name="stars" value="1"/>
                                                        <span class="icon"><i class="fas fa-star"></i></span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="stars" value="2"/>
                                                        <span class="icon"><i class="fas fa-star"></i></span>
                                                        <span class="icon"><i class="fas fa-star"></i></span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="stars" value="3"/>
                                                        <span class="icon"><i class="fas fa-star"></i></span>
                                                        <span class="icon"><i class="fas fa-star"></i></span>
                                                        <span class="icon"><i class="fas fa-star"></i></span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="stars" value="4"/>
                                                        <span class="icon"><i class="fas fa-star"></i></span>
                                                        <span class="icon"><i class="fas fa-star"></i></span>
                                                        <span class="icon"><i class="fas fa-star"></i></span>
                                                        <span class="icon"><i class="fas fa-star"></i></span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="stars" value="5"/>
                                                        <span class="icon"><i class="fas fa-star"></i></span>
                                                        <span class="icon"><i class="fas fa-star"></i></span>
                                                        <span class="icon"><i class="fas fa-star"></i></span>
                                                        <span class="icon"><i class="fas fa-star"></i></span>
                                                        <span class="icon"><i class="fas fa-star"></i></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="teacher-faq-form">
                                            <?php
                                                if(isset($review)){
                                                    $route = route('courses.review.update',['id'=>$review->id]);
                                                }else{
                                                    $route = route('courses.review',['course'=>$course->id]);
                                                }
                                            ?>
                                            <form method="POST"
                                                  action="<?php echo e($route); ?>"
                                                  data-lead="Residential">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="rating" id="rating">
                                                <label for="review"><?php echo app('translator')->getFromJson('labels.frontend.course.message'); ?></label>
                                                <textarea name="review" class="mb-2" id="review" rows="2"
                                                          cols="20"><?php if(isset($review)): ?><?php echo e($review->content); ?> <?php endif; ?></textarea>
                                                <span class="help-block text-danger"><?php echo e($errors->first('review', ':message')); ?></span>
                                                <div class="nws-button text-center  gradient-bg text-uppercase">
                                                    <button type="submit"
                                                            value="Submit"><?php echo app('translator')->getFromJson('labels.frontend.course.add_review_now'); ?>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>


                        </div>
                    </div>
                    <?php if($course->bundles && (count($course->bundles) > 0)): ?>
                        <div class="course-details-category ul-li mt-5">
                            <h3 class="float-none text-dark"><?php echo app('translator')->getFromJson('labels.frontend.course.available_in_bundles'); ?></h3>
                        </div>
                        <div class="genius-post-item mb55">
                            <div class="tab-container">
                                <div id="tab1" class="tab-content-1 pt35">
                                    <div class="best-course-area best-course-v2">
                                        <div class="row">
                                            <?php $__currentLoopData = $course->bundles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bundle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <div class="col-md-4">
                                                    <div class="best-course-pic-text relative-position">
                                                        <div class="best-course-pic relative-position"
                                                             <?php if($bundle->course_image != ""): ?> style="background-image: url('<?php echo e(asset('storage/uploads/'.$course->course_image)); ?>')" <?php endif; ?>>

                                                            <?php if($bundle->trending == 1): ?>
                                                                <div class="trend-badge-2 text-center text-uppercase">
                                                                    <i class="fas fa-bolt"></i>
                                                                    <span><?php echo app('translator')->getFromJson('labels.frontend.badges.trending'); ?></span>
                                                                </div>
                                                            <?php endif; ?>
                                                                <?php if($bundle->free == 1): ?>
                                                                    <div class="trend-badge-3 text-center text-uppercase">
                                                                        <i class="fas fa-bolt"></i>
                                                                        <span><?php echo app('translator')->getFromJson('labels.backend.courses.fields.free'); ?></span>
                                                                    </div>
                                                                <?php endif; ?>

                                                            <div class="course-rate ul-li">
                                                                <ul>
                                                                    <?php for($i=1; $i<=(int)$bundle->rating; $i++): ?>
                                                                        <li><i class="fas fa-star"></i></li>
                                                                    <?php endfor; ?>
                                                                </ul>
                                                            </div>
                                                            <div class="course-details-btn">
                                                                <a href="<?php echo e(route('bundles.show', [$bundle->slug])); ?>"><?php echo app('translator')->getFromJson('labels.frontend.course.bundle_detail'); ?>
                                                                    <i class="fas fa-arrow-right"></i></a>
                                                            </div>
                                                            <div class="blakish-overlay"></div>
                                                        </div>
                                                        <div class="best-course-text">
                                                            <div class="course-title mb20 headline relative-position">
                                                                <h3>
                                                                    <a href="<?php echo e(route('bundles.show', [$bundle->slug])); ?>"><?php echo e($bundle->title); ?></a>
                                                                </h3>
                                                            </div>
                                                            <div class="course-meta">
                                                            <span class="course-category"><a
                                                                        href="<?php echo e(route('courses.category',['category'=>$bundle->category->slug])); ?>"><?php echo e($bundle->category->name); ?></a></span>
                                                                <span class="course-author"><a href="#"><?php echo e($bundle->students()->count()); ?>

                                                                        <?php echo app('translator')->getFromJson('labels.frontend.course.students'); ?></a></span>
                                                                <span class="course-author mr-0"><?php echo e($bundle->courses()->count()); ?>

                                                                    <?php if($bundle->courses()->count() > 1 ): ?>
                                                                        <?php echo app('translator')->getFromJson('labels.frontend.course.courses'); ?>
                                                                    <?php else: ?>
                                                                        <?php echo app('translator')->getFromJson('labels.frontend.course.course'); ?>
                                                                    <?php endif; ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <!-- /course -->
                                        </div>
                                    </div>
                                </div><!-- /tab-1 -->
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-md-3">
                    <div class="side-bar">
                        <div class="course-side-bar-widget">


                        <?php if(!$purchased_course): ?>
                                <h3>
                                     <?php if($course->free == 1): ?>
                                        <span> <?php echo e(trans('labels.backend.courses.fields.free')); ?></span>
                                        <?php else: ?>
                                        <?php echo app('translator')->getFromJson('labels.frontend.course.price'); ?><span>   <?php echo e($appCurrency['symbol'].' '.$course->price); ?></span>
                                        <?php endif; ?></h3>

                                <?php if(auth()->check() && (auth()->user()->hasRole('student')) && (Cart::session(auth()->user()->id)->get( $course->id))): ?>
                                    <button class="btn genius-btn btn-block text-center my-2 text-uppercase  btn-success text-white bold-font"
                                            type="submit"><?php echo app('translator')->getFromJson('labels.frontend.course.added_to_cart'); ?>
                                    </button>
                                <?php elseif(!auth()->check()): ?>
                                    <?php if($course->free == 1): ?>
                                        <a id="openLoginModal"
                                           class="genius-btn btn-block text-white  gradient-bg text-center text-uppercase  bold-font"
                                           data-target="#myModal" href="#"><?php echo app('translator')->getFromJson('labels.frontend.course.get_now'); ?> <i
                                                    class="fas fa-caret-right"></i></a>
                                    <?php else: ?>
                                    <a id="openLoginModal"
                                       class="genius-btn btn-block text-white  gradient-bg text-center text-uppercase  bold-font"
                                       data-target="#myModal" href="#"><?php echo app('translator')->getFromJson('labels.frontend.course.buy_now'); ?> <i
                                                class="fas fa-caret-right"></i></a>

                                    <a id="openLoginModal"
                                       class="genius-btn btn-block my-2 bg-dark text-center text-white text-uppercase "
                                       data-target="#myModal" href="#"><?php echo app('translator')->getFromJson('labels.frontend.course.add_to_cart'); ?> <i
                                                class="fa fa-shopping-bag"></i></a>
                                    <?php endif; ?>
                                <?php elseif(auth()->check() && (auth()->user()->hasRole('student'))): ?>

                                    <?php if($course->free == 1): ?>
                                        <form action="<?php echo e(route('cart.getnow')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="course_id" value="<?php echo e($course->id); ?>"/>
                                            <input type="hidden" name="amount" value="<?php echo e(($course->free == 1) ? 0 : $course->price); ?>"/>
                                            <button class="genius-btn btn-block text-white  gradient-bg text-center text-uppercase  bold-font"
                                                    href="#"><?php echo app('translator')->getFromJson('labels.frontend.course.get_now'); ?> <i
                                                        class="fas fa-caret-right"></i></button>
                                        </form>
                                    <?php else: ?>
                                        <form action="<?php echo e(route('cart.checkout')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="course_id" value="<?php echo e($course->id); ?>"/>
                                            <input type="hidden" name="amount" value="<?php echo e(($course->free == 1) ? 0 : $course->price); ?>"/>
                                            <button class="genius-btn btn-block text-white  gradient-bg text-center text-uppercase  bold-font"
                                                    href="#"><?php echo app('translator')->getFromJson('labels.frontend.course.buy_now'); ?> <i
                                                        class="fas fa-caret-right"></i></button>
                                        </form>
                                        <form action="<?php echo e(route('cart.addToCart')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="course_id" value="<?php echo e($course->id); ?>"/>
                                            <input type="hidden" name="amount" value="<?php echo e(($course->free == 1) ? 0 : $course->price); ?>"/>
                                            <button type="submit"
                                                    class="genius-btn btn-block my-2 bg-dark text-center text-white text-uppercase ">
                                                <?php echo app('translator')->getFromJson('labels.frontend.course.add_to_cart'); ?> <i
                                                        class="fa fa-shopping-bag"></i></button>
                                        </form>
                                    <?php endif; ?>


                                <?php else: ?>
                                    <h6 class="alert alert-danger"> <?php echo app('translator')->getFromJson('labels.frontend.course.buy_note'); ?></h6>
                                <?php endif; ?>
                            <?php else: ?>

                                <?php if($continue_course): ?>

                                <a href="<?php echo e(route('lessons.show',['id' => $course->id,'slug'=>$continue_course->model->slug])); ?>"
                                   class="genius-btn btn-block text-white  gradient-bg text-center text-uppercase  bold-font">

                                    <?php echo app('translator')->getFromJson('labels.frontend.course.continue_course'); ?>

                                    <i class="fa fa-arow-right"></i></a>
                                 <?php endif; ?>

                            <?php endif; ?>

                        </div>
                        <div class="enrolled-student">
                            <div class="comment-ratting float-left ul-li">
                                <ul>
                                    <?php for($i=1; $i<=(int)$course->rating; $i++): ?>
                                        <li><i class="fas fa-star"></i></li>
                                    <?php endfor; ?>
                                </ul>
                            </div>
                            <div class="student-number bold-font">
                                <?php echo e($course->students()->count()); ?>  <?php echo app('translator')->getFromJson('labels.frontend.course.enrolled'); ?>
                            </div>
                        </div>
                        <div class="couse-feature ul-li-block">
                            <ul>
                                <li> <?php echo app('translator')->getFromJson('labels.frontend.course.chapters'); ?>
                                    <span> <?php echo e($course->chapterCount()); ?> </span></li>
                                
                                <li> <?php echo app('translator')->getFromJson('labels.frontend.course.category'); ?> <span><a
                                                href="<?php echo e(route('courses.category',['category'=>$course->category->slug])); ?>"
                                                target="_blank"><?php echo e($course->category->name); ?></a> </span></li>
                                <li> <?php echo app('translator')->getFromJson('labels.frontend.course.author'); ?> <span>

                                        <?php $__currentLoopData = $course->teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $key++ ?>
                                            <a href="<?php echo e(route('teachers.show',['id'=>$teacher->id])); ?>" target="_blank">
                                                <?php echo e($teacher->full_name); ?><?php if($key < count($course->teachers )): ?>, <?php endif; ?>
                                            </a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                       </span>
                                </li>
                            </ul>

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
    <!-- End of course details section
        ============================================= -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-scripts'); ?>
    <script>
        $(document).on('change', 'input[name="stars"]', function () {
            $('#rating').val($(this).val());
        })
                <?php if(isset($review)): ?>
        var rating = "<?php echo e($review->rating); ?>";
        $('input[value="' + rating + '"]').prop("checked", true);
        $('#rating').val(rating);
        <?php endif; ?>
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.app'.config('theme_layout'), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>