<?php $__env->startSection('title', ($blog->meta_title) ? $blog->meta_title : app_name() ); ?>
<?php $__env->startSection('meta_description', $blog->meta_description); ?>
<?php $__env->startSection('meta_keywords', $blog->meta_keywords); ?>

<?php $__env->startSection('content'); ?>

    <!-- Start of breadcrumb section
    ============================================= -->
    <section id="breadcrumb" class="breadcrumb-section relative-position backgroud-style">
        <div class="blakish-overlay"></div>
        <div class="container">
            <div class="page-breadcrumb-content text-center">
                <div class="page-breadcrumb-title">
                    <h2 class="breadcrumb-head black bold"><?php echo e($blog->title); ?></h2>
                </div>
            </div>
        </div>
    </section>
    <!-- End of breadcrumb section
        ============================================= -->


    <!-- Start of Blog single content
        ============================================= -->
    <section id="blog-detail" class="blog-details-section">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="blog-details-content">
                        <div class="post-content-details">
                            <?php if($blog->image != ""): ?>

                                <div class="blog-detail-thumbnile mb35">
                                    <img src="<?php echo e(asset('storage/uploads/'.$blog->image)); ?>" alt="">
                                </div>
                            <?php endif; ?>

                            <h2><?php echo e($blog->title); ?></h2>

                            <div class="date-meta text-uppercase">
                                <span><i class="fas fa-calendar-alt"></i> <?php echo e($blog->created_at->format('d M Y')); ?></span>
                                <span><i class="fas fa-user"></i> <?php echo e($blog->author->name); ?></span>
                                <span><i class="fas fa-comment-dots"></i> <?php echo e($blog->comments->count()); ?></span>
                                <span><i class="fas fa-tag"><a
                                                href="<?php echo e(route('blogs.category',['category' => $blog->category->slug])); ?>"> <?php echo e($blog->category->name); ?></a></i></span>
                            </div>
                            <p>
                                <?php echo $blog->content; ?>

                            </p>


                        </div>
                        <div class="blog-share-tag">
                            <div class="share-text float-left">
                                <?php echo app('translator')->getFromJson('labels.frontend.blog.share_this_news'); ?>
                            </div>

                            <div class="share-social ul-li float-right">
                                <ul>
                                    <li><a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo e(url()->current()); ?>"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a target="_blank" href="http://twitter.com/share?url=<?php echo e(url()->current()); ?>&text=<?php echo e($blog->title); ?>"><i class="fab fa-twitter"></i></a></li>
                                    <li><a target="_blank" href="http://www.linkedin.com/shareArticle?url=<?php echo e(url()->current()); ?>&title=<?php echo e($blog->title); ?>&summary=<?php echo e(substr(strip_tags($blog->content),0,40)); ?>..."><i class="fab fa-linkedin"></i></a></li>
                                    <li><a target="_blank" href="https://api.whatsapp.com/send?phone=&text=<?php echo e(url()->current()); ?>"><i class="fab fa-whatsapp"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="author-comment d-inline-block p-3   h-100 d-table text-center mx-auto">
                            <div class="author-img float-none">
                                <img src="<?php echo e($blog->author->picture); ?>" alt="">
                            </div>
                            <span class="mt-2  d-table-cell align-middle">BY:  <b><?php echo e($blog->author->name); ?></b></span>
                        </div>

                        <div class="next-prev-post">
                            <?php if($previous != ""): ?>
                                <div class="next-post-item float-left">
                                    <a href="<?php echo e(route('blogs.index',['slug'=>$previous->slug.'-'.$previous->id ])); ?>"><i
                                                class="fas fa-arrow-circle-left"></i>Previous Post</a>
                                </div>
                            <?php endif; ?>

                            <?php if($next != ""): ?>
                                <div class="next-post-item float-right">
                                    <a href="<?php echo e(route('blogs.index',['slug'=>$next->slug.'-'.$next->id ])); ?>">Next Post<i
                                                class="fas fa-arrow-circle-right"></i></a>
                                </div>
                                <?php endif; ?>

                        </div>
                    </div>

                    <div class="blog-recent-post about-teacher-2">
                        <div class="section-title-2  headline text-left">
                            <h2> <?php echo app('translator')->getFromJson('labels.frontend.blog.related_news'); ?></h2>
                        </div>
                        <?php if(count($related_news) > 0): ?>
                            <div class="recent-post-item">
                                <div class="row">
                                    <?php $__currentLoopData = $related_news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-6">
                                            <div class="blog-post-img-content">
                                                <div class="blog-img-date relative-position">
                                                    <div class="blog-thumnile" <?php if($item->image != ""): ?> style="background-image: url(<?php echo e(asset('storage/uploads/'.$item->image)); ?>)" <?php endif; ?>></div>

                                                    <div class="course-price text-center gradient-bg">
                                                        <span><?php echo e($item->created_at->format('d M Y')); ?></span>
                                                    </div>
                                                </div>
                                                <div class="blog-title-content headline">
                                                    <h3>
                                                        <a href="<?php echo e(route('blogs.index',['slug'=>$item->slug.'-'.$item->id ])); ?>"><?php echo e($item->title); ?></a>
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="blog-comment-area ul-li about-teacher-2">
                        <div class="reply-comment-box">
                            <div class="section-title-2  headline text-left">
                                <h2> <?php echo app('translator')->getFromJson('labels.frontend.blog.post_comments'); ?></h2>
                            </div>

                            <?php if(auth()->check()): ?>
                                <div class="teacher-faq-form">
                                    <form method="POST" action="<?php echo e(route('blogs.comment',['id'=>$blog->id])); ?>"
                                          data-lead="Residential">
                                        <?php echo csrf_field(); ?>
                                        <div class="form-group">
                                            <label for="comment"> <?php echo app('translator')->getFromJson('labels.frontend.blog.write_a_comment'); ?></label>
                                            <textarea name="comment" required class="mb-0" id="comment" rows="2"
                                                      cols="20"></textarea>
                                            <span class="help-block text-danger"><?php echo e($errors->first('comment', ':message')); ?></span>
                                        </div>

                                        <div class="nws-button text-center  gradient-bg text-uppercase">
                                            <button type="submit" value="Submit"> <?php echo app('translator')->getFromJson('labels.frontend.blog.add_comment'); ?></button>
                                        </div>
                                    </form>
                                </div>
                            <?php else: ?>
                                <a id="openLoginModal" class="btn nws-button gradient-bg text-white"
                                   data-target="#myModal"> <?php echo app('translator')->getFromJson('labels.frontend.blog.login_to_post_a_comment'); ?></a>
                            <?php endif; ?>
                        </div>
                        <?php if($blog->comments->count() > 0): ?>

                        <ul class="comment-list my-5">
                                <?php $__currentLoopData = $blog->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="d-block">
                                    <div class="comment-avater">
                                        <img src="<?php echo e($item->user->picture); ?>" alt="">
                                    </div>

                                    <div class="author-name-rate">
                                        <div class="author-name float-left">
                                            <?php echo app('translator')->getFromJson('labels.frontend.blog.by'); ?>: <span><?php echo e($item->name); ?></span>
                                        </div>

                                        <div class="time-comment float-right"><?php echo e($item->created_at->diffforhumans()); ?></div><br>
                                        <?php if($item->user_id == auth()->user()->id): ?>
                                        <div class="time-comment float-right">

                                            <a class="text-danger font-weight-bolf" href="<?php echo e(route('blogs.comment.delete',['id'=>$item->id])); ?>"> <?php echo app('translator')->getFromJson('labels.general.delete'); ?></a>

                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="author-designation-comment">
                                        <p><?php echo e($item->comment); ?></p>
                                    </div>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                        </ul>
                        <?php else: ?>
                            <p class="my-5"><?php echo app('translator')->getFromJson('labels.frontend.blog.no_comments_yet'); ?></p>
                        <?php endif; ?>



                    </div>
                </div>
                <?php echo $__env->make('frontend.blogs.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </div>
    </section>
    <!-- End of Blog single content
        ============================================= -->


<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app'.config('theme_layout'), \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>