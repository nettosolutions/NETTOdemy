<?php $__env->startSection('title', __('menus.backend.log-viewer.logs').' | '.app_name()); ?>

<?php $__env->startPush('after-styles'); ?>
    <?php echo $__env->make('log-viewer::_template.style', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>


<?php $__env->startSection('content'); ?>
    <?php echo $rows->render('log-viewer::_pagination.bootstrap-4'); ?>


    <div class="card">
        <div class="card-header">
            <?php echo e(__('menus.backend.log-viewer.logs')); ?>

        </div><!-- box-header -->

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <?php $__currentLoopData = $headers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $header): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <th class="<?php echo e($key == 'date' ? 'text-left' : 'text-center'); ?>">
                                <?php if($key == 'date'): ?>
                                    <span class="badge badge-info level"><?php echo e($header); ?></span>
                                <?php else: ?>
                                    <span class="badge level level-<?php echo e($key); ?>">
                                    <?php echo log_styler()->icon($key) . ' ' . $header; ?>

                                </span>
                                <?php endif; ?>
                            </th>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <th class="text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($rows->count() > 0): ?>
                        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php $__currentLoopData = $row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <td class="<?php echo e($key == 'date' ? 'text-left' : 'text-center'); ?>">
                                        <?php if($key == 'date'): ?>
                                            <a href="<?php echo e(route('log-viewer::logs.show', [$value])); ?>" class="btn btn-sm btn-primary">
                                                <?php echo e($value); ?>

                                            </a>
                                        <?php elseif($value == 0): ?>
                                            <span class="badge level level-empty"><?php echo e($value); ?></span>
                                        <?php else: ?>
                                            <a href="<?php echo e(route('log-viewer::logs.filter', [$date, $key])); ?>">
                                                <span class="badge level level-<?php echo e($key); ?>"><?php echo e($value); ?></span>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <td class="text-right">
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Log Viewer Actions">
                                        <a href="<?php echo e(route('log-viewer::logs.show', [$date])); ?>" class="btn btn-sm btn-info">
                                            <i class="fa fa-search"></i>
                                        </a>
                                        <a href="<?php echo e(route('log-viewer::logs.download', [$date])); ?>" class="btn btn-sm btn-success">
                                            <i class="fa fa-download"></i>
                                        </a>

                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-backdrop="false" data-target="#delete-log-modal" data-log-date="<?php echo e($date); ?>">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="11" class="text-center">
                                <span class="badge badge-default"><?php echo e(__('log-viewer::general.empty-logs')); ?></span>
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div><!--table-responsive-->
        </div>
    </div>

    <?php echo $rows->render('log-viewer::_pagination.bootstrap-4'); ?>


    <div id="delete-log-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delete-log-modal-label" aria-hidden="true">
        <div class="modal-dialog">
            <form id="delete-log-form" action="<?php echo e(route('log-viewer::logs.delete')); ?>" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="date" value="">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Log File</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p></p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-danger" data-loading-text="Loading&hellip;"><i class="fa fa-trash"></i> DELETE FILE</button>
                        <button type="button" class="btn btn-sm btn-primary pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-scripts'); ?>
    <script>
        $(function () {

            var deleteLogModal = $('#delete-log-modal'),
                deleteLogForm  = $('#delete-log-form'),
                submitBtn      = deleteLogForm.find('button[type=submit]');

            deleteLogModal.on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var logdate = button.data('log-date'); // Extract info from data-* attributes
                var modal = $(this);
                modal.find('.modal-body p').html(
                    'Are you sure you want to <span class="badge badge-danger">DELETE</span> this log file <span class="badge badge-primary">' + logdate + '</span> ?'
                );
                deleteLogForm.find('input[name=date]').val(logdate)
            });

            deleteLogForm.on('submit', function(event) {
                event.preventDefault();
                submitBtn.button('loading');

                $.ajax({
                    url:      $(this).attr('action'),
                    type:     $(this).attr('method'),
                    dataType: 'json',
                    data:     $(this).serialize(),
                    success: function(data) {
                        submitBtn.button('reset');
                        if (data.result === 'success') {
                            deleteLogModal.modal('hide');
                            location.reload();
                        }
                        else {
                            alert('AJAX ERROR ! Check the console !');
                            console.error(data);
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        alert('AJAX ERROR ! Check the console !');
                        console.error(errorThrown);
                        submitBtn.button('reset');
                    }
                });

                return false;
            });

            deleteLogModal.on('hidden.bs.modal', function() {
                deleteLogForm.find('input[name=date]').val('');
                deleteLogModal.find('.modal-body p').html('');
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>