<?php $__env->startSection('title', __('strings.backend.dashboard.title').' | '.app_name()); ?>

<?php $__env->startPush('after-styles'); ?>
    <style>
        .trend-badge-2 {
            top: -10px;
            left: -52px;
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            position: absolute;
            padding: 40px 40px 12px;
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
            background-color: #ff5a00;
        }

        .progress {
            background-color: #b6b9bb;
            height: 2em;
            font-weight: bold;
            font-size: 0.8rem;
            text-align: center;
        }

        .best-course-pic {
            background-color: #333333;
            background-position: center;
            background-size: cover;
            height: 150px;
            width: 100%;
            background-repeat: no-repeat;
        }


    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong><?php echo app('translator')->getFromJson('strings.backend.dashboard.welcome'); ?> <?php echo e($logged_in_user->name); ?>!</strong>
                </div><!--card-header-->
                <div class="card-body">
                    <div class="row">
                        <?php if(auth()->user()->hasRole('student')): ?>
                            <div class="col-12">
                                <h4><?php echo app('translator')->getFromJson('labels.backend.dashboard.my_courses'); ?></h4>
                            </div>
                            <?php if(count($purchased_courses) > 0): ?>
                                <?php $__currentLoopData = $purchased_courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <div class="col-md-3">
                                        <div class="best-course-pic-text position-relative border">
                                            <div class="best-course-pic position-relative overflow-hidden"
                                                 <?php if($item->course_image != ""): ?> style="background-image: url(<?php echo e(asset('storage/uploads/'.$item->course_image)); ?>)" <?php endif; ?>>

                                                <?php if($item->trending == 1): ?>
                                                    <div class="trend-badge-2 text-center text-uppercase">
                                                        <i class="fas fa-bolt"></i>
                                                        <span><?php echo app('translator')->getFromJson('labels.backend.dashboard.trending'); ?> </span>
                                                    </div>
                                                <?php endif; ?>

                                                <div class="course-rate ul-li">
                                                    <ul>
                                                        <?php for($i=1; $i<=(int)$item->rating; $i++): ?>
                                                            <li><i class="fas fa-star"></i></li>
                                                        <?php endfor; ?>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="best-course-text d-inline-block w-100 p-2">
                                                <div class="course-title mb20 headline relative-position">
                                                    <h5>
                                                        <a href="<?php echo e(route('courses.show', [$item->slug])); ?>"><?php echo e($item->title); ?></a>
                                                    </h5>
                                                </div>
                                                <div class="course-meta d-inline-block w-100 ">
                                                    <div class="d-inline-block w-100 0 mt-2">
                                                     <span class="course-category float-left">
                                                <a href="<?php echo e(route('courses.category',['category'=>$item->category->slug])); ?>"
                                                   class="bg-success text-decoration-none px-2 p-1"><?php echo e($item->category->name); ?></a>
                                            </span>
                                                        <span class="course-author float-right">
                                                 <?php echo e($item->students()->count()); ?>

                                                            <?php echo app('translator')->getFromJson('labels.backend.dashboard.students'); ?>
                                            </span>
                                                    </div>

                                                    <div class="progress my-2">
                                                        <div class="progress-bar"
                                                             style="width:<?php echo e($item->progress()); ?>%"><?php echo e($item->progress()); ?>

                                                            %
                                                            <?php echo app('translator')->getFromJson('labels.backend.dashboard.completed'); ?>
                                                        </div>
                                                    </div>
                                                    <?php if($item->progress() == 100): ?>
                                                        <?php if(!$item->isUserCertified()): ?>
                                                            <form method="post"
                                                                  action="<?php echo e(route('admin.certificates.generate')); ?>">
                                                                <?php echo csrf_field(); ?>
                                                                <input type="hidden" value="<?php echo e($item->id); ?>"
                                                                       name="course_id">
                                                                <button class="btn btn-success btn-block text-white mb-3 text-uppercase font-weight-bold"
                                                                        id="finish"><?php echo app('translator')->getFromJson('labels.frontend.course.finish_course'); ?></button>
                                                            </form>
                                                        <?php else: ?>
                                                            <div class="alert alert-success px-1 text-center mb-0">
                                                                <?php echo app('translator')->getFromJson('labels.frontend.course.certified'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <div class="col-12 text-center">
                                    <h4 class="text-center"><?php echo app('translator')->getFromJson('labels.backend.dashboard.no_data'); ?></h4>
                                    <a class="btn btn-primary"
                                       href="<?php echo e(route('courses.all')); ?>"><?php echo app('translator')->getFromJson('labels.backend.dashboard.buy_course_now'); ?>
                                        <i class="fa fa-arrow-right"></i></a>
                                </div>
                            <?php endif; ?>
                            <?php if(count($purchased_bundles) > 0): ?>

                                <div class="col-12 mt-5">
                                    <h4><?php echo app('translator')->getFromJson('labels.backend.dashboard.my_course_bundles'); ?></h4>
                                </div>
                                <?php $__currentLoopData = $purchased_bundles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$bundle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $key++ ?>
                                    <div class="col-12"><h5><a
                                                    href="<?php echo e(route('bundles.show',['slug'=>$bundle->slug ])); ?>">
                                                <?php echo e($key.'. '.$bundle->title); ?></a></h5>
                                    </div>
                                    <?php if(count($bundle->courses) > 0): ?>
                                        <?php $__currentLoopData = $bundle->courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-md-3 mb-5">
                                                <div class="best-course-pic-text position-relative border">
                                                    <div class="best-course-pic position-relative overflow-hidden"
                                                         <?php if($item->course_image != ""): ?> style="background-image: url(<?php echo e(asset('storage/uploads/'.$item->course_image)); ?>)" <?php endif; ?>>

                                                        <?php if($item->trending == 1): ?>
                                                            <div class="trend-badge-2 text-center text-uppercase">
                                                                <i class="fas fa-bolt"></i>
                                                                <span><?php echo app('translator')->getFromJson('labels.backend.dashboard.trending'); ?> </span>
                                                            </div>
                                                        <?php endif; ?>

                                                        <div class="course-rate ul-li">
                                                            <ul>
                                                                <?php for($i=1; $i<=(int)$item->rating; $i++): ?>
                                                                    <li><i class="fas fa-star"></i></li>
                                                                <?php endfor; ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="best-course-text d-inline-block w-100 p-2">
                                                        <div class="course-title mb20 headline relative-position">
                                                            <h5>
                                                                <a href="<?php echo e(route('courses.show', [$item->slug])); ?>"><?php echo e($item->title); ?></a>
                                                            </h5>
                                                        </div>
                                                        <div class="course-meta d-inline-block w-100 ">
                                                            <div class="d-inline-block w-100 0 mt-2">
                                                     <span class="course-category float-left">
                                                <a href="<?php echo e(route('courses.category',['category'=>$item->category->slug])); ?>"
                                                   class="bg-success text-decoration-none px-2 p-1"><?php echo e($item->category->name); ?></a>
                                            </span>
                                                                <span class="course-author float-right">
                                                 <?php echo e($item->students()->count()); ?>

                                                                    <?php echo app('translator')->getFromJson('labels.backend.dashboard.students'); ?>
                                            </span>
                                                            </div>

                                                            <div class="progress my-2">
                                                                <div class="progress-bar"
                                                                     style="width:<?php echo e($item->progress()); ?>%"><?php echo e($item->progress()); ?>

                                                                    %
                                                                    <?php echo app('translator')->getFromJson('labels.backend.dashboard.completed'); ?>
                                                                </div>
                                                            </div>
                                                            <?php if($item->progress() == 100): ?>
                                                                <?php if(!$item->isUserCertified()): ?>
                                                                    <form method="post"
                                                                          action="<?php echo e(route('admin.certificates.generate')); ?>">
                                                                        <?php echo csrf_field(); ?>
                                                                        <input type="hidden" value="<?php echo e($item->id); ?>"
                                                                               name="course_id">
                                                                        <button class="btn btn-success btn-block text-white mb-3 text-uppercase font-weight-bold"
                                                                                id="finish"><?php echo app('translator')->getFromJson('labels.frontend.course.finish_course'); ?></button>
                                                                    </form>
                                                                <?php else: ?>
                                                                    <div class="alert alert-success px-1 text-center mb-0">
                                                                        <?php echo app('translator')->getFromJson('labels.frontend.course.certified'); ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>
                    <?php elseif(auth()->user()->hasRole('teacher')): ?>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-3 col-12 border-right">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card text-white bg-primary text-center">
                                                <div class="card-body">
                                                    <h2 class=""><?php echo e(count(auth()->user()->courses) + count(auth()->user()->bundles)); ?></h2>
                                                    <h5><?php echo app('translator')->getFromJson('labels.backend.dashboard.your_courses_and_bundles'); ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card text-white bg-success text-center">
                                                <div class="card-body">
                                                    <h2 class=""><?php echo e($students_count); ?></h2>
                                                    <h5><?php echo app('translator')->getFromJson('labels.backend.dashboard.students_enrolled'); ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 col-12 border-right">
                                    <div class="d-inline-block form-group w-100">
                                        <h4 class="mb-0"><?php echo app('translator')->getFromJson('labels.backend.dashboard.recent_reviews'); ?> <a
                                                    class="btn btn-primary float-right"
                                                    href="<?php echo e(route('admin.reviews.index')); ?>"><?php echo app('translator')->getFromJson('labels.backend.dashboard.view_all'); ?></a>
                                        </h4>

                                    </div>
                                    <table class="table table-responsive-sm table-striped">
                                        <thead>
                                        <tr>
                                            <td><?php echo app('translator')->getFromJson('labels.backend.dashboard.course'); ?></td>
                                            <td><?php echo app('translator')->getFromJson('labels.backend.dashboard.review'); ?></td>
                                            <td><?php echo app('translator')->getFromJson('labels.backend.dashboard.time'); ?></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(count($recent_reviews) > 0): ?>
                                            <?php $__currentLoopData = $recent_reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>
                                                        <a target="_blank"
                                                           href="<?php echo e(route('courses.show',[$item->reviewable->slug])); ?>"><?php echo e($item->reviewable->title); ?></a>
                                                    </td>
                                                    <td><?php echo e($item->content); ?></td>
                                                    <td><?php echo e($item->created_at->diffforhumans()); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="3"><?php echo app('translator')->getFromJson('labels.backend.dashboard.no_data'); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="d-inline-block form-group w-100">
                                        <h4 class="mb-0"><?php echo app('translator')->getFromJson('labels.backend.dashboard.recent_messages'); ?> <a
                                                    class="btn btn-primary float-right"
                                                    href="<?php echo e(route('admin.messages')); ?>"><?php echo app('translator')->getFromJson('labels.backend.dashboard.view_all'); ?></a>
                                        </h4>
                                    </div>


                                    <table class="table table-responsive-sm table-striped">
                                        <thead>
                                        <tr>
                                            <td><?php echo app('translator')->getFromJson('labels.backend.dashboard.message_by'); ?></td>
                                            <td><?php echo app('translator')->getFromJson('labels.backend.dashboard.message'); ?></td>
                                            <td><?php echo app('translator')->getFromJson('labels.backend.dashboard.time'); ?></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(count($threads) > 0): ?>
                                            <?php $__currentLoopData = $threads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>
                                                        <a target="_blank"
                                                           href="<?php echo e(asset('/user/messages/?thread='.$item->id)); ?>"><?php echo e($item->title); ?></a>
                                                    </td>
                                                    <td><?php echo e($item->lastMessage->body); ?></td>
                                                    <td><?php echo e($item->lastMessage->created_at->diffForHumans()); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="3"><?php echo app('translator')->getFromJson('labels.backend.dashboard.no_data'); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    <?php elseif(auth()->user()->hasRole('administrator')): ?>
                        <div class="col-md-4 col-12">
                            <div class="card text-white bg-dark text-center py-3">
                                <div class="card-body">
                                    <h1 class=""><?php echo e($courses_count); ?></h1>
                                    <h3><?php echo app('translator')->getFromJson('labels.backend.dashboard.course_and_bundles'); ?></h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-12">
                            <div class="card text-white bg-light text-dark text-center py-3">
                                <div class="card-body">
                                    <h1 class=""><?php echo e($students_count); ?></h1>
                                    <h3><?php echo app('translator')->getFromJson('labels.backend.dashboard.students'); ?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="card text-white bg-primary text-center py-3">
                                <div class="card-body">
                                    <h1 class=""><?php echo e($teachers_count); ?></h1>
                                    <h3><?php echo app('translator')->getFromJson('labels.backend.dashboard.teachers'); ?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 border-right">
                            <div class="d-inline-block form-group w-100">
                                <h4 class="mb-0"><?php echo app('translator')->getFromJson('labels.backend.dashboard.recent_orders'); ?> <a
                                            class="btn btn-primary float-right"
                                            href="<?php echo e(route('admin.orders.index')); ?>"><?php echo app('translator')->getFromJson('labels.backend.dashboard.view_all'); ?></a>
                                </h4>

                            </div>
                            <table class="table table-responsive-sm table-striped">
                                <thead>
                                <tr>
                                    <td><?php echo app('translator')->getFromJson('labels.backend.dashboard.ordered_by'); ?></td>
                                    <td><?php echo app('translator')->getFromJson('labels.backend.dashboard.amount'); ?></td>
                                    <td><?php echo app('translator')->getFromJson('labels.backend.dashboard.time'); ?></td>
                                    <td><?php echo app('translator')->getFromJson('labels.backend.dashboard.view'); ?></td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(count($recent_orders) > 0): ?>
                                    <?php $__currentLoopData = $recent_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <?php echo e($item->user->full_name); ?>

                                            </td>
                                            <td><?php echo e($item->amount.' '.$appCurrency['symbol']); ?></td>
                                            <td><?php echo e($item->created_at->diffforhumans()); ?></td>
                                            <td><a class="btn btn-sm btn-primary"
                                                   href="<?php echo e(route('admin.orders.show', $item->id)); ?>" target="_blank"><i
                                                            class="fa fa-arrow-right"></i></a></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4"><?php echo app('translator')->getFromJson('labels.backend.dashboard.no_data'); ?></td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="d-inline-block form-group w-100">
                                <h4 class="mb-0"><?php echo app('translator')->getFromJson('labels.backend.dashboard.recent_contact_requests'); ?> <a
                                            class="btn btn-primary float-right"
                                            href="<?php echo e(route('admin.contact-requests.index')); ?>"><?php echo app('translator')->getFromJson('labels.backend.dashboard.view_all'); ?></a>
                                </h4>

                            </div>
                            <table class="table table-responsive-sm table-striped">
                                <thead>
                                <tr>
                                    <td><?php echo app('translator')->getFromJson('labels.backend.dashboard.name'); ?></td>
                                    <td><?php echo app('translator')->getFromJson('labels.backend.dashboard.email'); ?></td>
                                    <td><?php echo app('translator')->getFromJson('labels.backend.dashboard.message'); ?></td>
                                    <td><?php echo app('translator')->getFromJson('labels.backend.dashboard.time'); ?></td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(count($recent_contacts) > 0): ?>
                                    <?php $__currentLoopData = $recent_contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <?php echo e($item->name); ?>

                                            </td>
                                            <td><?php echo e($item->email); ?></td>
                                            <td><?php echo e($item->message); ?></td>
                                            <td><?php echo e($item->created_at->diffforhumans()); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4"><?php echo app('translator')->getFromJson('labels.backend.dashboard.no_data'); ?></td>

                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                    <?php else: ?>
                        <div class="col-12">
                            <h1><?php echo app('translator')->getFromJson('labels.backend.dashboard.title'); ?></h1>
                        </div>
                    <?php endif; ?>
                </div>
            </div><!--card-body-->
        </div><!--card-->
    </div><!--col-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>