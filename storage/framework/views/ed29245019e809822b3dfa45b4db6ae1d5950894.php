<?php $request = app('Illuminate\Http\Request'); ?>

<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">
                <?php echo app('translator')->getFromJson('menus.backend.sidebar.general'); ?>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(active_class(Active::checkUriPattern('admin/dashboard'))); ?>"
                   href="<?php echo e(route('admin.dashboard')); ?>">
                    <i class="nav-icon icon-speedometer"></i> <?php echo app('translator')->getFromJson('menus.backend.sidebar.dashboard'); ?>
                </a>
            </li>


            <!--=======================Custom menus===============================-->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order_access')): ?>
                <li class="nav-item ">
                    <a class="nav-link <?php echo e($request->segment(1) == 'orders' ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.orders.index')); ?>">
                        <i class="nav-icon icon-bag"></i>
                        <span class="title"><?php echo app('translator')->getFromJson('menus.backend.sidebar.orders.title'); ?></span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if($logged_in_user->isAdmin()): ?>
                <li class="nav-item ">
                    <a class="nav-link <?php echo e($request->segment(2) == 'teachers' ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.teachers.index')); ?>">
                        <i class="nav-icon icon-directions"></i>
                        <span class="title"><?php echo app('translator')->getFromJson('menus.backend.sidebar.teachers.title'); ?></span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category_access')): ?>
                <li class="nav-item ">
                    <a class="nav-link <?php echo e($request->segment(2) == 'categories' ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.categories.index')); ?>">
                        <i class="nav-icon icon-folder-alt"></i>
                        <span class="title"><?php echo app('translator')->getFromJson('menus.backend.sidebar.categories.title'); ?></span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if($logged_in_user->hasRole('teacher') || $logged_in_user->isAdmin()): ?>

                <li class="nav-item nav-dropdown <?php echo e(active_class(Active::checkUriPattern(['user/courses*','user/lessons*','user/tests*','user/questions*']), 'open')); ?>">
                    <a class="nav-link nav-dropdown-toggle <?php echo e(active_class(Active::checkUriPattern('admin/*'))); ?>"
                       href="#">
                        <i class="nav-icon icon-puzzle"></i> <?php echo app('translator')->getFromJson('menus.backend.sidebar.courses.management'); ?>


                    </a>

                    <ul class="nav-dropdown-items">

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('course_access')): ?>
                            <li class="nav-item ">
                                <a class="nav-link <?php echo e($request->segment(2) == 'courses' ? 'active' : ''); ?>"
                                   href="<?php echo e(route('admin.courses.index')); ?>">
                                    <span class="title"><?php echo app('translator')->getFromJson('menus.backend.sidebar.courses.title'); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('lesson_access')): ?>
                            <li class="nav-item ">
                                <a class="nav-link <?php echo e($request->segment(2) == 'lessons' ? 'active' : ''); ?>"
                                   href="<?php echo e(route('admin.lessons.index')); ?>">
                                    <span class="title"><?php echo app('translator')->getFromJson('menus.backend.sidebar.lessons.title'); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('test_access')): ?>
                            <li class="nav-item ">
                                <a class="nav-link <?php echo e($request->segment(2) == 'tests' ? 'active' : ''); ?>"
                                   href="<?php echo e(route('admin.tests.index')); ?>">
                                    <span class="title"><?php echo app('translator')->getFromJson('menus.backend.sidebar.tests.title'); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>


                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('question_access')): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e($request->segment(2) == 'questions' ? 'active' : ''); ?>"
                                   href="<?php echo e(route('admin.questions.index')); ?>">
                                    <span class="title"><?php echo app('translator')->getFromJson('menus.backend.sidebar.questions.title'); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>

                    </ul>
                </li>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('bundle_access')): ?>
                    <li class="nav-item ">
                        <a class="nav-link <?php echo e($request->segment(2) == 'bundles' ? 'active' : ''); ?>"
                           href="<?php echo e(route('admin.bundles.index')); ?>">
                            <i class="nav-icon icon-layers"></i>
                            <span class="title"><?php echo app('translator')->getFromJson('menus.backend.sidebar.bundles.title'); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="nav-item nav-dropdown <?php echo e(active_class(Active::checkUriPattern(['user/reports*']), 'open')); ?>">
                    <a class="nav-link nav-dropdown-toggle <?php echo e(active_class(Active::checkUriPattern('admin/*'))); ?>"
                       href="#">
                        <i class="nav-icon icon-pie-chart"></i><?php echo app('translator')->getFromJson('menus.backend.sidebar.reports.title'); ?>

                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item ">
                            <a class="nav-link <?php echo e($request->segment(1) == 'sales' ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.reports.sales')); ?>">
                                <?php echo app('translator')->getFromJson('menus.backend.sidebar.reports.sales'); ?>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link <?php echo e($request->segment(1) == 'students' ? 'active' : ''); ?>"
                               href="<?php echo e(route('admin.reports.students')); ?>"><?php echo app('translator')->getFromJson('menus.backend.sidebar.reports.students'); ?>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>




            <?php if($logged_in_user->isAdmin() || $logged_in_user->hasAnyPermission(['blog_access','page_access','reason_access'])): ?>
                <li class="nav-item nav-dropdown <?php echo e(active_class(Active::checkUriPattern(['user/contact','user/sponsors*','user/testimonials*','user/faqs*','user/footer*','user/blogs','user/sitemap*']), 'open')); ?>">
                    <a class="nav-link nav-dropdown-toggle <?php echo e(active_class(Active::checkUriPattern('admin/*'))); ?>"
                       href="#">
                        <i class="nav-icon icon-note"></i> <?php echo app('translator')->getFromJson('menus.backend.sidebar.site-management.title'); ?>
                    </a>

                    <ul class="nav-dropdown-items">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page_access')): ?>
                            <li class="nav-item ">
                                <a class="nav-link <?php echo e($request->segment(2) == 'pages' ? 'active' : ''); ?>"
                                   href="<?php echo e(route('admin.pages.index')); ?>">
                                    <span class="title"><?php echo app('translator')->getFromJson('menus.backend.sidebar.pages.title'); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog_access')): ?>
                            <li class="nav-item ">
                                <a class="nav-link <?php echo e($request->segment(2) == 'blogs' ? 'active' : ''); ?>"
                                   href="<?php echo e(route('admin.blogs.index')); ?>">
                                    <span class="title"><?php echo app('translator')->getFromJson('menus.backend.sidebar.blogs.title'); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('reason_access')): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e($request->segment(2) == 'reasons' ? 'active' : ''); ?>"
                                   href="<?php echo e(route('admin.reasons.index')); ?>">
                                    <span class="title"><?php echo app('translator')->getFromJson('menus.backend.sidebar.reasons.title'); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if($logged_in_user->isAdmin()): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e(active_class(Active::checkUriPattern('admin/menu-manager'))); ?>"
                                   href="<?php echo e(route('admin.menu-manager')); ?>"> <?php echo e(__('menus.backend.sidebar.menu-manager.title')); ?></a>
                            </li>


                            <li class="nav-item ">
                                <a class="nav-link <?php echo e(active_class(Active::checkUriPattern('admin/sliders*'))); ?>"
                                   href="<?php echo e(route('admin.sliders.index')); ?>">
                                    <span class="title"><?php echo app('translator')->getFromJson('menus.backend.sidebar.hero-slider.title'); ?></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link <?php echo e($request->segment(2) == 'sponsors' ? 'active' : ''); ?>"
                                   href="<?php echo e(route('admin.sponsors.index')); ?>">
                                    <span class="title"><?php echo app('translator')->getFromJson('menus.backend.sidebar.sponsors.title'); ?></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link <?php echo e($request->segment(2) == 'testimonials' ? 'active' : ''); ?>"
                                   href="<?php echo e(route('admin.testimonials.index')); ?>">
                                    <span class="title"><?php echo app('translator')->getFromJson('menus.backend.sidebar.testimonials.title'); ?></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link <?php echo e($request->segment(2) == 'faqs' ? 'active' : ''); ?>"
                                   href="<?php echo e(route('admin.faqs.index')); ?>">
                                    <span class="title"><?php echo app('translator')->getFromJson('menus.backend.sidebar.faqs.title'); ?></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link <?php echo e($request->segment(2) == 'contact' ? 'active' : ''); ?>"
                                   href="<?php echo e(route('admin.contact-settings')); ?>">
                                    <span class="title"><?php echo app('translator')->getFromJson('menus.backend.sidebar.contact.title'); ?></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link <?php echo e($request->segment(2) == 'newsletter' ? 'active' : ''); ?>"
                                   href="<?php echo e(route('admin.newsletter-settings')); ?>">
                                    <span class="title"><?php echo app('translator')->getFromJson('menus.backend.sidebar.newsletter-configuration.title'); ?></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link <?php echo e($request->segment(2) == 'footer' ? 'active' : ''); ?>"
                                   href="<?php echo e(route('admin.footer-settings')); ?>">
                                    <span class="title"><?php echo app('translator')->getFromJson('menus.backend.sidebar.footer.title'); ?></span>
                                </a>
                            </li>
                                <li class="nav-item ">
                                    <a class="nav-link <?php echo e($request->segment(2) == 'sitemap' ? 'active' : ''); ?>"
                                       href="<?php echo e(route('admin.sitemap.index')); ?>">
                                        <span class="title"><?php echo app('translator')->getFromJson('menus.backend.sidebar.sitemap.title'); ?></span>
                                    </a>
                                </li>
                        <?php endif; ?>

                    </ul>


                </li>
            <?php else: ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog_access')): ?>
                    <li class="nav-item ">
                        <a class="nav-link <?php echo e($request->segment(2) == 'blogs' ? 'active' : ''); ?>"
                           href="<?php echo e(route('admin.blogs.index')); ?>">
                            <i class="nav-icon icon-note"></i>
                            <span class="title"><?php echo app('translator')->getFromJson('menus.backend.sidebar.blogs.title'); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('reason_access')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e($request->segment(2) == 'reasons' ? 'active' : ''); ?>"
                           href="<?php echo e(route('admin.reasons.index')); ?>">
                            <i class="nav-icon icon-layers"></i>
                            <span class="title"><?php echo app('translator')->getFromJson('menus.backend.sidebar.reasons.title'); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>

            <li class="nav-item ">
                <a class="nav-link <?php echo e($request->segment(1) == 'messages' ? 'active' : ''); ?>"
                   href="<?php echo e(route('admin.messages')); ?>">
                    <i class="nav-icon icon-envelope-open"></i> <span
                            class="title"><?php echo app('translator')->getFromJson('menus.backend.sidebar.messages.title'); ?></span>
                </a>
            </li>
            <?php if($logged_in_user->hasRole('student')): ?>
                <li class="nav-item ">
                    <a class="nav-link <?php echo e($request->segment(1) == 'invoices' ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.invoices.index')); ?>">
                        <i class="nav-icon icon-notebook"></i> <span
                                class="title"><?php echo app('translator')->getFromJson('menus.backend.sidebar.invoices.title'); ?></span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link <?php echo e($request->segment(1) == 'certificates' ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.certificates.index')); ?>">
                        <i class="nav-icon icon-badge"></i> <span
                                class="title"><?php echo app('translator')->getFromJson('menus.backend.sidebar.certificates.title'); ?></span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if($logged_in_user->hasRole('teacher')): ?>
                <li class="nav-item ">
                    <a class="nav-link <?php echo e($request->segment(1) == 'reviews' ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.reviews.index')); ?>">
                        <i class="nav-icon icon-speech"></i> <span
                                class="title"><?php echo app('translator')->getFromJson('menus.backend.sidebar.reviews.title'); ?></span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if($logged_in_user->isAdmin()): ?>
                <li class="nav-item ">
                    <a class="nav-link <?php echo e($request->segment(1) == 'contact-requests' ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.contact-requests.index')); ?>">
                        <i class="nav-icon icon-envelope-letter"></i>
                        <span class="title"><?php echo app('translator')->getFromJson('menus.backend.sidebar.contacts.title'); ?></span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link <?php echo e($request->segment(1) == 'contact-requests' ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.coupons.index')); ?>">
                        <i class="nav-icon icon-star"></i>
                        <span class="title"><?php echo app('translator')->getFromJson('menus.backend.sidebar.coupons.title'); ?></span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link <?php echo e($request->segment(1) == 'contact-requests' ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.tax.index')); ?>">
                        <i class="nav-icon icon-credit-card"></i>
                        <span class="title"><?php echo app('translator')->getFromJson('menus.backend.sidebar.tax.title'); ?></span>
                    </a>
                </li>
            <?php endif; ?>
            <li class="nav-item ">
                <a class="nav-link <?php echo e($request->segment(1) == 'account' ? 'active' : ''); ?>"
                   href="<?php echo e(route('admin.account')); ?>">
                    <i class="nav-icon icon-key"></i>
                    <span class="title"><?php echo app('translator')->getFromJson('menus.backend.sidebar.account.title'); ?></span>
                </a>
            </li>
            <?php if($logged_in_user->isAdmin()): ?>


                <li class="nav-title">
                    <?php echo app('translator')->getFromJson('menus.backend.sidebar.system'); ?>
                </li>

                <li class="nav-item nav-dropdown <?php echo e(active_class(Active::checkUriPattern('admin/auth*'), 'open')); ?>">
                    <a class="nav-link nav-dropdown-toggle <?php echo e(active_class(Active::checkUriPattern('admin/auth*'))); ?>"
                       href="#">
                        <i class="nav-icon icon-user"></i> <?php echo app('translator')->getFromJson('menus.backend.access.title'); ?>

                        <?php if($pending_approval > 0): ?>
                            <span class="badge badge-danger"><?php echo e($pending_approval); ?></span>
                        <?php endif; ?>
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(active_class(Active::checkUriPattern('admin/auth/user*'))); ?>"
                               href="<?php echo e(route('admin.auth.user.index')); ?>">
                                <?php echo app('translator')->getFromJson('labels.backend.access.users.management'); ?>

                                <?php if($pending_approval > 0): ?>
                                    <span class="badge badge-danger"><?php echo e($pending_approval); ?></span>
                                <?php endif; ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(active_class(Active::checkUriPattern('admin/auth/role*'))); ?>"
                               href="<?php echo e(route('admin.auth.role.index')); ?>">
                                <?php echo app('translator')->getFromJson('labels.backend.access.roles.management'); ?>
                            </a>
                        </li>
                    </ul>
                </li>


                <!--==================================================================-->
                <li class="divider"></li>

                <li class="nav-item nav-dropdown <?php echo e(active_class(Active::checkUriPattern('admin/*'), 'open')); ?>">
                    <a class="nav-link nav-dropdown-toggle <?php echo e(active_class(Active::checkUriPattern('admin/settings*'))); ?>"
                       href="#">
                        <i class="nav-icon icon-settings"></i> <?php echo app('translator')->getFromJson('menus.backend.sidebar.settings.title'); ?>
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(active_class(Active::checkUriPattern('admin/settings'))); ?>"
                               href="<?php echo e(route('admin.general-settings')); ?>">
                                <?php echo app('translator')->getFromJson('menus.backend.sidebar.settings.general'); ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(active_class(Active::checkUriPattern('admin/log-viewer/logs*'))); ?>"
                               href="<?php echo e(route('admin.social-settings')); ?>">
                                <?php echo app('translator')->getFromJson('menus.backend.sidebar.settings.social-login'); ?>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item nav-dropdown <?php echo e(active_class(Active::checkUriPattern('admin/log-viewer*'), 'open')); ?>">
                    <a class="nav-link nav-dropdown-toggle <?php echo e(active_class(Active::checkUriPattern('admin/log-viewer*'))); ?>"
                       href="#">
                        <i class="nav-icon icon-list"></i> <?php echo app('translator')->getFromJson('menus.backend.sidebar.debug-site.title'); ?>
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(active_class(Active::checkUriPattern('admin/log-viewer'))); ?>"
                               href="<?php echo e(route('log-viewer::dashboard')); ?>">
                                <?php echo app('translator')->getFromJson('menus.backend.log-viewer.dashboard'); ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(active_class(Active::checkUriPattern('admin/log-viewer/logs*'))); ?>"
                               href="<?php echo e(route('log-viewer::logs.list')); ?>">
                                <?php echo app('translator')->getFromJson('menus.backend.log-viewer.logs'); ?>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item ">
                    <a class="nav-link <?php echo e($request->segment(1) == 'translation-manager' ? 'active' : ''); ?>"
                       href="<?php echo e(asset('user/translations')); ?>">
                        <i class="nav-icon icon-docs"></i>
                        <span class="title"><?php echo app('translator')->getFromJson('menus.backend.sidebar.translations.title'); ?></span>
                    </a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link <?php echo e($request->segment(1) == 'backup' ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.backup')); ?>">
                        <i class="nav-icon icon-shield"></i>
                        <span class="title"><?php echo app('translator')->getFromJson('menus.backend.sidebar.backup.title'); ?></span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link <?php echo e($request->segment(1) == 'update-theme' ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.update-theme')); ?>">
                        <i class="nav-icon icon-refresh"></i>
                        <span class="title"><?php echo app('translator')->getFromJson('menus.backend.sidebar.update.title'); ?></span>
                    </a>
                </li>
            <?php endif; ?>

        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->
