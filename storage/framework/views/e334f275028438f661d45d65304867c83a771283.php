<!-- Start of footer area
    ============================================= -->
<?php
    $footer_data = json_decode(config('footer_data'));
?>
<?php if($footer_data != ""): ?>
<footer>
    <section id="footer-area" class="footer-area-section">
        <div class="container">
            <div class="footer-content pb10">
                <div class="row">
                    <div class="col-md-4">
                        <div class="footer-widget ">
                            <div class="footer-logo mb35">
                                <img src="<?php echo e(asset("storage/logos/".config('logo_b_image'))); ?>" alt="logo">
                            </div>
                            <?php if($footer_data->short_description->status == 1): ?>
                                <div class="footer-about-text">
                                    <p><?php echo $footer_data->short_description->text; ?> </p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <?php if($footer_data->section1->status == 1): ?>
                                <?php
                                    $section_data = section_filter($footer_data->section1)
                                ?>

                                <?php echo $__env->make('frontend.layouts.partials.footer_section',['section_data' => $section_data], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endif; ?>

                            <?php if($footer_data->section2->status == 1): ?>
                                <?php
                                    $section_data = section_filter($footer_data->section2)
                                ?>

                                <?php echo $__env->make('frontend.layouts.partials.footer_section',['section_data' => $section_data], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endif; ?>

                            <?php if($footer_data->section3->status == 1): ?>
                                <?php
                                    $section_data = section_filter($footer_data->section3)
                                ?>

                                <?php echo $__env->make('frontend.layouts.partials.footer_section',['section_data' => $section_data], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /footer-widget-content -->
            <div class="footer-social-subscribe mb65">
                <div class="row">
                    <?php if(($footer_data->social_links->status == 1) && (count($footer_data->social_links->links) > 0)): ?>
                        <div class="col-md-4">
                            <div class="footer-social ul-li ">
                                <h2 class="widget-title"><?php echo app('translator')->getFromJson('labels.frontend.layouts.partials.social_network'); ?></h2>
                                <ul>
                                    <?php $__currentLoopData = $footer_data->social_links->links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><a href="<?php echo e($item->link); ?>"><i class="<?php echo e($item->icon); ?>"></i></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if($footer_data->newsletter_form->status == 1): ?>
                        <div class="col-md-8">
                            <div class="subscribe-form ml-0 ">
                                <h2 class="widget-title"><?php echo app('translator')->getFromJson('labels.frontend.layouts.partials.subscribe_newsletter'); ?></h2>

                                <div class="subs-form relative-position">
                                    <form action="<?php echo e(route("subscribe")); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <input class="email" required name="subs_email" type="email" placeholder="<?php echo app('translator')->getFromJson('labels.frontend.layouts.partials.email_address'); ?>.">
                                        <div class="nws-button text-center  gradient-bg text-uppercase">
                                            <button type="submit" value="Submit"><?php echo app('translator')->getFromJson('labels.frontend.layouts.partials.subscribe_now'); ?></button>
                                        </div>
                                        <?php if($errors->has('email')): ?>
                                            <p class="text-danger text-left"><?php echo e($errors->first('email')); ?></p>
                                        <?php endif; ?>
                                    </form>

                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if($footer_data->bottom_footer->status == 1): ?>
            <div class="copy-right-menu">
                <div class="row">
                    <?php if($footer_data->copyright_text->status == 1): ?>
                    <div class="col-md-6">
                        <div class="copy-right-text">
                            <p>Powered By <a href="" target="_blank" class="mr-4"> NettoLMS</a>  <?php echo $footer_data->copyright_text->text; ?></p>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if(($footer_data->bottom_footer_links->status == 1) && (count($footer_data->bottom_footer_links->links) > 0)): ?>
                    <div class="col-md-6">
                        <div class="copy-right-menu-item float-right ul-li">
                            <ul>
                                <?php $__currentLoopData = $footer_data->bottom_footer_links->links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <!--<li><a href="<?php echo e($item->link); ?>"><?php echo e($item->label); ?></a></li>-->
                                <!--<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
                                <!--<?php if(config('show_offers')): ?>-->
                                <!--    <li><a href="<?php echo e(route('frontend.offers')); ?>"><?php echo app('translator')->getFromJson('labels.frontend.layouts.partials.offers'); ?></a> </li>-->
                                <?php endif; ?>
                                <li><a href="<?php echo e(route('frontend.certificates.getVerificationForm')); ?>"><?php echo app('translator')->getFromJson('labels.frontend.layouts.partials.certificate_verification'); ?></a></li>
                            </ul>
                        </div>
                    </div>
                     <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </section>
</footer>
<?php endif; ?>
<!-- End of footer area
============================================= -->