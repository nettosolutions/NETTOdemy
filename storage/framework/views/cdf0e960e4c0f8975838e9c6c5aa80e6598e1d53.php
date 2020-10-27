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
						<h2 class="breadcrumb-head black bold"><?php echo e(env('APP_NAME')); ?> <span><?php echo app('translator')->getFromJson('labels.frontend.teacher.title'); ?></span></h2>
					</div>
				</div>
			</div>
		</section>
	<!-- End of breadcrumb section
		============================================= -->



	<!-- Start of teacher section
		============================================= -->
		<section id="teacher-page" class="teacher-page-section">
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						<div class="teachers-archive">
							<div class="row">
                                <?php if(count($teachers) > 0): ?>
                                <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="col-md-4 col-sm-6">
									<div class="teacher-pic-content">
										<div class="teacher-img-content relative-position">
											<img src="<?php echo e($item->picture); ?>" alt="">
											<div class="teacher-hover-item">
												<div class="teacher-social-name ul-li-block">
													<ul>
                                                        <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                                                        <li><a href="<?php echo e(route('admin.messages',['teacher_id'=>$item->id])); ?>"><i class="fa fa-comments"></i></a></li>
													</ul>
												</div>
												
													
												
											</div>
											<div class="teacher-next text-center">
												<a href="<?php echo e(route('teachers.show',['id'=>$item->id])); ?>"><i class="text-gradiant fas fa-arrow-right"></i></a>
											</div>
										</div>
										<div class="teacher-name-designation">
											<span class="teacher-name"><?php echo e($item->full_name); ?></span>
											
										</div>
									</div>
								</div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <h4><?php echo app('translator')->getFromJson('lables.general.no_data_available'); ?></h4>
                                <?php endif; ?>


							</div>
							<div class="couse-pagination text-center ul-li">
                                <?php echo e($teachers->links()); ?>

							</div>
							
						</div>
					</div>
					<?php echo $__env->make('frontend.layouts.partials.right-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
			</div>
		</section>
	<!-- End of teacher section
		============================================= -->



<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app'.config('theme_layout'), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>