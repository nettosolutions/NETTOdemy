<!DOCTYPE html>
<?php if(config('app.display_type') == 'rtl' || (session()->has('display_type') && session('display_type') == 'rtl')): ?>
    <html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" dir="rtl">

    <?php else: ?>
        <html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

        <?php endif; ?>
        
        
        
        
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
            <title><?php echo $__env->yieldContent('title', app_name()); ?></title>
            <meta name="description" content="<?php echo $__env->yieldContent('meta_description', 'Laravel 5 Boilerplate'); ?>">
            <meta name="author" content="<?php echo $__env->yieldContent('meta_author', 'Anthony Rappa'); ?>">
            <?php if(config('favicon_image') != ""): ?>
                <link rel="shortcut icon" type="image/x-icon"
                      href="<?php echo e(asset('storage/logos/'.config('favicon_image'))); ?>"/>
            <?php endif; ?>
            <?php echo $__env->yieldContent('meta'); ?>
            <link rel="stylesheet" href="<?php echo e(asset('css/select2.min.css')); ?>">
            <link rel="stylesheet" href="<?php echo e(asset('assets/css/fontawesome-all.css')); ?>">

            <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

            <link rel="stylesheet"
                  href="//cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>
            <link rel="stylesheet"
                  href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css"/>
            <link rel="stylesheet"
                  href="//cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css"/>
            
            
            
            <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">


            <?php echo $__env->yieldPushContent('before-styles'); ?>

        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
            <!-- Otherwise apply the normal LTR layouts -->
            <?php echo e(style(mix('css/backend.css'))); ?>



            <?php echo $__env->yieldPushContent('after-styles'); ?>

            <?php if((config('app.display_type') == 'rtl') || (session('display_type') == 'rtl')): ?>
                <style>
                    .float-left {
                        float: right !important;
                    }

                    .float-right {
                        float: left !important;
                    }
                </style>
            <?php endif; ?>

        </head>

        <body class="<?php echo e(config('backend.body_classes')); ?>">
        <?php echo $__env->make('backend.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <div class="app-body">
            <?php echo $__env->make('backend.includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <main class="main">
                <?php echo $__env->make('includes.partials.logged-in-as', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                

                <div class="container-fluid" style="padding-top: 30px">
                    <div class="animated fadeIn">
                        <div class="content-header">
                            <?php echo $__env->yieldContent('page-header'); ?>
                        </div><!--content-header-->

                        <?php echo $__env->make('includes.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php echo $__env->yieldContent('content'); ?>
                    </div><!--animated-->
                </div><!--container-fluid-->
            </main><!--main-->

            <?php echo $__env->make('backend.includes.aside', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div><!--app-body-->

        <?php echo $__env->make('backend.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <!-- Scripts -->
        <?php echo $__env->yieldPushContent('before-scripts'); ?>
        <?php echo script(mix('js/manifest.js')); ?>

        <?php echo script(mix('js/vendor.js')); ?>

        <?php echo script(mix('js/backend.js')); ?>

        <script>
            //Route for message notification
            var messageNotificationRoute = '<?php echo e(route('admin.messages.unread')); ?>'
        </script>
        <script src="//cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
        <script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
        <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
        <script src="<?php echo e(asset('js/pdfmake.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/vfs_fonts.js')); ?>"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
        <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


        <script src="<?php echo e(asset('js/select2.full.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('js/main.js')); ?>" type="text/javascript"></script>
        <script>
            window._token = '<?php echo e(csrf_token()); ?>';
        </script>

        <?php echo $__env->yieldPushContent('after-scripts'); ?>

        </body>
        </html>
