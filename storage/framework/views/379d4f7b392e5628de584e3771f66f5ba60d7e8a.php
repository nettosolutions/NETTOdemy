<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="<?php echo e(route('admin.dashboard')); ?>">
        <img class="navbar-brand-full" src="<?php echo e(asset('storage/logos/'.config('logo_b_image'))); ?>"  height="25" alt="Square Logo">
        <img class="navbar-brand-minimized" src="<?php echo e(asset('storage/logos/'.config('logo_popup'))); ?>" height="30" alt="Square Logo">
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>

    <ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item px-3">
            <a class="nav-link" href="<?php echo e(route('frontend.index')); ?>"><i class="icon-home"></i></a>
        </li>

        <li class="nav-item px-3">
            <a class="nav-link" href="<?php echo e(route('admin.dashboard')); ?>"><?php echo app('translator')->getFromJson('navs.frontend.dashboard'); ?></a>
        </li>
        
            
                
                    
                

                
            
        
        <?php if(config('locale.status') && count($locales) > 1): ?>

            <li class="nav-item px-3 dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <span class="d-md-down-none"><?php echo app('translator')->getFromJson('menus.language-picker.language'); ?> (<?php echo e(strtoupper(app()->getLocale())); ?>)</span>
                </a>

                <?php echo $__env->make('includes.partials.lang', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </li>
        <?php endif; ?>
    </ul>

    <ul class="nav navbar-nav ml-auto mr-4">
        <li class="nav-item d-md-down-none">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="icon-envelope"></i>
                <span class="badge badge-pill d-none badge-success unreadMessageCounter"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header text-center">
                    <strong><?php echo app('translator')->getFromJson('navs.general.messages'); ?></strong>
                </div>
                <div class="unreadMessages">
                   <p class="mb-0 text-center py-2"><?php echo app('translator')->getFromJson('navs.general.no_messages'); ?></p>
                </div>


            </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <img src="<?php echo e($logged_in_user->picture); ?>" class="img-avatar" alt="<?php echo e($logged_in_user->email); ?>">
              <span style="right: 0;left: inherit" class="badge d-md-none d-lg-none d-none mob-notification badge-success">!</span>
            <span class="d-md-down-none"><?php echo e($logged_in_user->full_name); ?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-header text-center">
              <strong><?php echo app('translator')->getFromJson('navs.general.account'); ?></strong>
            </div>

            <a class="dropdown-item" href="<?php echo e(route('admin.messages')); ?>">
              <i class="fa fa-envelope"></i> <?php echo app('translator')->getFromJson('navs.general.messages'); ?>
              <span class="badge unreadMessageCounter d-none badge-success">5</span>
            </a>

            <a class="dropdown-item" href="<?php echo e(route('admin.account')); ?>">
              <i class="fa fa-user"></i> <?php echo app('translator')->getFromJson('navs.general.profile'); ?>
            </a>

            <div class="divider"></div>
            <a class="dropdown-item" href="<?php echo e(route('frontend.auth.logout')); ?>">
                <i class="fas fa-lock"></i> <?php echo app('translator')->getFromJson('navs.general.logout'); ?>
            </a>
          </div>
        </li>
    </ul>

    
        
    
    
        
    
</header>
