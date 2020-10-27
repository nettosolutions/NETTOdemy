<?php $__env->startSection('title', __('menus.backend.log-viewer.dashboard').' | '.app_name()); ?>

<?php $__env->startPush('after-styles'); ?>
    <?php echo $__env->make('log-viewer::_template.style', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-md-3">
                    <canvas id="stats-doughnut-chart" height="300"></canvas>
                </div>

                <div class="col-md-9">
                    <div class="row">
                        <?php $__currentLoopData = $percents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-4 col-sm-6 mb-3">
                                <div class="card level-card level-<?php echo e($level); ?> <?php echo e($item['count'] === 0 ? 'level-empty' : ''); ?>">
                                    <div class="card-header">
                                        <span class="level-icon"><?php echo log_styler()->icon($level); ?></span> <?php echo e($item['name']); ?>

                                    </div>
                                    <div class="card-body">
                                        <?php echo e($item['count']); ?> entries - <?php echo $item['percent']; ?>%
                                        <div class="progress">
                                            <div class="progress-bar" style="width: <?php echo e($item['percent']); ?>%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-scripts'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment-with-locales.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.min.js"></script>
    <script>
        Chart.defaults.global.responsive = true;
        Chart.defaults.global.scaleFontFamily = "'Source Sans Pro'";
        Chart.defaults.global.animationEasing = "easeOutQuart";
    </script>
    <script>
        $(function () {
            new Chart($('canvas#stats-doughnut-chart'), {
                type: 'doughnut',
                data: <?php echo $chartData; ?>,
                options: {
                    legend: {
                        position: 'bottom'
                    }
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>