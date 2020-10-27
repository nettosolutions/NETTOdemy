<!DOCTYPE html>
<?php if (\Illuminate\Support\Facades\Blade::check('langrtl')): ?>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" dir="rtl">
<?php else: ?>
    <html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <?php endif; ?>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <?php if(config('favicon_image') != ""): ?>
            <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('storage/logos/'.config('favicon_image'))); ?>"/>
        <?php endif; ?>
        <title><?php echo $__env->yieldContent('title', app_name()); ?></title>
        <meta name="description" content="<?php echo $__env->yieldContent('meta_description', ''); ?>">
        <meta name="keywords" content="<?php echo $__env->yieldContent('meta_keywords', ''); ?>">

        
        <?php echo $__env->yieldPushContent('before-styles'); ?>

    <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->


        <link rel="stylesheet" href="<?php echo e(asset('assets-rtl/css/owl.carousel.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets-rtl/css/fontawesome-all.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets-rtl/css/flaticon.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets-rtl/css/meanmenu.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets-rtl/css/bootstrap.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets-rtl/css/video.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets-rtl/css/lightbox.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets-rtl/css/progess.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets-rtl/css/animate.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets-rtl/css/slider.css')); ?>">

        <link rel="stylesheet" href="<?php echo e(asset('assets-rtl/css/style.css')); ?>">

        

        <link rel="stylesheet" href="<?php echo e(asset('assets-rtl/css/responsive.css')); ?>">
        
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/colors/switch.css')); ?>">

        <link href="<?php echo e(asset('assets/css/colors/color-2.css')); ?>" rel="alternate stylesheet" type="text/css"
              title="color-2">
        <link href="<?php echo e(asset('assets/css/colors/color-3.css')); ?>" rel="alternate stylesheet" type="text/css"
              title="color-3">
        <link href="<?php echo e(asset('assets/css/colors/color-4.css')); ?>" rel="alternate stylesheet" type="text/css"
              title="color-4">
        <link href="<?php echo e(asset('assets/css/colors/color-5.css')); ?>" rel="alternate stylesheet" type="text/css"
              title="color-5">
        <link href="<?php echo e(asset('assets/css/colors/color-6.css')); ?>" rel="alternate stylesheet" type="text/css"
              title="color-6">
        <link href="<?php echo e(asset('assets/css/colors/color-7.css')); ?>" rel="alternate stylesheet" type="text/css"
              title="color-7">
        <link href="<?php echo e(asset('assets/css/colors/color-8.css')); ?>" rel="alternate stylesheet" type="text/css"
              title="color-8">
        <link href="<?php echo e(asset('assets/css/colors/color-9.css')); ?>" rel="alternate stylesheet" type="text/css"
              title="color-9">

        <?php echo $__env->yieldContent('css'); ?>
        <?php echo $__env->yieldPushContent('after-styles'); ?>

        <?php if(config('google_analytics_id') != ""): ?>
        <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e(config('google_analytics_id')); ?>"></script>
            <script>
                window.dataLayer = window.dataLayer || [];

                function gtag() {
                    dataLayer.push(arguments);
                }

                gtag('js', new Date());
                gtag('config', '<?php echo e(config('google_analytics_id')); ?>');
            </script>
        <?php endif; ?>


    </head>
    <body class="<?php echo e(config('layout_type')); ?>">

    <div id="app">
    
    <?php echo $__env->make('frontend.layouts.modals.loginModal', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>


    <!-- Start of Header section
        ============================================= -->
        <header>
            <div id="main-menu" class="main-menu-container">
                <div class="main-menu">
                    <div class="container">
                        <div class="navbar-default">
                            <div class="navbar-header float-left">
                                <a class="navbar-brand text-uppercase" href="<?php echo e(url('/')); ?>">
                                    
                                    <img src="<?php echo e(asset("storage/logos/".config('logo_w_image'))); ?>" alt="logo">
                                </a>
                            </div><!-- /.navbar-header -->

                            <div class="cart-search float-right ul-li">
                                <ul>
                                    <li>
                                        <a href="<?php echo e(route('cart.index')); ?>"><i class="fas fa-shopping-bag"></i>
                                            <?php if(auth()->check() && Cart::session(auth()->user()->id)->getTotalQuantity() != 0): ?>
                                                <span class="badge badge-danger position-absolute"><?php echo e(Cart::session(auth()->user()->id)->getTotalQuantity()); ?></span>
                                            <?php endif; ?>
                                        </a>
                                    </li>
                                </ul>
                            </div>


                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <nav class="navbar-menu float-right">
                                <div class="nav-menu ul-li">

                                    <ul>
                                        <?php if(count($custom_menus) > 0 ): ?>
                                            <?php $__currentLoopData = $custom_menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($menu['id'] == $menu['parent']): ?>
                                                    <?php if(count($menu->subs) == 0): ?>

                                                        <li class="nav-item">
                                                            <a href="<?php echo e(asset($menu->link)); ?>"
                                                               class="nav-link <?php echo e(active_class(Active::checkRoute('frontend.user.dashboard'))); ?>"
                                                               id="menu-<?php echo e($menu->id); ?>"><?php echo e(trans('custom-menu.'.$menu_name.'.'.str_slug($menu->label))); ?></a>
                                                        </li>

                                                    <?php else: ?>
                                                        <li class="menu-item-has-children ul-li-block">
                                                            <a href="#!"><?php echo e(trans('custom-menu.'.$menu_name.'.'.str_slug($menu->label))); ?></a>
                                                            <ul class="sub-menu">
                                                                <?php $__currentLoopData = $menu->subs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php echo $__env->make('frontend.layouts.partials.dropdown', $item, \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </ul>
                                                        </li>
                                                    <?php endif; ?>

                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>

                                        <?php if(auth()->check()): ?>
                                            <li class="menu-item-has-children ul-li-block">
                                                <a href="#!"><?php echo e($logged_in_user->name); ?></a>
                                                <ul class="sub-menu">
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view backend')): ?>
                                                        <li>
                                                            <a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo app('translator')->getFromJson('navs.frontend.dashboard'); ?></a>
                                                        </li>
                                                    <?php endif; ?>

                                                    <li>
                                                        <a href="<?php echo e(route('frontend.auth.logout')); ?>"><?php echo app('translator')->getFromJson('navs.general.logout'); ?></a>
                                                    </li>
                                                </ul>
                                            </li>
                                        <?php else: ?>
                                            <li>
                                                <div class="log-in mt-0">
                                                    <a id="openLoginModal" data-target="#myModal"
                                                       href="#"><?php echo app('translator')->getFromJson('navs.general.login'); ?></a>
                                                    <!-- The Modal -->
                                                    
                                                </div>
                                            </li>
                                        <?php endif; ?>
                                        <?php if(count($locales) > 1): ?>
                                            <li class="menu-item-has-children ul-li-block">
                                                <a href="#">
                                                    <span class="d-md-down-none"> <?php echo app('translator')->getFromJson('menus.language-picker.language'); ?>
                                                        (<?php echo e(strtoupper(app()->getLocale())); ?>)</span>
                                                </a>
                                                <ul class="sub-menu">
                                                    <?php $__currentLoopData = $locales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($lang != app()->getLocale()): ?>
                                                            <li>
                                                                <a href="<?php echo e('/lang/'.$lang); ?>"
                                                                   class=""> <?php echo app('translator')->getFromJson('menus.language-picker.langs.'.$lang); ?></a>
                                                            </li>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </nav>

                            <div class="mobile-menu">
                                <div class="logo">
                                    <a href="<?php echo e(url('/')); ?>">
                                        <img src=<?php echo e(asset("storage/logos/".config('logo_w_image'))); ?> alt="Logo">
                                    </a>
                                </div>
                                <nav>
                                    <ul>
                                        <?php if(count($custom_menus) > 0 ): ?>
                                            <?php $__currentLoopData = $custom_menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($menu['id'] == $menu['parent']): ?>
                                                    <?php if(count($menu->subs) == 0): ?>
                                                        <li class="">
                                                            <a href="<?php echo e(asset($menu->link)); ?>"
                                                               class="nav-link <?php echo e(active_class(Active::checkRoute('frontend.user.dashboard'))); ?>"
                                                               id="menu-<?php echo e($menu->id); ?>"><?php echo e(trans('custom-menu.'.$menu_name.'.'.str_slug($menu->label))); ?></a>
                                                        </li>
                                                    <?php else: ?>
                                                        <li class="">
                                                            <a href="#!"><?php echo e(trans('custom-menu.'.$menu_name.'.'.str_slug($menu->label))); ?></a>
                                                            <ul class="">
                                                                <?php $__currentLoopData = $menu->subs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php echo $__env->make('frontend.layouts.partials.dropdown', $item, \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </ul>
                                                        </li>
                                                        <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        <?php if(auth()->check()): ?>
                                            <li class="">
                                                <a href="#!"><?php echo e($logged_in_user->name); ?></a>
                                                <ul class="">
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view backend')): ?>
                                                        <li>
                                                            <a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo app('translator')->getFromJson('navs.frontend.dashboard'); ?></a>
                                                        </li>
                                                    <?php endif; ?>


                                                    <li>
                                                        <a href="<?php echo e(route('frontend.auth.logout')); ?>"><?php echo app('translator')->getFromJson('navs.general.logout'); ?></a>
                                                    </li>
                                                </ul>
                                            </li>
                                        <?php else: ?>
                                            <li>
                                                <div class=" ">
                                                    <a id="openLoginModal" data-target="#myModal"
                                                       href="#"><?php echo app('translator')->getFromJson('navs.general.login'); ?></a>
                                                    <!-- The Modal -->
                                                </div>
                                            </li>
                                        <?php endif; ?>
                                        <?php if(count($locales) > 1): ?>
                                            <li class="menu-item-has-children ul-li-block">
                                                <a href="#">
                                                    <span class="d-md-down-none"><?php echo app('translator')->getFromJson('menus.language-picker.language'); ?>
                                                        (<?php echo e(strtoupper(app()->getLocale())); ?>)</span>
                                                </a>
                                                <ul class="">
                                                    <?php $__currentLoopData = $locales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($lang != app()->getLocale()): ?>
                                                            <li>
                                                                <a href="<?php echo e('/lang/'.$lang); ?>"
                                                                   class=""> <?php echo app('translator')->getFromJson('menus.language-picker.langs.'.$lang); ?></a>
                                                            </li>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </nav>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Start of Header section
            ============================================= -->


        <?php echo $__env->yieldContent('content'); ?>

        <?php echo $__env->make('frontend.layouts.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    </div><!-- #app -->

    <!-- Scripts -->
    <?php echo $__env->yieldPushContent('before-scripts'); ?>

    <!-- For Js Library -->
    <script src="<?php echo e(asset('assets-rtl/js/jquery-2.1.4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets-rtl/js/popper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets-rtl/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets-rtl/js/owl.carousel.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets-rtl/js/jarallax.js')); ?>"></script>
    <script src="<?php echo e(asset('assets-rtl/js/jquery.magnific-popup.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets-rtl/js/lightbox.js')); ?>"></script>
    <script src="<?php echo e(asset('assets-rtl/js/jquery.meanmenu.js')); ?>"></script>
    <script src="<?php echo e(asset('assets-rtl/js/scrollreveal.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets-rtl/js/jquery.counterup.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets-rtl/js/waypoints.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets-rtl/js/jquery-ui.js')); ?>"></script>
    <script src="<?php echo e(asset('assets-rtl/js/gmap3.min.js')); ?>"></script>

    <script src="<?php echo e(asset('assets-rtl/js/switch.js')); ?>"></script>

    <script>
        <?php if(request()->has('user')  && (request('user') == 'admin')): ?>

        $('#myModal').modal('show');
        $('#loginForm').find('#email').val('admin@lms.com')
        $('#loginForm').find('#password').val('secret')

        <?php elseif(request()->has('user')  && (request('user') == 'student')): ?>

        $('#myModal').modal('show');
        $('#loginForm').find('#email').val('student@lms.com')
        $('#loginForm').find('#password').val('secret')

        <?php elseif(request()->has('user')  && (request('user') == 'teacher')): ?>

        $('#myModal').modal('show');
        $('#loginForm').find('#email').val('teacher@lms.com')
        $('#loginForm').find('#password').val('secret')

        <?php endif; ?>
    </script>


    <script src="<?php echo e(asset('assets-rtl/js/script.js')); ?>"></script>
    <script>
        <?php if((session()->has('show_login')) && (session('show_login') == true)): ?>
        $('#myModal').modal('show');
                <?php endif; ?>
        var font_color = "<?php echo e(config('font_color')); ?>"
        setActiveStyleSheet(font_color);
    </script>

    <?php echo $__env->yieldContent('js'); ?>

    <?php echo $__env->yieldPushContent('after-scripts'); ?>


    <?php echo $__env->make('includes.partials.ga', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </body>
    </html>
