<section id="contact-area" class="contact-area-section backgroud-style">
    <div class="container">
        <div class="contact-area-content">
            <div class="row">
                <?php if(config('contact_data') != ""): ?>
                    <?php
                        $contact_data = contact_data(config('contact_data'));
                    ?>
                    <div class="col-md-6">
                        <div class="contact-left-content ">
                            <div class="section-title  mb45 headline text-left">
                                <span class="subtitle ml42  text-uppercase"><?php echo app('translator')->getFromJson('labels.frontend.layouts.partials.contact_us'); ?></span>
                                <h2><span><?php echo app('translator')->getFromJson('labels.frontend.layouts.partials.get_in_touch'); ?></span></h2>
                                <p>
                                    <?php echo e($contact_data["short_text"]["value"]); ?>

                                </p>
                            </div>

                            <div class="contact-address">
                                <?php if(($contact_data["primary_address"]["status"] == 1) || ($contact_data["secondary_address"]["status"] == 1)): ?>
                                    <div class="contact-address-details">

                                        <div class="address-icon relative-position text-center float-left">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <div class="address-details ul-li-block">
                                            <ul>
                                                <?php if($contact_data["primary_address"]["status"] == 1): ?>
                                                    <li>
                                                        <span><?php echo app('translator')->getFromJson('labels.frontend.layouts.partials.primary'); ?>: </span><?php echo e($contact_data["primary_address"]["value"]); ?>

                                                    </li>
                                                <?php endif; ?>

                                                <?php if($contact_data["secondary_address"]["status"] == 1): ?>
                                                    <li>
                                                        <span><?php echo app('translator')->getFromJson('labels.frontend.layouts.partials.second'); ?>: </span><?php echo e($contact_data["secondary_address"]["value"]); ?>

                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if(($contact_data["primary_phone"]["status"] == 1) || ($contact_data["secondary_phone"]["status"] == 1)): ?>
                                    <div class="contact-address-details">
                                        <div class="address-icon relative-position text-center float-left">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                        <div class="address-details ul-li-block">
                                            <ul>
                                                <?php if($contact_data["primary_phone"]["status"] == 1): ?>
                                                    <li>
                                                        <span><?php echo app('translator')->getFromJson('labels.frontend.layouts.partials.primary'); ?>: </span><?php echo e($contact_data["primary_phone"]["value"]); ?>

                                                    </li>
                                                <?php endif; ?>

                                                <?php if($contact_data["secondary_phone"]["status"] == 1): ?>
                                                    <li>
                                                        <span><?php echo app('translator')->getFromJson('labels.frontend.layouts.partials.second'); ?>: </span><?php echo e($contact_data["secondary_phone"]["value"]); ?>

                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if(($contact_data["primary_email"]["status"] == 1) || ($contact_data["secondary_email"]["status"] == 1)): ?>

                                    <div class="contact-address-details">
                                        <div class="address-icon relative-position text-center float-left">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <div class="address-details ul-li-block">
                                            <ul>
                                                <?php if($contact_data["primary_email"]["status"] == 1): ?>
                                                    <li>
                                                        <span><?php echo app('translator')->getFromJson('labels.frontend.layouts.partials.primary'); ?>: </span><?php echo e($contact_data["primary_email"]["value"]); ?>

                                                    </li>
                                                <?php endif; ?>

                                                <?php if($contact_data["secondary_email"]["status"] == 1): ?>
                                                    <li>
                                                        <span><?php echo app('translator')->getFromJson('labels.frontend.layouts.partials.second'); ?>: </span><?php echo e($contact_data["secondary_email"]["value"]); ?>

                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="genius-btn mt60 gradient-bg text-center text-uppercase ul-li-block bold-font ">
                            <a href="<?php echo e(route('contact')); ?>"><?php echo app('translator')->getFromJson('labels.frontend.layouts.partials.contact_us'); ?> <i class="fas fa-caret-right"></i></a>
                        </div>
                    </div>
                    <?php if($contact_data["location_on_map"]["status"] == 1): ?>
                        <div class="col-md-6">
                            <div id="contact-map" class="contact-map-section">
                                <?php echo $contact_data["location_on_map"]["value"]; ?>

                            </div>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <h4><?php echo app('translator')->getFromJson('labels.general.no_data_available'); ?></h4>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
